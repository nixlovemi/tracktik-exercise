<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\EletronicTypesEnum;
use App\EletronicTypes\Microwave;

final class MicrowaveTest extends TestCase
{
    public function testMicrowaveMaxExtras(): void
    {
        $Microwave = new Microwave();
        $this->assertEquals(0, $Microwave->getMaxExtras());
    }

    public function testMicrowaveRightEletronicType(): void
    {
        $Microwave = new Microwave();
        $this->assertEquals(EletronicTypesEnum::MICROWAVE()->__toString(), $Microwave->getType());
    }

    public function testMicrowaveCantBeAddedAsExtra(): void
    {
        $Microwave = new Microwave();
        $this->assertIsBool($Microwave->getCanBeAddedAsExtra());
        $this->assertEquals(false, $Microwave->getCanBeAddedAsExtra());
    }
}
