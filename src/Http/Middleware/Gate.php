<?php

namespace Smoothsystem\Manager\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gate
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
        if (!Auth::check()) {
            abort(401);
        }

        $actionName = class_basename($request->route()->getName());
        if (!Auth::user()->authorized($actionName)) {
            abort(401);
        }

        return $next($request);
    }
}
