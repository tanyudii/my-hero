<?php

namespace tanyudii\Hero\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use tanyudii\Hero\Utilities\Facades\ResourceService;

class AccountController extends Controller
{
    /**
     * @var array
     */
    protected $lazyLoadingRelationAccount = [];

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function account(Request $request) : JsonResource
    {
        $data = config('hero.models.user')::with($this->lazyLoadingRelationAccount)->findOrFail(Auth::id());

        return ResourceService::jsonResource($data->getResource(), $data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function permission(Request $request) : JsonResponse
    {
        $data = config('hero.models.user')::findOrFail(Auth::id());

        return response()->json([
            'data' => $data->permissions
        ], 200);
    }
}
