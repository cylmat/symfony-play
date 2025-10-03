Attribute validator on argument

=============================================
ConstraintValidatorCompilerPass implements CompilerPassInterface
{
public function process(ContainerBuilder $container): void


$validatorBuilder = $container->getDefinition('validator.builder');
$validatorBuilder->addMethodCall(
'addLoader',
[new Reference(ConstraintLoader::class)]
);

=============================================
class SymfonyProxyAttributeValidator implements ConstraintValidatorInterface
{
private const SUPPORTED_CONSTRAINTS = [
NotBlank::class,
All::class,
];

public function __construct(private readonly ValidatorInterface $symfonyValidator) {}

public function supports($value, ConstraintInterface $constraint): bool
{
return in_array(\get_class($constraint), self::SUPPORTED_CONSTRAINTS, true);
}

public function validate($value, ConstraintInterface $constraint): void
{
$symfonyConstraint = self::resolveConstraint($constraint);
$violations = $this->symfonyValidator->validate($value, $symfonyConstraint);
$exceptions = [];

foreach ($violations as $violation) {
$exceptions[] = new SymfonyValidationException(
(string) $violation->getMessage(),
$value,
$constraint
);
}

if (!empty($exceptions)) {
throw new AggregationValidationException($value, $exceptions);
}
}

private static function resolveConstraint(ConstraintInterface $constraint): SymfonyConstraint
{
$reflectionClass = new \ReflectionClass($constraint);
$arguments = [];

foreach ($reflectionClass->getProperties(\ReflectionProperty::IS_PUBLIC) as $reflectionProperty) {
$arguments[$reflectionProperty->getName()] = $reflectionProperty->getValue($constraint);
}

$explode = explode('\\', \get_class($constraint));
$className = array_pop($explode);
/** @var class-string $symfonyClassName */
$symfonyClassName = 'Symfony\\Component\\Validator\\Constraints\\' . $className;
Assertion::isInstanceOf($symfonyClassName, SymfonyConstraint::class);

return new $symfonyClassName(...$arguments);
}


=============================================
class ConstraintLoader implements LoaderInterface
{
public function loadClassMetadata(ClassMetadata $metadata): bool
{
$reflClass = $metadata->getReflectionClass();
$className = $reflClass->name;
$success = false;

foreach ($this->getAnnotations($reflClass) as $constraint) {
$metadata->addConstraint($constraint);
$success = true;
}

foreach ($reflClass->getProperties() as $property) {
if ($property->getDeclaringClass()->name === $className) {
foreach ($this->getAnnotations($property) as $constraint) {
$metadata->addPropertyConstraint($property->name, $constraint);
$success = true;
}
}
}

foreach ($reflClass->getMethods() as $method) {
if ($method->getDeclaringClass()->name === $className) {
foreach ($this->getAnnotations($method) as $constraint) {
if (preg_match('/^(get|is|has)(.+)$/i', $method->name, $matches)) {
$metadata->addGetterMethodConstraint(lcfirst($matches[2]), $matches[0], $constraint);
} else {
throw new MappingException(sprintf('The constraint on "%s::%s()" cannot be added. Constraints can only be added on methods beginning with "get", "is" or "has".', $className, $method->name));
}
$success = true;
}
}
}

return $success;
}

/** @return iterable */
private function getAnnotations(\ReflectionClass|\ReflectionMethod|\ReflectionProperty $reflection): iterable
{
foreach ($reflection->getAttributes(ConstraintInterface::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
$instance = $attribute->newInstance();

if ($instance instanceof All) {
yield new \Symfony\Component\Validator\Constraints\All(
array_map(
fn (ConstraintInterface $subConstraint) => new ConstraintWrapper($subConstraint),
$instance->constraints
)
);
} else {
yield new ConstraintWrapper($instance);
}
}
}


=============================================
class ConstraintValidator extends \Symfony\Component\Validator\ConstraintValidator
{
/** @var iterable */
private readonly iterable $validators;

public function __construct(
#[TaggedIterator('app.constraint_validator', defaultPriorityMethod: 'getPriority')] iterable $validators
) {
$this->validators = $validators;
}

public function validate(mixed $value, Constraint $constraint): void
{
if (!$constraint instanceof ConstraintWrapper) {
throw new \LogicException('The constraint must be an instance of ' . ConstraintWrapper::class);
}

$innerConstraint = $constraint->innerConstraint;
$validator = $this->findValidator($value, $innerConstraint);

try {
$validator->validate($value, $innerConstraint);
} catch (AggregationValidationException $exceptions) {
foreach ($exceptions->getExceptions() as $exception) {
$this->buildViolation($exception);
}
} catch (ValidationExceptionInterface $exception) {
$this->buildViolation($exception);
}
}

private function buildViolation(ValidationExceptionInterface $exception): void
{
$this->context
->buildViolation($exception->getMessage())
->setParameter('value', self::formatValue($exception->getValue()))
->setParameter('constraint', self::formatValue($exception->getConstraint()))
->addViolation();
}

private function findValidator(mixed $value, ConstraintInterface $constraint): ConstraintValidatorInterface
{
foreach ($this->validators as $validator) {
if ($validator->supports($value, $constraint)) {
return $validator;
}
}

throw new \LogicException('Unable to find a validator for the constraint ' . \get_class($constraint));
}
