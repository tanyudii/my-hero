<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void logUse(Model $model, string $relationName)
 *
 * @see \Smoothsystem\Manager\Utilities\Services\MediaService
 */
class MediaService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'media.service';
    }
}
