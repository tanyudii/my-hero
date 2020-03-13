<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class RouteService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'route-core.service';
    }
}
