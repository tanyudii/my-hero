<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void log($e)
 * @method static JsonResponse responseJson($e)
 * @method static RedirectResponse response($e)
 *
 * @see \tanyudii\Hero\Utilities\Services\ExceptionService
 */
class ExceptionService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'exception.service';
    }
}
