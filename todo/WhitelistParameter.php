<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

// Simple version of the "Options Resolver" component.
// Use it as annotation in a controller's method, e.g.:
//
//  /* @WhitelistParameter("param1", "param2") */
//  public function myMethod(Request $request) {
//      $request->query->get('param1');
//
// A call of 'http://route/to/my/method?param-not-exists' will throw an error

/**
 * Used as Doctrine annotation
 * @Annotation
 */
class WhitelistParameter
{
    private ?Request $request = null;
    private array $whitelist = [];
  
    // Called in controller method's annotation
    public function __construct(array $whitelist)
    {
        $this->whitelist = $whitelist;
    }
  
    // Called in WhitelistParameterSubscriber
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    // Called in WhitelistParameterSubscriber
    public function validateWhitelist(): void
    {
        if (!$this->request || !$this->whitelist) {
            return;
        }
        $queries = $this->request->query->all();
        $diff = array_diff(array_keys($queries), $this->whitelist);
        if (!empty($diff)) {
            $flatten = join(", ", $diff);
            $flattenWhite = join(", ", $this->whitelist);
            throw new BadRequestHttpException(
                "Parameter" .
                    (count($diff) > 1 ? "s" : "") .
                    " '$flatten' not allowed in [$flattenWhite] list."
            );
        }
    }
}
