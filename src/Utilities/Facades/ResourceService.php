<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Facade;

/**
 * @method static AnonymousResourceCollection jsonCollection($resource, $data, $additional = [])
 * @method static JsonResource jsonResource($resource, $data, $additional = [])
 *
 * @see \tanyudii\Hero\Utilities\Services\ResourceService
 */
class ResourceService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'resource.service';
    }
}
