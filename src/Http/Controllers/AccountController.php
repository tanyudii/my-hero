<?php

namespace Smoothsystem\Manager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smoothsystem\Manager\Utilities\Facades\ResourceService;

class AccountController extends Controller
{
    protected $lazyLoadingRelationAccount = [];

    public function account(Request $request)
    {
        $data = config('smoothsystem.models.user')::with($this->lazyLoadingRelationAccount)->findOrFail(Auth::id());

        return ResourceService::jsonResource($data->getResource(), $data);
    }

    public function permission(Request $request)
    {
        $data = config('smoothsystem.models.user')::findOrFail(Auth::id());

        return response()->json([
            'data' => $data->permissions
        ], 200);
    }

    public function revoke(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'success' => true,
        ], 200);
    }
}
