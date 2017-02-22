<?php

namespace Pmc\GigaFactory;

/**
 * @author Gargoyle <g@rgoyle.com>
 */
interface Creator
{
    public function getCreatableList(): array;
}
