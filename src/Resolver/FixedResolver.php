<?php

namespace Pmc\GigaFactory\Resolver;

/**
 * Simply resolves to a fixed value.
 *
 * @author Gargoyle <g@rgoyle.com>
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
