<?php
require __DIR__ . '/vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\ElectronicItems;
use App\EletronicTypes\Console;
use App\EletronicTypes\Television;
use App\EletronicTypes\Microwave;
use App\EletronicTypes\Controller;

function createOrdemItemsScenario(): ElectronicItems
{
    // scenario
    $OrderItems = new ElectronicItems();

    //// Console
    $Console = new Console();
    $Console->setPrice(399.99);

    //// extra = The console has 2 remote controllers and 2 wired controllers.
    //// add remote extra
    $nExtras = 2;
    for ($i = 0; $i < $nExtras; $i++) {
        $wired      = false;
        $Controller = new Controller($wired);

        $Console->addExtra($Controller);
    }

    //// add wired extra
    $nExtras = 2;
    for ($i = 0; $i < $nExtras; $i++) {
        $wired      = true;
        $Controller = new Controller($wired);

        $Console->addExtra($Controller);
    }

    $OrderItems->addItem($Console);
    //// End Console

    //// TV #1 = The TV #1 has 2 remote controllers
    $TvOne = new Television();
    $TvOne->setPrice(499.99);

    $nExtras = 2;
    for ($i = 0; $i < $nExtras; $i++) {
        $wired      = false;
        $Controller = new Controller($wired);

        $TvOne->addExtra($Controller);
    }

    $OrderItems->addItem($TvOne);
    //// END TV #1

    //// TV #2 = the TV #2 has 1 remote controller.
    $TvTwo = new Television();
    $TvTwo->setPrice(449.99);

    $nExtras = 1;
    for ($i = 0; $i < $nExtras; $i++) {
        $wired      = false;
        $Controller = new Controller($wired);

        $TvTwo->addExtra($Controller);
    }

    $OrderItems->addItem($TvTwo);
    //// END TV #2

    //// Microwave
    $Microwave = new Microwave();
    $Microwave->setPrice(49.99);
    $OrderItems->addItem($Microwave);
    //// End Microwave
    // End scenario

    return $OrderItems;
}

$OrderItems = createOrdemItemsScenario();

echo "<pre>";
# var_dump($OrderItems->getItems());
# var_dump($OrderItems->getItemsByType(\App\EletronicTypesEnum::TELEVISION()));
# var_dump($OrderItems->getSortedItems());
# var_dump($OrderItems->getTotal());