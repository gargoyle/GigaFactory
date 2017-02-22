<?php

namespace Pmc\GigaFactory\Resolver;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
interface Resolver
{
    public function resolve(string $className): string;
}
