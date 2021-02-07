<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ElectronicItem;
use App\EletronicTypesEnum;
use App\EletronicTypes\Controller;
use App\EletronicTypes\Microwave;

final class EletronicItemTest extends TestCase
{
    public function testConstructMaxItemsError(): void
    {
        $this->expectException(Exception::class);

        $wrongMaxExtras = -5;
        $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $wrongMaxExtras
            ]
        );
    }

    public function testConstructVarsOk(): void
    {
        $maxExtras         = 1;
        $canBeAddedAsExtra = true;
        $EletronicItem     = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
                $canBeAddedAsExtra,
            ]
        );

        $this->assertEquals(EletronicTypesEnum::CONSOLE()->__toString(), $EletronicItem->getType());
        $this->assertEquals($maxExtras, $EletronicItem->getMaxExtras());
        $this->assertEquals($canBeAddedAsExtra, $EletronicItem->getCanBeAddedAsExtra());
    }

    public function testGetPriceOk(): void
    {
        $price         = 5.99;
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $EletronicItem->setPrice($price);

        $this->assertIsFloat($EletronicItem->getPrice());
        $this->assertEquals($price, $EletronicItem->getPrice());
    }

    public function testSetNegativePrice(): void
    {
        $this->expectException(Exception::class);

        $price         = -5.99;
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $EletronicItem->setPrice($price);
    }

    public function testGetTypeOk(): void
    {
        $price         = 5.99;
        $maxExtras     = 0;
        $eletronicType = EletronicTypesEnum::CONSOLE();

        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                $eletronicType,
                $maxExtras,
            ]
        );
        $EletronicItem->setPrice($price);

        $this->assertIsString($EletronicItem->getType());
        $this->assertEquals($eletronicType->__toString(), $EletronicItem->getType());
    }

    public function testGetCanBeAddedAsExtraOk(): void
    {
        $maxExtras         = 1;
        $canBeAddedAsExtra = true;
        $EletronicItem     = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
                $canBeAddedAsExtra,
            ]
        );

        $this->assertIsBool($EletronicItem->getCanBeAddedAsExtra());
        $this->assertEquals($canBeAddedAsExtra, $EletronicItem->getCanBeAddedAsExtra());
    }

    public function testGetMaxExtrasOk(): void
    {
        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $this->assertIsInt($EletronicItem->getMaxExtras());
        $this->assertEquals($maxExtras, $EletronicItem->getMaxExtras());
    }

    public function testGetExtrasOk(): void
    {
        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $numberOfExtras = 2;
        $wired          = false;
        for ($i = 0; $i < $numberOfExtras; $i++) {
            $Controller = new Controller($wired);
            $EletronicItem->addExtra($Controller);
        }

        $this->assertIsArray($EletronicItem->getExtras());
        $this->assertEquals($numberOfExtras, $EletronicItem->getExtrasCount());
    }

    public function testGetExtraOnInit(): void
    {
        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $extras = $EletronicItem->getExtras();
        $this->assertIsArray($extras);
        $this->assertEquals(0, count($extras));
    }

    public function testAddExtraCantBeAdded(): void
    {
        $this->expectException(Exception::class);

        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $EletronicItem->addExtra(new Microwave);
    }

    public function testAddExtraMoreThenMax(): void
    {
        $this->expectException(Exception::class);

        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $Controller = new Controller(true);
        for ($i = 0; $i < ($maxExtras + 1); $i++) {
            $EletronicItem->addExtra($Controller);
        }
    }

    public function testAddExtraClassError(): void
    {
        $this->expectException(TypeError::class);

        $item          = new stdClass();
        $maxExtras     = 4;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $EletronicItem->addExtra($item);
    }

    public function testGetTotalWithExtraOk(): void
    {
        $maxExtras     = 1;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $eletronicPrice = 200.87;
        $EletronicItem->setPrice($eletronicPrice);

        $Controller = new Controller(false);
        $controllerPrice = 1.99;
        $Controller->setPrice($controllerPrice);

        $EletronicItem->addExtra($Controller);
        $this->assertIsFloat($EletronicItem->getTotalWithExtra());
        $this->assertEquals(($eletronicPrice + $controllerPrice), $EletronicItem->getTotalWithExtra(), '', 0.0001);
    }

    public function testEletronicItemDefaultsOk(): void
    {
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $this->assertIsFloat($EletronicItem->getPrice());
        $this->assertEquals(0.00, $EletronicItem->getPrice());

        $this->assertIsInt($EletronicItem->getMaxExtras());
        $this->assertEquals(0, $EletronicItem->getMaxExtras());

        $this->assertIsArray($EletronicItem->getExtras());
        $this->assertEquals(0, count($EletronicItem->getExtras()));

        $this->assertIsBool($EletronicItem->getCanBeAddedAsExtra());
        $this->assertEquals(false, $EletronicItem->getCanBeAddedAsExtra());
    }

    public function testToArrayEmpty(): void
    {
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $eletronicArray = $EletronicItem->toArray();
        $this->assertIsArray($eletronicArray);
        $this->assertArrayHasKey('type', $eletronicArray);
    }

    public function testToArrayWithoutPrice(): void
    {
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );

        $eletronicArray = $EletronicItem->toArray();
        $this->assertIsArray($eletronicArray);
        $this->assertArrayHasKey('type', $eletronicArray);
        $this->assertArrayNotHasKey('price', $eletronicArray);
    }

    public function testToArrayPriceOk(): void
    {
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $itemPrice = 1.99;
        $EletronicItem->setPrice($itemPrice);

        $eletronicArray = $EletronicItem->toArray();
        $this->assertIsArray($eletronicArray);
        $this->assertArrayHasKey('type', $eletronicArray);
        $this->assertArrayHasKey('price', $eletronicArray);
        $this->assertEquals($itemPrice, $eletronicArray['price']);
    }

    public function testToArrayHasExtraTotalOk(): void
    {
        $maxExtras     = 1;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $itemPrice = 10.99;
        $EletronicItem->setPrice($itemPrice);

        $Controller      = new Controller(true);
        $controllerPrice = 1.99;
        $Controller->setPrice($controllerPrice);
        $EletronicItem->addExtra($Controller);

        $eletronicArray = $EletronicItem->toArray();
        $this->assertIsArray($eletronicArray);
        $this->assertArrayHasKey('total', $eletronicArray);
        $this->assertEquals($itemPrice + $controllerPrice, $eletronicArray['total']);
        $this->assertArrayHasKey('extras', $eletronicArray);
    }

    public function testToArrayNoExtras(): void
    {
        $maxExtras     = 0;
        $EletronicItem = $this->getMockForAbstractClass(
            ElectronicItem::class,
            [
                EletronicTypesEnum::CONSOLE(),
                $maxExtras,
            ]
        );
        $itemPrice = 10.99;
        $EletronicItem->setPrice($itemPrice);

        $eletronicArray = $EletronicItem->toArray();
        $this->assertIsArray($eletronicArray);
        $this->assertArrayHasKey('price', $eletronicArray);
        $this->assertEquals($itemPrice, $eletronicArray['price']);
        $this->assertArrayHasKey('total', $eletronicArray);
        $this->assertEquals($itemPrice, $eletronicArray['total']);
        $this->assertArrayNotHasKey('extras', $eletronicArray);
    }
}
