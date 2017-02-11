<?php

namespace Pmc\Gigafactory\Tests;

use PHPUnit_Framework_TestCase;
use Pmc\GigaFactory\Resolver\ClassNameResolver;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class ClassNameResolverTest extends PHPUnit_Framework_TestCase
{
    
    public function noPrefixOrSuffixProvider()
    {
        return [
            ['Baz', 'Baz'],
            ['\Baz', 'Baz'],
            ['\Foo\Bar\Baz', 'Baz'],
            [self::class, 'ClassNameResolverTest']
        ];
    }
    
    public function prefixProvider()
    {
        return [
            ['Baz', 'prefix', 'prefixBaz'],
            ['\Baz', 'prefix', 'prefixBaz'],
            ['\Foo\Bar\Baz', 'prefix', 'prefixBaz'],
            [self::class, 'prefix', 'prefixClassNameResolverTest']
        ];
    }
    
    public function suffixProvider()
    {
        return [
            ['Baz', 'Suffix', 'BazSuffix'],
            ['\Baz', 'Suffix', 'BazSuffix'],
            ['\Foo\Bar\Baz', 'Suffix', 'BazSuffix'],
            [self::class, 'Suffix', 'ClassNameResolverTestSuffix']
        ];
    }
    
    public function prefixSuffixProvider()
    {
        return [
            ['Baz', 'prefix', 'Suffix', 'prefixBazSuffix'],
            ['\Baz', 'prefix', 'Suffix', 'prefixBazSuffix'],
            ['\Foo\Bar\Baz', 'prefix', 'Suffix', 'prefixBazSuffix'],
            [self::class, 'prefix', 'Suffix', 'prefixClassNameResolverTestSuffix']
        ];
    }
    
    
    /**
     * @dataProvider noPrefixOrSuffixProvider
     */
    public function testResolvesNamesWithoutPrefixOrSuffix($className, $expected)
    {
        $resolver = new ClassNameResolver();
        $this->assertEquals($expected, $resolver->resolve($className));
    }
    
    /**
     * @dataProvider prefixProvider
     */
    public function testResolvesNamesWithPrefix($className, $prefix, $expected)
    {
        $resolver = new ClassNameResolver($prefix);
        $this->assertEquals($expected, $resolver->resolve($className));
    }
    
    /**
     * @dataProvider suffixProvider
     */
    public function testResolvesNamesWithSuffix($className, $suffix, $expected)
    {
        $resolver = new ClassNameResolver('', $suffix);
        $this->assertEquals($expected, $resolver->resolve($className));
    }
    
    /**
     * @dataProvider prefixSuffixProvider
     */
    public function testResolvesNamesWithPrefixAndSuffix($className, $prefix, $suffix, $expected)
    {
        $resolver = new ClassNameResolver($prefix, $suffix);
        $this->assertEquals($expected, $resolver->resolve($className));
    }
}
