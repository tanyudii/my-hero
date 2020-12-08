<?php

namespace tanyudii\Hero\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use tanyudii\Hero\Entities\Media;
use tanyudii\Hero\Http\Requests\MediaCreateRequest;
use tanyudii\Hero\Utilities\Facades\ExceptionService;
use tanyudii\Hero\Utilities\Facades\FileService;
use tanyudii\Hero\Utilities\Traits\RestCoreController;

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

            if ($request->wantsJson()) {
                return ($this->show($request, $data->id))->additional([
                    'success' => true,
                    'message' => 'Data created.'
                ]);
            }

            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();

            if ($request->wantsJson()) {
                return ExceptionService::responseJson($e);
            }

            return ExceptionService::response($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return StreamedResponse
     */
    public function download(Request $request, $id) : StreamedResponse
    {
        $media = $this->repository->findOrFail($id);

        $disk = Storage::disk($media->disk);
        if (!(clone $disk)->exists($media->path)) {
            abort(404);
        }

        return $disk->download($media->path);
    }
}
