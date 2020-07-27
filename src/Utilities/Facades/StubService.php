<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static false|string getStub()
 *
 * @see \Smoothsystem\Manager\Utilities\Services\StubService
 */
class StubService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'stub.service';
    }
}
