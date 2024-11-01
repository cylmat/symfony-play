# PHP 8.2
[php.net](https://www.php.net/releases/8.2/en.php)
[php.watch](https://php.watch/versions/8.2)

Features
- Readonly class: readonly class {} : All properties are readonly
- Disjunctive Normal Form (DNF) Types: Combine union and intersection types: fn((A&B)|null $entity)
- Allow null, false, and true as stand-alone types: public function alwaysTrue(): true {}
- New "Random" extension: use Random\Randomizer;
- Constant in trait: trait Foo { public const CONSTANT = 1; }
- Dynamic properties is deprecated: $user->last_name = 'Doe'; // Deprecated notice
    Use #[\AllowDynamicProperties] on class if needed

New
- #[\SensitiveParameter]: Not displayed in stack trace
- ReflectionFunction::isAnonymous, ReflectionMethod::hasPrototype

Break
- Deprecated ${} string interpolation
- Deprecated utf8_encode and utf8_decode
- Methods DateTime::createFromImmutable and DateTimeImmutable::createFromMutable has a tentative return type of static
- Strtolower and strtoupper are no longer locale-sensitive
- SplFileObject::hasChildren has a tentative return type of false
- SplFileObject::getChildren has a tentative return type of null

# PHP 8.1
[php.net](https://www.php.net/releases/8.1/en.php)
[php.watch](https://php.watch/versions/8.1)

Features
- Enumerations: enum Status { case Draft; }
- Readonly Properties: public readonly Status $status;
- First-class Callable Syntax: 
    $foo = [$this, 'foo'];                 BECOME $foo = $this->foo(...);
    $fn = Closure::fromCallable('strlen'); BECOME $fn = strlen(...);
- New in initializers: __construct(Logger $logger = new NullLogger())
    Nested attributes: #[\Assert\All(new \Assert\NotNull)]
- Pure Intersection Types: fn(Iterator&Countable $value)
- 'Never' return type: redirect(string $uri): never;
- Final class constants: final public const FOO = "foo";
- Explicit Octal numeral notation: 
    BEFORE 016 !== 16;  016 === 14;
    AFTER  0o16 !== 16; 0o16 === 14;
- Fibers:
    Lightweight cooperative concurrency
    Creating code blocks that can be paused and resumed like Generators
    BEFORE $response->then(function (Response $response) {$response->getBody();})
    AFTER  $responseFiber->getBody();
- Array unpacking support for string-keyed arrays:
    BEFORE $result = array_merge(['a' => 0], $arrayA, $arrayB);
    AFTER  $result = ['a' => 0, ...$arrayA, ...$arrayB];

New
- #[ReturnTypeWillChange] attribute
- fsync and fdatasync
- array_is_list($array): bool
- Sodium XChaCha20 functions

Deprecated
- Passing null to non-nullable internal function
- Serializable interface
- $GLOBALS mass change variables
- Implicit incompatible float to int conversion

# PHP 8.0
[php.net](https://www.php.net/releases/8.0/en.php)
[php.watch](https://php.watch/versions/8.0)
Just-In-Time compilation

Features
- Named arguments: htmlspecialchars($string, double_encode: false);
- Attributes: #[Route("/api/posts/{id}", methods: ["GET"])]
- Constructor property: __construct(public float $x = 0.0)
- Union types: private int|float $number
- Match expression: echo match (8.0) {'8.0' => "Ok!",};
- Nullsafe operator: $country = $session?->user?->getAddress()?->country;
- Saner string to number comparisons: 0 == 'foobar' // false
- Type errors for internal functions: strlen([]); // TypeError: strlen(): Argument #1

New
- Weak Map class
- Stringable interface
- str_contains(), str_starts_with(), str_ends_with() functions
- fdiv(), get_debug_type(), get_resource_id(), token_get_all()


