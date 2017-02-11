<?php

namespace Pmc\GigaFactory;

/**
 * @author Paul Court <emails@paulcourt.co.uk>
 */
interface Creator
{
    public function getCreatableList(): array;
}
