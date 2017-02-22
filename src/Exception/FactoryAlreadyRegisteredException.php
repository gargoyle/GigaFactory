<?php

namespace Pmc\GigaFactory\Exception;

/**
 * Thrown when attempting to add a factory to the composite which reports being able
 * to create an object whose class has already been registered.
 *
 * @author Gargoyle <g@rgoyle.com>
 */
class FactoryAlreadyRegisteredException extends \DomainException
{
    
}
