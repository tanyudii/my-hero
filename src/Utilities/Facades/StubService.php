<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class StubService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stub.service';
    }
}
