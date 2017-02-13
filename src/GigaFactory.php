<?php

namespace Pmc\GigaFactory;

use Pmc\GigaFactory\ {
    Exception\FactoryAlreadyRegisteredException,
    Exception\FactoryNotFoundException,
    Resolver\Resolver
};
use Psr\Log\LoggerInterface;

/**
 * Multiple factories can be registered with the gigafactory to provide a common
 * place to call for creating objects.
 * 
 * The method that will be called on the registered factories is discovered by way
 * of a class implementing the Resolver interface.
 *
 * @author Paul Court <emails@paulcourt.co.uk>
 */
class GigaFactory
{

    /**
     * @var Resolver
     */
    private $resolver;

    /**
     * @var LoggerInterface
     */
    private $logger;
    
    /**
     * @var CreatorFactory[]
     */
    private $creatables;

    public function __construct(Resolver $resolver, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->creatables = [];
        $this->resolver = $resolver;
    }

    public function register(Creator $factory): void
    {
        $newCreatables = $factory->getCreatableList();
        foreach ($newCreatables as $newCreatable) {
            if (array_key_exists($newCreatable, $this->creatables)) {
                throw new FactoryAlreadyRegisteredException(sprintf(
                        "A factory has already been registered to create %s objects",
                        $newCreatable));
            }
            
            $this->creatables[$newCreatable] = $factory;
        }
    }
    
    public function create(string $className, array $data)
    {
        if (!isset($this->creatables[$className])) {
            throw new FactoryNotFoundException(sprintf(
                    "No factory registered to create %s objects",
                    $className));
        }
        
        $methodNameToCall = $this->resolveMethodNameToCall($className);
        return $this->creatables[$className]->$methodNameToCall($className, $data);
    }
    
    private function resolveMethodNameToCall($className): string
    {
        return $this->resolver->resolve($className);
    }
}
