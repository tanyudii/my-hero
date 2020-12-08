<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static false|string getStub(string $type)
 *
 * @see \tanyudii\Hero\Utilities\Services\StubService
 */
class StubService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'stub.service';
    }
}
