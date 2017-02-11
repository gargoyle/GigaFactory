<?php

namespace Pmc\GigaFactory\Resolver;

/**
 * Simply resolves to a fixed value.
 *
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class FixedResolver implements Resolver
{
    /**
     * @var string
     */
    private $fixedValue;

    public function __construct(string $fixedValue)
    {
        $this->fixedValue = $fixedValue;
    }

    public function resolve(string $className): string
    {
        return $this->fixedValue;
    }

}
