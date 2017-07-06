<?php

namespace Pmc\GigaFactory;

use Pmc\GigaFactory\Exception\FactoryAlreadyRegisteredException;
use Pmc\GigaFactory\Exception\FactoryNotFoundException;
use Pmc\ObjectLib\ParameterBag;
use Psr\Log\LoggerInterface;

/**
 * Multiple factories can be registered with the gigafactory to provide a common
 * place to call for creating objects.
 * 
 * @author Gargoyle <g@rgoyle.com>
 */
class GigaFactory
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Creator[]
     */
    private $creatables;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->creatables = [];
    }

    public function register(Creator $factory): void
    {
        $newCreatables = $factory->getCreatableList();
        foreach ($newCreatables as $className) {
            if (array_key_exists($className,
                            $this->creatables)) {
                throw new FactoryAlreadyRegisteredException(sprintf(
                        "A factory has already been registered to create %s objects",
                        $className));
            }

            $this->creatables[$className] = $factory;
        }
    }

    public function create(ParameterBag $params)
    {
        $params->require(['className']);
        $className = $params->get('className');
        if (!isset($this->creatables[$className])) {
            throw new FactoryNotFoundException(sprintf(
                    "No factory registered to create %s objects",
                    $className));
        }

        return $this->creatables[$className]->create($params);
    }

}
