<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileService
{
    public function store(Request $request, $key, $disk, $path) {
        if ($request->hasFile($key)) {
            $uploaded = [];

            try {
                $files = $request->file($key);
                if (is_array($files)) {
                    foreach ($files as $file) {
                        $fileName = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $encodedName = now()->format('Y_m_d_his_') . Str::random() . '.' . $extension;

                        $file->storeAs($path,$encodedName,['disk' => $disk]);

                        array_push($uploaded, (object) [
                            'file_name' => $fileName,
                            'path' =>"$path/$encodedName",
                        ]);
                    }
                } else {
                    $fileName = $files->getClientOriginalName();
                    $extension = $files->getClientOriginalExtension();
                    $encodedName = now()->format('Y_m_d_his_') . Str::random() . '.' . $extension;

                    $files->storeAs($path,$encodedName,['disk' => $disk]);

                    array_push($uploaded, (object) [
                        'file_name' => $fileName,
                        'path' =>"$path/$encodedName",
                    ]);
                }

            } catch (\Exception $e) {
                ExceptionService::log($e);
            }

            return $uploaded;
        }

        return [];
    }
}
