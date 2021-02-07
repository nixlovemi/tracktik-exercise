<?php

namespace App\EletronicTypes;

use App\ElectronicItem;
use App\EletronicTypesEnum;

class Microwave extends ElectronicItem
{
    public function __construct()
    {
        $maxExtras = 0;
        parent::__construct(EletronicTypesEnum::MICROWAVE(), $maxExtras);
    }
}
