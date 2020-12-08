<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string generateNumber(string $entity, $date = null, $subjectId = null)
 *
 * @see \tanyudii\Hero\Utilities\Services\NumberSettingService
 */
class NumberSettingService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'number-setting.service';
    }
}
