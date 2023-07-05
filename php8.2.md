# PHP 8.2
[php.net](https://www.php.net/releases/8.2/en.php)

Features
- Readonly class : readonly class {} : All properties are readonly
- Disjunctive Normal Form (DNF) Types : Combine union and intersection types : (A&B)|null $entity
- Allow null, false, and true as stand-alone types : public function alwaysTrue(): true {}
- New "Random" extension : use Random\Randomizer;
- Constant in trait : trait Foo { public const CONSTANT = 1; }
- Dynamic properties is deprecated : $user->last_name = 'Doe'; // Deprecated notice
    Use #[\AllowDynamicProperties] on class if needed

New
- #[\SensitiveParameter] : Not displayed in stack trace
- ReflectionFunction::isAnonymous, ReflectionMethod::hasPrototype

Break
- Deprecated ${} string interpolation
- Deprecated utf8_encode and utf8_decode
- Methods DateTime::createFromImmutable and DateTimeImmutable::createFromMutable has a tentative return type of static
- Strtolower and strtoupper are no longer locale-sensitive
- SplFileObject::hasChildren has a tentative return type of false
- SplFileObject::getChildren has a tentative return type of null