<?php

namespace tanyudii\Hero\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Notification
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user() ?? $request->user('api');
        if ($user && $request->has('notif_id')) {
            $notificationId = $request->get('notif_id');
            $user->notifications()
                ->whereNull('notifications.read_at')
                ->whereIn('notifications.id', arr_strict($notificationId))
                ->get()
                ->markAsRead();
        }


        return $next($request);
    }
}
