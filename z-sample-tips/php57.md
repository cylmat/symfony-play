## 7.3
- Heredoc and Nowdoc closing marker no longer required to be followed by a semicolon or newline, and can be indented.
- Array Destructuring supports Reference: e.g. [&$a, [$b, &$c]] = $d
- Instanceof accepts Literals (e.g. '4') and will return false
- CompileError which inherits ParseError 
- Trailing Commas are allowed in Calls: e.g. my1(1,);
- FPM logging: log_limit, log_buffering, decorate_workers_output
- Full support for LDAP Controls has been added to the LDAP querying functions and ldap_parse_result()
- New function mb_strtoupper("Straße");
- mb_convert_case() with MB_CASE_TITLE now performs title-case conversion
- The Multibyte String Functions now correctly support strings larger than 2GB. 
- mb_ereg_* functions now support named captures: e.g. mb_ereg('(?<word>\w+)', '国', $matches);
  - mb_ereg_replace() now supports the \k<> and \k'' to reference named captures 
    e.g. mb_ereg_replace('\s*(?<word>\w+)\s*', "_\k<word>_\k'word'_", ' foo ');
- New function: array_key_first(), array_key_last(), gc_status(), hrtime(), is_countable()
    fpm_get_status(), DateTime::createFromImmutable()
- 
- (backward): Heredoc/Nowdoc Ending Label Interpretation: <<<FOO abcdefg FOO FOO;
- (backward): Continue Targeting Switch issues Warning: e.g. while ($foo) switch ($bar) case "baz": continue;
- (backward): Strict Interpretation of Integer String Keys on ArrayAccess: $obj["123"] != \$obj[123]
- (backward): Argument unpacking stopped working with Traversables with non-integer keys
- (backward): Reflection export to string now uses int and bool instead of integer and boolean
- (backward): If an SPL autoloader throws an exception, following autoloaders will not be executed
- (backward): As of PHP 7.3.23, the names of incoming cookies are no longer url-decoded for security reasons.

## 7.2
- New "object" type: test(object $obj): object
- Extension loading by name only: .so for Unix or .dll
- Abstract method overriding with cov/contra: abstract function test(string $s); => abstract function test($s) : int;
- Sodium is now a core extension
- PDO::PARAM_STR extended options
- Sockets extension has the ability to lookup address
- Parameter type can be omitted (LSP): function Test(array $input); => function Test($input){}
- Trailing comma for grouped namespaces: use Foo\Bar\{ Foo, ... };
- pack() and unpack() functions support float and double in both little and big endian.
- EXIF extension support a much larger range of formats.
- SQLite3::openBlob() now allows to open BLOB fields in write mode
- New function:  mb_chr(), mb_ord(), sodium_*
-
- (backward): number_format() don't return negative zero
- (backward): Convert numeric keys in object and array casts: $obj->{'0'}, or $arr[0] from $this->{0} = 1; // now accessible
- (backward): Disallow passing null to get_class()
- (backward): Warn when counting non-countable types: e.g. count(1)
- (backward): Hash extension objects instead of resources (check with is_resource())
- (backward): gettype() can return "resource (closed)"
- (backward): is_object() on the "__PHP_Incomplete_Class" will now return true
- (backward): References to undefined constants will now generate an E_WARNING
- (backward): array_unique() with SORT_STRING create now a new array and can result in different numeric indexes
- (backward): hash_*() functions no longer accept non-cryptographic hashes
- (backward): json_decode()'s JSON_OBJECT_AS_ARRAY, is now used if the second parameter (assoc) is null 
- (backward): sql.safe_mode ini setting has now been removed

## 7.1
- Nullable type: ?string
- "Void" return: function(): void {}
- Shorthand array syntax ([]) as an alternative to list()
- Constant visibility: "private" const PUBLIC_CONST_B = 2;
- Iterable pseudo-type (implements Traversable): function iterator(iterable $iter)
- Multicatch: catch (FirstException | SecondException $e)
- Keys in list(): ["id" => 1, "name" => 'Tom'] = $e
- Support for negative string offset: echo " '$string[-1]'"
- New functions: Closure::fromCallable() and is_iterable()
- pcntl_async_signals(true); // turn on async signals
- tcp_nodelay stream context added
-
- (backward): Throw exception when passing too few function arguments
- (backward): Forbid dynamic calls with compact, extract, func_get...
- (backward): rand() aliased to mt_rand() and srand() aliased to mt_srand()
- (backward): Do not call destructors on incomplete objects that throw an exception 
- (backward): Assignment via string index ($a = ''; $a[10] = 'foo'; string(11) " . . . . . . f")
- (backward): DateTime constructor incorporates microseconds (e.g. new DateTime() == new DateTime() => false)

