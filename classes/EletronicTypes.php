<?php

namespace App;

use MyCLabs\Enum\Enum;

/**
 * Eletronic Types enum. Use this ENUM to control the Eletronic Types.
 * 
 * Library used: MyCLabs (https://packagist.org/packages/myclabs/php-enum)
 * 
 * @method static EletronicTypesEnum TELEVISION()
 * @method static EletronicTypesEnum CONSOLE()
 * @method static EletronicTypesEnum MICROWAVE()
 * @method static EletronicTypesEnum CONTROLLER()
 */
final class EletronicTypesEnum extends Enum
{
    private const TELEVISION = 'television';
    private const CONSOLE    = 'console';
    private const MICROWAVE  = 'microwave';
    private const CONTROLLER = 'controller';
}
