<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void mediaService()
 * @method static void notificationService()
 * @method static void numberSettingService()
 *
 * @see \tanyudii\Hero\Utilities\Services\RouteService
 */
class RouteService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'route.service';
    }
}
