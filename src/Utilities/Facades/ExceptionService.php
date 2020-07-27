<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void log($e)
 * @method static JsonResponse responseJson($e)
 *
 * @see \Smoothsystem\Manager\Utilities\Services\ExceptionService
 */
class ExceptionService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'exception.service';
    }
}
