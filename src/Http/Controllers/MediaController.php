<?php

namespace Smoothsystem\Manager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Smoothsystem\Manager\Entities\Media;
use Smoothsystem\Manager\Http\Requests\MediaCreateRequest;
use Smoothsystem\Manager\Utilities\Facades\ExceptionService;
use Smoothsystem\Manager\Utilities\Facades\FileService;
use Smoothsystem\Manager\Utilities\Traits\RestCoreController;

class MediaController extends Controller
{
    use RestCoreController {
        RestCoreController::__construct as private __restConstruct;
    }

    public function __construct(Media $repository)
    {
        $this->repository = $repository;
        $this->__restConstruct();
    }

    public function store(MediaCreateRequest $request)
    {
        try {
            DB::beginTransaction();

            $merge = [];

            $uploads = FileService::store($request, 'file', $request->get('disk'), $request->get('path'));
            foreach ($uploads as $name => $file) {
                $merge['name'] = $file->name;
                $merge['encoded_name'] = $file->encoded_name;
                $merge['size'] = $file->size;
                $merge['extension'] = $file->extension;
                $merge['path'] = $file->path;
                $merge['disk'] = $file->disk;
            }

            $request->merge($merge);

            $data = $this->repository->create($request->only($this->fillable));

            DB::commit();

            return ($this->show($request, $data->id))->additional([
                'success' => true,
                'message' => 'Data created.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return ExceptionService::responseJson($e);
        }
    }

    public function download(Request $request, $id) {
        $media = $this->repository->findOrFail($id);

        $disk = Storage::disk($media->disk);
        if (!(clone $disk)->exists($media->path)) {
            return abort(404);
        }

        return $disk->download($media->path);
    }
}
