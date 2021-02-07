<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\EletronicTypesEnum;
use App\EletronicTypes\Television;
use App\EletronicTypes\Controller;

final class TelevisionTest extends TestCase
{
    public function testTelevisionMaxExtras(): void
    {
        $Television = new Television();
        $this->assertEquals(-1, $Television->getMaxExtras());
    }

    public function testTelevisionRightEletronicType(): void
    {
        $Television = new Television();
        $this->assertEquals(EletronicTypesEnum::TELEVISION()->__toString(), $Television->getType());
    }

    public function testTelevisionCantBeAddedAsExtra(): void
    {
        $Television = new Television();
        $this->assertIsBool($Television->getCanBeAddedAsExtra());
        $this->assertEquals(false, $Television->getCanBeAddedAsExtra());
    }

    /**
     * an attenpt to recreate a "no max" number of extras
     *
     * @return void
     */
    public function testTelevision1000Extras(): void
    {
        $Television = new Television();
        $Controller = new Controller(true);
        $nbrExtras  = 1000;
        for ($i = 0; $i < $nbrExtras; $i++) {
            $Television->addExtra($Controller);
        }

        $extras = $Television->getExtras();
        $this->assertIsArray($extras);
        $this->assertEquals($nbrExtras, count($extras));
    }
}
