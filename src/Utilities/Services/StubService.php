<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Exception;
use Throwable;

class StubService
{
    /**
     * @param $type
     * @return string|array|void
     * @throws Throwable
     */
    public function getStub($type)
    {
        try {
            $path = config('smoothsystem.stub.path', __DIR__ . '/../Stubs/') . '/' . $type . '.stub';

            return file_get_contents($path);
        } catch (Exception $e) {
            \Smoothsystem\Manager\Utilities\Facades\ExceptionService::log($e);
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
