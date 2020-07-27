<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Facade;
use Smoothsystem\Manager\Http\Resources\BaseResource;

/**
 * @method static AnonymousResourceCollection jsonCollection($resource, $data, $additional = [])
 * @method static BaseResource jsonResource($resource, $data, $additional = [])
 *
 * @see \Smoothsystem\Manager\Utilities\Services\ResourceService
 */
class ResourceService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'resource.service';
    }
}
