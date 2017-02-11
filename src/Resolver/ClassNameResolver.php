<?php

namespace Pmc\GigaFactory\Resolver;

/**
 * Strip any leading namespace from a FQN and wrap with prefix and suffix.
 * 
 * Eg: \Some\Namespace\Foo\Bar resolves to <prefix>Bar<Suffix>
 *
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class ClassNameResolver implements Resolver
{
    private $suffix;
    private $prefix;

    public function __construct(string $prefix = '', string $suffix = '')
    {
        $this->prefix = $prefix;
        $this->suffix = $suffix;
    }

    public function resolve(string $className): string
    {
        $subStrStart = strrpos($className, '\\') === false ? 0 : strrpos($className, '\\') + 1;
        $methodName = sprintf(
                '%s%s%s',
                $this->prefix,
                substr($className, $subStrStart),
                $this->suffix
                );
        return $methodName;
    }

}
