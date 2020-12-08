<?php

namespace tanyudii\Hero\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use tanyudii\Hero\Http\Resources\DefaultResource;
use tanyudii\Hero\Utilities\Facades\ExceptionService;
use tanyudii\Hero\Utilities\Facades\ResourceService;

class NotificationController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request) : AnonymousResourceCollection
    {
        $data = [];
        if (Auth::check()) {
            $repository = Auth::user()->notifications()
                ->with('notifiable')
                ->orderByDesc('notifications.created_at');

            if ($request->get('type') == 'read') {
                $repository = $repository->whereNotNull('read_at');
            } else if ($request->get('type') == 'unread') {
                $repository = $repository->whereNull('read_at');
            }

            $data = $request->has('per_page')
                ? $repository->paginate($request->get('per_page'))
                : $repository->get();
        }

        return ResourceService::jsonCollection(DefaultResource::class, $data);
    }

    /**
     * @param Request $Request
     * @param $id
     * @return JsonResource
     */
    public function show(Request $Request, $id) : JsonResource
    {
        $data = null;

        if (Auth::check()) {
            $data = Auth::user()->notifications()
                ->with('notifiable')
                ->findOrFail($id);

            $data->markAsRead();
        }

        return ResourceService::jsonResource(DefaultResource::class,$data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function readAll(Request $request) : JsonResponse
    {
        try {
            DB::beginTransaction();

            if (Auth::check()) {
                Auth::user()->unreadNotifications->markAsRead();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Notification updated.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return ExceptionService::responseJson($e);
        }
    }

}
