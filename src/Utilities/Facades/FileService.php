<?php

namespace Smoothsystem\Manager\Utilities\Facades;

use Illuminate\Support\Facades\Facade;

class FileService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'file.service';
    }
}