## 7.0
- Scalar declaration (coercively or strictly): (e.g. int $val;)
  + Use of declare(strict_types=1)
- Return type: (e.g. function(): float)
- Null coalescing operator: $_GET['user'] ?? 'nobody'
- Spaceship operator -1 <=> 1 (e.g. echo 5 <=> 8; // 5 - 8 = -3, prints -1)
- Constant arrays using: define('ANIMALS', ['dog','cat','bird']);
- Anonymous classes: new class () {};
- Error are now Throwable. Throwable => ['Exception', 'Error']
- Unicode codepoint escape syntax: echo "\u{aa}";
- Closure::call(): $getX->call(new A);
- Filter: unserialize($foo, ["allowed_classes" => ["MyClass", "MyClass2"]]);
- New class IntlChar(), e.g.: IntlChar::charName('@');
- Update assert: assert(false, new CustomError('Some error message'));
- Group use: use some\namespace\{ClassA, ClassB, ClassC as C};
- Generator return: function() {yield 1; yield 2; return 3;} echo $gen->getReturn();
- Generator delegation: yield from gen2();
- intdiv() function performs an integer division
- session_start() now accepts an array of options
- new preg_replace_callback_array() function enables code to be written more cleanly
- random_bytes() and random_int()
- list() can always unpack objects implementing ArrayAccess
- Class member access on cloning has been added, e.g. (clone $foo)->bar();
- PHP4 constructor style
- 
- (backward): Changes Errors to Throwable handling, and set_exception_handler(Throwable) 
- (backward): 'foreach' no longer changes the internal array pointer, operates on a copy of the array
- (backward): E_STRICT reclassified, and list() assigns variables in defined order 
- (backward): Access to variables, properties, and methods will now be evaluated strictly in left-to-right order  
  
**@ref**: https://www.php.net/manual/fr/migration70.php  

| Exp | 5 | 7 | 
| --- | --- | --- |
| $$foo\['bar'\]\['baz'\] | 	${$foo\['bar'\]\['baz'\]} |	($$foo)\['bar'\]\['baz'\]  |
| $foo->$bar\['baz'\] |	    $foo->{$bar\['baz'\]} | 	($foo->$bar)\['baz'\]  |
| $foo->$bar\['baz'\]() | 	$foo->{$bar\['baz'\]}() |	($foo->$bar)\['baz'\]() | 
| Foo::$bar\['baz'\]() |    Foo::{$bar\['baz'\]}() | 	(Foo::$bar)\['baz'\]()  |
| | | |
| var_dump(is_numeric("0x123")); | bool(true) | bool(false) |
| $c =& new MyClass; | Deprecated | Fatal Error |
| <script language="php"> | | (removed) |
| echo yield -1; | echo (yield) - 1; | echo yield (-1); |
| yield $foo or die; | yield ($foo or die); | (yield $foo) or die; |
| | JSON | JSOND |

## 5.6
- Decomposition: function f($req, $opt = null, ...$params)
- Decompression: echo add(1, ...$operators);
- phpdbg
- php://input reusable
- GMP: GNU Multiple precision can use operator surcharge
- add __debugInfo tu us var_dump()
- Constant expressions: Possible to provide a scalar expression involving numeric and string literals and/or constants
```
const TWO = ONE * 2;
class C {
    const THREE = TWO + 1;
```
- (backward): Array keys won't be overwritten [1=>'c','a','b'] give ['c','a','b']
    
## 5.5 from 5.1
5.5: finally, ::class, yield, empty(), OPCache   
5.4: traits, (new F)->use(), class::{expr}, format 0b00  
5.3: __invoke(), static:: (LSB), __callStatic, $classname::constant, heredoc, const      
5.1: __isset() and __unset(),  __set_state()  
    
@Ref: 
* https://www.php.net/manual/fr/language.oop5.changelog.php
* https://www.php.net/manual/en/language.operators.precedence.php
* https://www.julp.fr/blog/posts/18-les-nouveautes-majeures-de-php-7-0-7-1-7-2-7-3-et-7-4
