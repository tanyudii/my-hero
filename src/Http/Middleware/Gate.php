<?php

namespace Smoothsystem\Core\Http\Middleware;

use Closure;

class Gate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*$actionName = class_basename($request->route()->getActionname());

        abort(401);*/

        return $next($request);
    }
}
