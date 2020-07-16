<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class FileLogService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'file_log.service';
    }
}
