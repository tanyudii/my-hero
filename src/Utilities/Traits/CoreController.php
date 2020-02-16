<?php

namespace Smoothsystem\Core\Utilities\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Smoothsystem\Core\Http\Resources\SelectResource;

trait CoreController
{
    protected $repository;
    protected $resource;
    protected $selectResource;

    public function index(Request $request) {
        if (empty($request->per_page)) {
            $data = $this->repository->all();
        } else {
            $data = $this->repository->paginate($request->per_page);
        }

        if (is_subclass_of($this->resource, JsonResource::class)) {
            return new $this->resource($data);
        }

        return $data;
    }

    public function select(Request $request) {
        if (empty($request->per_page)) {
            $data = $this->repository->all();
        } else {
            $data = $this->repository->paginate($request->per_page);
        }

        if (is_subclass_of($this->selectResource, JsonResource::class)) {
            return new $this->selectResource($data);
        }

        return SelectResource::collection($data);
    }

    public function show(Request $request, $id) {
        $data = $this->repository->find($id);

        if (is_subclass_of($this->resource, JsonResource::class)) {
            return new $this->resource($data);
        }

        return $data;
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $this->repository->findOrFail($id);

            $this->repository->destroy($id);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data deleted.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'   => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getRepository() {
        return $this->repository;
    }
}
