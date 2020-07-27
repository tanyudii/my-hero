<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;
use Smoothsystem\Manager\Utilities\Entities\BaseEntity;

/**
 * @method static void logUse(BaseEntity $model, string $relationName)
 *
 * @see \Smoothsystem\Manager\Utilities\Services\FileLogService
 */
class FileLogService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'file_log.service';
    }
}
