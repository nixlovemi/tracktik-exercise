<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\ElectronicItems;
use App\EletronicTypesEnum;
use App\EletronicTypes\Television;
use App\EletronicTypes\Controller;
use App\EletronicTypes\Microwave;

final class EletronicItemsTest extends TestCase
{
    public function testAddItemClassError(): void
    {
        $this->expectException(TypeError::class);

        $item    = new stdClass();
        $ElItems = new ElectronicItems();
        $ElItems->addItem($item);
    }

    public function testAddItemOk(): void
    {
        $ElItems = new ElectronicItems();
        $ElItems->addItem(new Microwave());

        $this->assertIsArray($ElItems->getItems());
        $this->assertEquals(1, $ElItems->getNumberOfItems());
    }

    public function testGetTotalOk(): void
    {
        $ElItems = new ElectronicItems();

        $Microwave      = new Microwave();
        $microwavePrice = 149.99;
        $Microwave->setPrice($microwavePrice);
        $ElItems->addItem($Microwave);

        $Television      = new Television();
        $televisionPrice = 1499.99;
        $Television->setPrice($televisionPrice);

        $Controller      = new Controller(false);
        $controllerPrice = 14.99;
        $Controller->setPrice($controllerPrice);
        $Television->addExtra($Controller);
        $ElItems->addItem($Television);

        $this->assertIsFloat($ElItems->getTotal());
        $this->assertEquals(($microwavePrice + $televisionPrice + $controllerPrice), $ElItems->getTotal());
    }

    public function testGetTotalWithouItem(): void
    {
        $ElItems = new ElectronicItems();
        $total   = $ElItems->getTotal();

        $this->assertIsFloat($total);
        $this->assertEquals(0, $total);
    }

    public function testGetItemsByTypeOk(): void
    {
        $ElItems = new ElectronicItems();

        // Microwaves test
        $nbOfMicrowaves = 3;

        for ($i = 0; $i < $nbOfMicrowaves; $i++) {
            $ElItems->addItem(new Microwave());
        }

        $enumMwType       = EletronicTypesEnum::MICROWAVE();
        $arrItemsByTypeMw = $ElItems->getItemsByType($enumMwType);
        $this->assertIsArray($arrItemsByTypeMw);
        $this->assertEquals($nbOfMicrowaves, count($arrItemsByTypeMw));
        // ===============

        // Television test
        $nbOfTelevisions = 2;

        for ($i = 0; $i < $nbOfTelevisions; $i++) {
            $ElItems->addItem(new Television());
        }

        $enumTvType       = EletronicTypesEnum::TELEVISION();
        $arrItemsByTypeTv = $ElItems->getItemsByType($enumTvType);
        $this->assertIsArray($arrItemsByTypeTv);
        $this->assertEquals($nbOfTelevisions, count($arrItemsByTypeTv));
        foreach ($arrItemsByTypeTv as $TvItem) {
            $this->assertEquals($enumTvType->__toString(), $TvItem->getType());
        }
        // ===============
    }

    public function testGetItemsByTypeEmpty(): void
    {
        $ElItems    = new ElectronicItems();
        $itemByType = $ElItems->getItemsByType(EletronicTypesEnum::MICROWAVE());

        $this->assertIsArray($itemByType);
        $this->assertEquals(0, count($itemByType));
    }

    public function testGetSortedItemsOk(): void
    {
        $ElItems = new ElectronicItems();

        $thirdPrice = 300.00;
        $Microwave  = new Microwave();
        $Microwave->setPrice($thirdPrice);
        $ElItems->addItem($Microwave);

        $firstPrice = 100.00;
        $Television = new Television();
        $Television->setPrice($firstPrice);
        $ElItems->addItem($Television);

        $secondPrice = 200.00;
        $wired       = true;
        $Controller  = new Controller($wired);
        $Controller->setPrice($secondPrice);
        $ElItems->addItem($Controller);

        $sortedItems = $ElItems->getSortedItems();
        $this->assertIsArray($sortedItems);
        $this->assertEquals(3, count($sortedItems));

        $firstItem = $sortedItems[0];
        $this->assertEquals($firstPrice, $firstItem->getPrice());

        $secondItem = $sortedItems[1];
        $this->assertEquals($secondPrice, $secondItem->getPrice());

        $thirdItem = $sortedItems[2];
        $this->assertEquals($thirdPrice, $thirdItem->getPrice());
    }

    public function testInitArrayItemsOk(): void
    {
        $ElItems = new ElectronicItems();
        $items   = $ElItems->getItems();

        $this->assertIsArray($items);
        $this->assertEquals(0, count($items));
    }

    public function testToArrayInitOk(): void
    {
        $ElItems = new ElectronicItems();
        $toArray = $ElItems->toArray();

        $this->assertIsArray($toArray);
        $this->assertArrayHasKey('itemsNbr', $toArray);
        $this->assertEquals(0, $toArray['itemsNbr']);
        $this->assertArrayHasKey('orderTotal', $toArray);
        $this->assertEquals(0, $toArray['orderTotal']);
        $this->assertArrayHasKey('items', $toArray);
        $this->assertEmpty($toArray['items']);
    }

    public function testToArrayItemOk(): void
    {
        $ElItems = new ElectronicItems();

        $Microwave = new Microwave();
        $mvPrice   = 25.99;
        $Microwave->setPrice($mvPrice);
        $ElItems->addItem($Microwave);

        $toArray = $ElItems->toArray();
        $this->assertIsArray($toArray);
        $this->assertArrayHasKey('itemsNbr', $toArray);
        $this->assertEquals(1, $toArray['itemsNbr']);
        $this->assertArrayHasKey('orderTotal', $toArray);
        $this->assertEquals($mvPrice, $toArray['orderTotal']);
        $this->assertArrayHasKey('items', $toArray);
        $this->assertNotEmpty($toArray['items']);
    }
}
