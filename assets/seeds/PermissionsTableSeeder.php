<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = Route::getRoutes()->getRoutes();
        foreach ($routes as $route) {
            $middleware = $route->gatherMiddleware();
            if (!in_array('hero.gate', $middleware) || is_null($route->getName())) {
                continue;
            }

            $permission = [
                'name' => $route->getName(),
                'controller' => Arr::first(explode('@', $route->getActionName())),
                'method' => $route->getActionMethod(),
            ];

            if (config('hero.models.permission')::where($permission)->exists()) {
                continue;
            }

            config('hero.models.permission')::create($permission);
        }
    }
}
