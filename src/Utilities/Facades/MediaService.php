<?php

namespace tanyudii\Hero\Utilities\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void logUse(Model $model, string $relationName)
 *
 * @see \tanyudii\Hero\Utilities\Services\MediaService
 */
class MediaService extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'media.service';
    }
}
