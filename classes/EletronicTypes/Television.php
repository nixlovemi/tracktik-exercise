<?php

namespace App\EletronicTypes;

use App\ElectronicItem;
use App\EletronicTypesEnum;

class Television extends ElectronicItem
{
    public function __construct()
    {
        $maxExtras = -1; #unlimited
        parent::__construct(EletronicTypesEnum::TELEVISION(), $maxExtras);
    }
}
