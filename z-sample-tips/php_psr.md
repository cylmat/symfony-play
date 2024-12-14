# PSR 1 - Coding standards

- Files MUST use only <?php and <?= tags.  
- Files MUST use only UTF-8 without BOM for PHP code.  
- Files SHOULD either declare symbols (classes, functions, constants, etc.) or cause side-effects (e.g. generate output, change .ini settings, etc.) but SHOULD NOT do both.  
- Namespaces and classes MUST follow an "autoloading" PSR: [PSR-0, PSR-4].  
- Class names MUST be declared in StudlyCaps (PascalCase).  
- Class constants MUST be declared in all upper case with underscore separators.  
- Method names MUST be declared in camelCase.  

```
<?php
// PHP 5.3 and later:
namespace Vendor\Model;

class Foo
{
    const VERSION = '1.0';
    const DATE_APPROVED = '2012-06-01';

    $StudlyCaps, $camelCase, or $under_score;

    function camelCase() 
    {
    }
}
```

# PSR 12 - Extended Coding Style

2. General
- Use LF only
- Php file MUST end with non-blank line LF
- ?> MUST be omitted tag for php-only files
- NO hard limit, Soft MUST be 120 length, 80 line length recommanded
- No end line trailing spaces
- MUST be 4 spaces indent
- Reserved words short and lowercase (ex: bool, int)

3. Namespace, imports
- Opening <?php tag.
- File-level docblock.
- One or more declare statements.
- The namespace declaration of the file.
- One or more class-based use import statements.
- One or more function-based use import statements.
- One or more constant-based use import statements.
- The remainder of the code in the file.

4. Class properties
- Parentheses MUST always be present: new Foo();
- extends and implements keywords MUST be declared on the same line as the class name.
- use keyword used inside the classes to implement traits MUST be declared on the next line after the opening brace
- Visibility MUST be declared on all properties

5. Control Structures
6. Operators
7. Closures


```
<?php

/**
 * File-level docblock
 */

declare(strict_types=1);
declare(ticks=1) {
    // declare statements
}

namespace Vendor\Package;

// use class, fct then const
use Vendor\Package\{ClassA as A, ClassB, ClassC as C};
use Vendor\Package\AnotherSomeNamespace\ClassD as D;

use Vendor\Package\SomeNamespace\{
    SubnamespaceOne\ClassA,
    SubnamespaceOne\ClassB,
    SubnamespaceTwo\ClassY,
    ClassZ,
};

use function Vendor\Package\{functionA, functionB, functionC};

use const Vendor\Package\{CONSTANT_A, CONSTANT_B, CONSTANT_C};

/**
 * Class-level docblock
 */
abstract class Foo extends Bar implements // class, extends, implements on same line
    \FooInterface
    \MulitlineInterface
{
    use FirstTrait; // traits on first line of class
    use CTrait {
        FirstTrait::bigTalk insteadof C;
        CTrait::mediumTalk as FooBar;
    }

    private MY_CONSTANT = 987;

    public static string $declaredProperty = '';
    private $propertie = null;

    abstract protected function zim();

    public function sampleFunction(int $a, int $b = null): array
    {
        if (
            $expr1
            && $expr2
        ) {
            bar(); // if body
        } elseif ($a > $b) {
            $foo->bar($arg1);
        } else {
            BazClass::bar($arg2, $arg3);
        }

        switch ($expr) {
            case 0:
                echo 'First case, with a break';
                break;
            case 1:
            echo 'Second case, which falls through';
            // no break         -> MUST be mandatory
        }

        do {
            // structure body;
        } while ($expr);

        for ($i = 0; $i < 10; $i++) { // MAY be split across multiple lines
            // for body
        }
    }

    final public static function bar(int $arg1, &$arg2, $arg3 = [], &...$parts): ?object
    {
        // method body

        try {
            // try body
        } catch (FirstThrowableType $e) {
            // catch body
        } catch (OtherThrowableType | AnotherThrowableType $e) {
            // catch body
        } finally {
            // finally body
        }

        $intValue = (int) $input;

        if ($a === $b) {
            $foo = $bar ?? $a ?? $b;
        } elseif ($a > $b) {
            $foo = $a + $b * $c;
        }

        $variable = $foo ? 'foo' : 'bar';
        $variable = $foo ?: 'bar';
    }

    public function aVeryLongMethodName(
        ClassTypeHint $arg1,
        &$arg2,
        array $arg3 = []
    ): ?string {
        // 7. Closure
        $closureWithArgsVarsAndReturn = function ($arg1, $arg2) use ($var1, $var2): bool {
            // body
        };

        $longArgs_shortVars = function (
            $longArgument,
            $longerArgument,
            $muchLongerArgument
        ) use ($var1) {
           // body
        };
    }
}
```

