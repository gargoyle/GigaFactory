<?php

namespace Pmc\GigaFactory\Resolver;

interface Resolver
{
    public function resolve(string $className): string;
}
