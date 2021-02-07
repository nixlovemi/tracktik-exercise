<?php

namespace App\EletronicTypes;

use App\ElectronicItem;
use App\EletronicTypesEnum;

class Console extends ElectronicItem
{
    public function __construct()
    {
        $maxExtras = 4;
        parent::__construct(EletronicTypesEnum::CONSOLE(), $maxExtras);
    }
}
