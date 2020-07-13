<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FileService
{
    public function store(Request $request, $key, $disk, $path) {
        try {
            $uploaded = [];

            if ($request->hasFile($key)) {
                $files = $request->file($key);
                if (is_array($files)) {
                    foreach ($files as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $encodedName = Carbon::now()->format('Y_m_d_his_') . Str::random() . '.' . $extension;

                        array_push($uploaded, (object) [
                            'name' => $fileName,
                            'encoded_name' => $encodedName,
                            'size' => $file->getSize(),
                            'extension' => $extension,
                            'path' => $file->storeAs($path,$encodedName,['disk' => $disk]),
                            'disk' => $disk,
                        ]);
                    }
                } else {
                    $fileName = $files->getClientOriginalName();
                    $extension = $files->getClientOriginalExtension();
                    $encodedName = Carbon::now()->format('Y_m_d_his_') . Str::random() . '.' . $extension;

                    array_push($uploaded, (object) [
                        'name' => $fileName,
                        'encoded_name' => $encodedName,
                        'size' => $files->getSize(),
                        'extension' => $extension,
                        'path' => $files->storeAs($path,$encodedName,['disk' => $disk]),
                        'disk' => $disk,
                    ]);
                }
            }

            return $uploaded;
        } catch (\Exception $e) {
            \Smoothsystem\Manager\Utilities\Facades\ExceptionService::log($e);

            return [];
        }
    }
}
