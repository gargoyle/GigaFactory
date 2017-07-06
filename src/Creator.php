<?php

namespace Pmc\GigaFactory;

use Pmc\ObjectLib\ParameterBag;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
interface Creator
{
    public function getCreatableList(): array;
    public function create(ParameterBag $data);
}
