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
    protected $policy = false;
    protected $view;
    protected $page;

    public function index(Request $request) {
        if (empty($request->per_page)) {
            $data = $this->repository->all();
        } else {
            $data = $this->repository->paginate($request->per_page);
        }

        if (request()->wantsJson() || empty($this->view) || !view()->exists("$this->view.index")) {
            return is_subclass_of($this->resource, JsonResource::class)
                ? $this->resource::collection($data)
                : $data;
        }

        return view("$this->view.index", [
            'page' => $this->page,
        ]);
    }

    public function select(Request $request, $id = null) {
        if ($id || $request->id) {
            return new SelectResource($this->repository->find($id ?? $request->id));
        }

        if (empty($request->per_page)) {
            $data = $this->repository->all();
        } else {
            $data = $this->repository->paginate($request->per_page);
        }

        if (is_subclass_of($this->selectResource, JsonResource::class)) {
            return $this->selectResource::collection($data);
        }

        return SelectResource::collection($data);
    }

    public function create(Request $request)
    {
        return view("$this->view.detail");
    }

    public function show(Request $request, $id) {
        $data = $this->repository->find($id);

        if ($this->policy) {
            $this->authorize('view', $data);
        }

        if (request()->wantsJson() || empty($this->view) || !view()->exists("$this->view.detail")) {
            return is_subclass_of($this->resource, JsonResource::class)
                ? new $this->resource($data)
                : $data;
        }

        return view("$this->view.detail",[
            'data' => $data,
            'page' => $this->page,
        ]);
    }

    public function edit(Request $request, $id) {
        $data = $this->repository->find($id);

        if ($this->policy) {
            $this->authorize('update', $data);
        }

        if (empty($this->view) || !view()->exists("$this->view.detail")) {
            return is_subclass_of($this->resource, JsonResource::class)
                ? new $this->resource($data)
                : $data;
        }

        return view("$this->view.detail",[
            'data' => $data,
            'page' => $this->page,
        ]);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->repository->findOrFail($id);

            $this->repository->destroy($id);

            DB::commit();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data deleted.'
                ]);
            }

            return redirect()->back()->with('message', 'Data deleted.');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'   => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}
