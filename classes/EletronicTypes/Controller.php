<?php

namespace App\EletronicTypes;

use App\ElectronicItem;
use App\EletronicTypesEnum;

class Controller extends ElectronicItem
{
    /**
     * Set if the eletronic is wired or wireless
     * 
     * @var bool
     */
    private $wired = null;

    /**
     * @param boolean $isWired
     */
    public function __construct(bool $isWired)
    {
        $maxExtras = 0;
        $canBeAddExtra = true;

        parent::__construct(EletronicTypesEnum::CONTROLLER(), $maxExtras, $canBeAddExtra);
        $this->wired = $isWired;
    }

    /**
     * @return boolean
     */
    function getWired(): bool
    {
        return $this->wired;
    }

    function toArray(): array
    {
        $arrJson = parent::toArray();
        $arrJson['wired']  = $this->getWired();

        return $arrJson;
    }
}
