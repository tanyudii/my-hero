<?php

use Illuminate\Database\Seeder;

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
            if ($route->getPrefix() != 'api' || !$route->getName()) {
                continue;
            }

            config('smoothsystem.models.permission')::create([
                'name' => $route->getName(),
                'controller' => \Illuminate\Support\Arr::first(explode('@', $route->getActionName())),
                'method' => $route->getActionMethod(),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