// Side-effect call
```
bar();
$foo->bar(
    $arg1,
    $longArgument,
    $longerArgument
);
Foo::bar($arg2, $arg3, [
  // ...
], $bar);

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

$foo->bar(
    $arg1,
    function ($arg2) use ($var1) {
        // body
    },
    $arg3
);

// 8. Anonymous class
$instance = new class {};

$instance = new class extends \Foo implements
    \ArrayAccess,
    \Countable,
    \Serializable
{
    // Class content
};
```

## PSR2 (deprecated)

Code MUST follow a "coding style guide" PSR [PSR-1].  
Code MUST use 4 spaces for indenting, not tabs.  
There MUST NOT be a hard limit on line length; the soft limit MUST be 120 characters; lines SHOULD be 80 characters or less.  
There MUST be one blank line after the namespace declaration, and there MUST be one blank line after the block of use declarations.  
Opening braces for classes MUST go on the next line, and closing braces MUST go on the next line after the body.  
Opening braces for methods MUST go on the next line, and closing braces MUST go on the next line after the body.  
Visibility MUST be declared on all properties and methods; abstract and final MUST be declared before the visibility; static MUST be declared after the visibility.  
Control structure keywords MUST have one space after them; method and function calls MUST NOT.  
Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.  
Opening parentheses for control structures MUST NOT have a space after them, and closing parentheses for control structures MUST NOT have a space before.  
PHP keywords MUST be in lower case. The PHP constants true, false, and null MUST be in lower case.


---

---

---


