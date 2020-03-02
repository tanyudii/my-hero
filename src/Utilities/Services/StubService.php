<?php

namespace Smoothsystem\Core\Utilities\Services;

class StubService
{
    public static function getStub($type)
    {
        return config('smoothsystem.stub.path', __DIR__ . '/../Stubs/') . '/' . $type . '.stub';
    }
}
