<?php

declare(strict_types=1);

namespace App\SampleBundle\Application\Common;

final class AppRequest
{
    /** @param mixed[] $data */
    public function __construct(
        private array $data = []
    ) {
    }

    public function __get(string $name): mixed
    {
        return $this->data[$name];
    }

    /**
     * Use self::setText1('value') to insert
     *  ['text1' => 'value'] in data
     */
    public function __call(string $name, array $args): self
    {
        $attributeName = \lcfirst(\str_replace('set', '', $name));

        $this->data[$attributeName] = $args[0];

        return $this;
    } 
}