# PSR SUMMARY
[https://www.php-fig.org/psr]

# PSR-3: Logger Interface
```
interface LoggerInterface {
  public function emergency(string $message, array $context = array()): void; // System is unusable.
  // Action must be taken immediately. Entire website down, database unavailable, etc. 
  public function alert(string $message, array $context = array()): void; 
  // Critical conditions. Application component unavailable, etc.
  public function critical(string $message, array $context = array()): void; 
  // Runtime errors that do not require immediate action but should typically be logged and monitored.
  public function error(string $message, array $context = array()): void; 

  // Exceptional occurrences that are not errors. Use of deprecated APIs, poor use of an API...
  public function warning(string $message, array $context = array()): void; 
  public function notice(string $message, array $context = array()): void; // Normal but significant events.
  public function info(string $message, array $context = array()): void; // Interesting events.
  public function debug(string $message, array $context = array()): void; // Detailed debug information.
  public function log(mixed $level, string $message, array $context = array()): void; // Logs with an arbitrary level.

interface LoggerAwareInterface {
    public function setLogger(LoggerInterface $logger): void;
```
# PSR-4: Autoloading
FQCN: \<NamespaceName>(\<SubNamespaceNames>)*\<ClassName>  
- The fully qualified class name MUST have a top-level namespace name, also known as a "vendor namespace".
- The fully qualified class name MAY have one or more sub-namespace names.
- The fully qualified class name MUST have a terminating class name. (Underscores have no special meaning)
(PSR-0: Each _ character in the CLASS NAME is converted to a DIRECTORY_SEPARATOR)

# PSR-6: Caching Interface
- If it is not possible to return the exact saved value, MUST respond with a cache miss rather than corrupted data.
- An Item represents a single key/value pair within a Pool (a collection of items in a caching system)
```
interface CacheItemInterface {
   public function getKey(): string;
   public function get(): mixed; // can return a "null" cached value
   public function isHit(): bool;
   public function set(mixed $value): static;
   public function expiresAt(\DateTimeInterface|null $expiration): static;
   public function expiresAfter(int|\DateInterval|null $time); // TTL (sec)

interface CacheItemPoolInterface {
   public function getItem(string $key): CacheItemInterface; // @throws InvalidArgumentException
   public function getItems(array $keys = []): @return iterable; // @throws InvalidArgumentException
   public function hasItem(string $key): bool; // @throws InvalidArgumentException
   public function clear();
   public function deleteItem(string $key): bool; // @throws InvalidArgumentException
   public function deleteItems(array $keys): bool; / @throws InvalidArgumentException
   public function save(CacheItemInterface $item): bool;
   public function saveDeferred(CacheItemInterface $item): bool;
   public function commit(): bool;
```

# PSR-7: HTTP Message Interface
 RFC 7230 and RFC 7231
```
interface MessageInterface {
  getProtocolVersion(), withProtocolVersion($version)
  getHeaders(), hasHeader($name), getHeader($name), getHeaderLine($name), 
  withHeader($name, $value), withAddedHeader($name, $value), withoutHeader($name)
  getBody(), withBody(StreamInterface $body)
  
interface RequestInterface extends MessageInterface {
  public function getRequestTarget(): string;
  public function withRequestTarget(mixed $requestTarget): static;
  public function getMethod(): string;
  public function withMethod(string $method): static;
  public function getUri(): UriInterface;
  public function withUri(UriInterface $uri, bool $preserveHost = false): static;
  
interface ServerRequestInterface extends RequestInterface {
  public function getServerParams(): array;
  public function getCookieParams(): array;
  public function withCookieParams(array $cookies): static;
  public function getQueryParams(): array;
  public function withQueryParams(array $query): static;
  public function getUploadedFiles(): array;
  public function withUploadedFiles(array $uploadedFiles): static;
  public function getParsedBody(): null|array|object;
  public function withParsedBody(null|array|object $data): static;
  public function getAttributes(): mixed[];
  public function getAttribute(string $name, mixed $default = null): mixed;
  public function withAttribute($string name, mixed $value): static;
  public function withoutAttribute(string $name): static;

interface ResponseInterface extends MessageInterface {
  public function getStatusCode(): int;
  public function withStatus(int $code, string $reasonPhrase = ''): static;
  public function getReasonPhrase(): string;
  
interface StreamInterface {
  __toString, close, detach, getSize, tell, eof, isSeekable, seek
  rewind, isWritable, write, isReadable, read, getContents, getMetadata
  
interface UriInterface {
  __toString, getScheme, getAuthority([user-info@]host[:port]), getUserInfo, getHost, getPort, 
  getPath, getQuery, getFragment, withScheme, withUserInfo, withHost, withPort, withPath, withQuery, withFragment
  
interface UploadedFileInterface: getStream, moveTo, getSize, getError, getClientFilename, getClientMediaType
```

# PSR-11: Container interface
```
interface ContainerInterface {
  public function get(string $id): mixed; // @throws NotFoundExceptionInterface, ContainerExceptionInterface
  public function has(string $id): bool;
```

# PSR-13: Hypermedia Links (RFC 5988, 6570)
```
interface LinkInterface: getHref, isTemplated, getRels, getAttributes
interface EvolvableLinkInterface: withHref, withRel, withoutRel, withAttribute, withoutAttribute
interface LinkProviderInterface: getLinks, getLinksByRel
interface EvolvableLinkProviderInterface: withLink, withoutLink
```

# PSR-14: Event Dispatcher
Event - Message produced by an Emitter.
Listener - Callable that expects to be passed an Event. 
Emitter - Code that wishes to dispatch an Event. 
Dispatcher - Service object that is given an Event object by an Emitter. 
Listener Provider - Responsible for determining what Listeners are relevant for a given Event.
```
interface EventDispatcherInterface {
    public function dispatch(object $event): object; // event
interface ListenerProviderInterface {
    public function getListenersForEvent(object $event) : iterable; // callable
interface StoppableEventInterface {
    public function isPropagationStopped() : bool;
```

# PSR-15: HTTP Server Request Handlers
 - Use PSR-7: HTTP Message  
Middleware processing of an incoming request and the creation of a resulting response (ResponseInterface), as defined by PSR-7.
```
interface RequestHandlerInterface {
    public function handle(ServerRequestInterface $request): ResponseInterface;
    
interface MiddlewareInterface {
    // If unable to produce the response itself, it may delegate to the provided request handler to do so.
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface;
```

# PSR-16: Common Cache Interface
CacheInterface corresponds to a single collection of cache items with a single key namespace, and is equivalent to a "Pool" in PSR-6
```
interface CacheInterface {
  public function get(string $key, mixed $default = null): mixed; // @throws \Psr\SimpleCache\InvalidArgumentException
  public function set(string $key, mixed $value, null|int|\DateInterval $ttl = null): bool;
  public function delete(string $key): bool;
  public function clear(): bool;
  public function getMultiple(iterable $keys, $default = null): iterable;
  public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool;
  public function deleteMultiple(iterable $keys): bool;
  // can return true and immediately after, another script can remove it, making the state of your app out of date!
  public function has(string $key): bool;
```

# PSR-17: HTTP Factories
```
interface RequestFactoryInterface {
    public function createRequest(string $method, UriInterface|string $uri): RequestInterface;
interface ResponseFactoryInterface {
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface;
interface ServerRequestFactoryInterface {
    public function createServerRequest(string $method, UriInterface|string $uri, array $serverParams = []): ServerRequestInterface;
interface StreamFactoryInterface: createStream, createStreamFromFile, createStreamFromResource (StreamInterface)
interface UploadedFileFactoryInterface: createUploadedFile (UploadedFileInterface)
interface UriFactoryInterface { public function createUri(string $uri = '') : UriInterface;
```

# PSR-18: HTTP Client
- Sending HTTP requests and receiving HTTP responses
- Well-formed HTTP request or HTTP response MUST NOT cause an exception 
- ClientExceptionInterface only if it is unable to send the HTTP request at all
- The request message is not a well-formed HTTP request or is missing some critical information, the Client MUST throw an instance of RequestExceptionInterface
- Request cannot be sent due to a network failure of any kind, MUST throw an instance of NetworkExceptionInterface
```
interface ClientInterface {
  public function sendRequest(RequestInterface $request): ResponseInterface; // @throws \Psr\Http\Client\ClientExceptionInterface
interface RequestExceptionInterface/NetworkExceptionInterface extends ClientExceptionInterface {} {
  public function getRequest(): RequestInterface;
```
