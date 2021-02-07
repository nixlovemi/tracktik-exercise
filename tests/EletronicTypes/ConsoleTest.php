<?php
# https://phpunit.readthedocs.io/en/9.5/assertions.html
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\EletronicTypesEnum;
use App\EletronicTypes\Console;

final class ConsoleTest extends TestCase
{
    public function testConsoleMaxExtras(): void
    {
        $Console = new Console();
        $this->assertEquals(4, $Console->getMaxExtras());
    }

    public function testConsoleRightEletronicType(): void
    {
        $Console = new Console();
        $this->assertEquals(EletronicTypesEnum::CONSOLE()->__toString(), $Console->getType());
    }

    public function testConsoleCantBeAddedAsExtra(): void
    {
        $Console = new Console();
        $this->assertIsBool($Console->getCanBeAddedAsExtra());
        $this->assertEquals(false, $Console->getCanBeAddedAsExtra());
    }
}
