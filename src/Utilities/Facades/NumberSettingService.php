<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string generateNumber(string $entity, $date = null, $subjectId = null)
 *
 * @see \Smoothsystem\Manager\Utilities\Services\NumberSettingService
 */
class NumberSettingService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'number-setting.service';
    }
}
