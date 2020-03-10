<?php

namespace Smoothsystem\Manager\Utilities\Services;

class StubService
{
    public function getStub($type)
    {
        $path = config('smoothsystem.stub.path', __DIR__ . '/../Stubs/') . '/' . $type . '.stub';

        return file_get_contents($path);
    }
}
