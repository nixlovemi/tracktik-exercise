<?php

namespace App;

use App\EletronicTypesEnum;
use \Exception;

abstract class ElectronicItem
{
    /**
     * @var float
     */
    private $price = 0.00;

    /**
     * @var string
     */
    private $type;

    /**
     * The max number of extras a Eletronic can have. Use -1 to unlimited and 0 to no extras.
     * 
     * @var int
     */
    private $maxExtras = 0;

    /**
     * @var array
     */
    protected $extras = [];

    /**
     * Flag to check if the eletronic can be added as extra
     *
     * @var boolean
     */
    private $canBeAddedAsExtra = false;

    /**
     * @param EletronicTypesEnum $type
     * @param integer $maxExtras
     * @param boolean $canBeAddedAsExtra
     * @throws Exception
     */
    public function __construct(EletronicTypesEnum $type, int $maxExtras, bool $canBeAddedAsExtra = false)
    {
        if ($maxExtras < -1) {
            throw new \Exception("The maxExtras must be greater or equal to -1", 400);
        }

        $this->type              = $type;
        $this->maxExtras         = $maxExtras;
        $this->canBeAddedAsExtra = $canBeAddedAsExtra;
    }

    /**
     * @return float
     */
    function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    function getType(): string
    {
        return $this->type->__toString();
    }

    /**
     * @return boolean
     */
    function getCanBeAddedAsExtra(): bool
    {
        return $this->canBeAddedAsExtra;
    }

    /**
     * @return integer
     */
    function getMaxExtras(): int
    {
        return $this->maxExtras;
    }

    /**
     * @return array
     */
    function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @return integer
     */
    function getExtrasCount(): int
    {
        return count($this->getExtras());
    }

    /**
     * @return float
     */
    function getTotalWithExtra(): float
    {
        $total = $this->getPrice();
        foreach ($this->getExtras() as $Extra) {
            $total += $Extra->getPrice();
        }

        return $total;
    }

    /**
     * @param ElectronicItem $item
     * @return void
     * @throws Exception
     */
    function addExtra(ElectronicItem $item): void
    {
        if ($item->getCanBeAddedAsExtra() === false) {
            throw new Exception("This eletronic can't be added as extra!", 400);
        }

        if ($this->getMaxExtras() !== -1 && $this->getExtrasCount() >= $this->getMaxExtras()) {
            throw new Exception("You can't add more extras to this eletronic!", 400);
        }

        $this->extras[] = $item;
    }

    /**
     * @param float $price
     * @return void
     * @throws Exception
     */
    function setPrice(float $price): void
    {
        if ($price < 0) {
            throw new \Exception("The must be greater or equal to zero!", 400);
        }
        $this->price = $price;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $arrJson = [];

        if ($this->getPrice() > 0) $arrJson['price'] = $this->getPrice();
        if ($this->getTotalWithExtra() > 0) $arrJson['total'] = $this->getTotalWithExtra();

        $arrJson['type']  = $this->getType();

        // if the eletronic can have extra
        if ($this->getMaxExtras() != 0) {
            $arrJson['extras'] = [];

            $extras = $this->getExtras();
            foreach ($extras as $eletronicExtra) {
                $arrJson['extras'][] = $eletronicExtra->toArray();
            }
        }

        return $arrJson;
    }
}
