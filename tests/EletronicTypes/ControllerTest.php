<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\EletronicTypesEnum;
use App\EletronicTypes\Controller;

final class ControllerTest extends TestCase
{
    public function testControllerHasPropertyWired(): void
    {
        $Controller = new Controller(true);
        $this->assertObjectHasAttribute('wired', $Controller);
    }

    public function testControllerWiredOk(): void
    {
        $wired      = true;
        $Controller = new Controller($wired);
        $this->assertIsBool($Controller->getWired());
        $this->assertEquals($wired, $Controller->getWired());
    }

    public function testControllerMaxExtras(): void
    {
        $Controller = new Controller(true);
        $this->assertEquals(0, $Controller->getMaxExtras());
    }

    public function testControllerRightEletronicType(): void
    {
        $Controller = new Controller(true);
        $this->assertEquals(EletronicTypesEnum::CONTROLLER()->__toString(), $Controller->getType());
    }

    public function testControllerCantBeAddedAsExtra(): void
    {
        $Controller = new Controller(true);
        $this->assertIsBool($Controller->getCanBeAddedAsExtra());
        $this->assertEquals(true, $Controller->getCanBeAddedAsExtra());
    }
}
