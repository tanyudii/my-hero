<?php


namespace App\Utilities;

use Illuminate\Support\Facades\Route;

class RouteCore
{
    public static function routes(array $resources, array $options = []) {
        foreach ($resources as $name) {
            self::route($name, '', $options);
        }
    }

    public static function route($name, string $controller = '', array $options = []) {
        self::createRoute($name, $controller, $options);
    }

    private static function createRoute($name, string $controller = '', array $options = []) {
        $routes = ['index', 'store', 'create', 'show', 'json', 'update', 'edit', 'destroy'];
        $middleware = $options['middleware'] ?? [];

        if (empty($controller)) {
            $controller = str_replace('-', '', ucwords($name, '-')) . 'Controller';
        }

        if (isset($options['except'])) {
            $routes = array_diff($routes, (array) $options['except']);
        }

        if (in_array('index', $routes)) Route::get('/' . $name, $controller .'@index')->middleware($middleware['index'] ?? null)->name($name . '.index');

        if (in_array('store', $routes)) Route::post('/' . $name, $controller .'@store')->middleware($middleware['store'] ?? null)->name($name . '.store');

        if (in_array('create', $routes)) Route::get('/' . $name . '/create', $controller .'@create')->middleware($middleware['create'] ?? null)->name($name . '.create');

        if (in_array('show', $routes)) Route::get('/' . $name . '/{id}', $controller .'@show')->middleware($middleware['show'] ?? null)->name($name . '.show');

        if (in_array('json', $routes)) Route::get('/' . $name . '/json/{id}', $controller .'@show')->middleware($middleware['json'] ?? null)->name($name . '.jspn');

        if (in_array('update', $routes)) Route::put('/' . $name . '/{id}', $controller .'@update')->middleware($middleware['update'] ?? null)->name($name . '.update');

        if (in_array('destroy', $routes)) Route::delete('/' . $name . '/{id}', $controller .'@destroy')->middleware($middleware['destroy'] ?? null)->name($name . '.destroy');

        if (in_array('edit', $routes)) Route::get('/' . $name . '/{id}/edit', $controller .'@edit')->middleware($middleware['edit'] ?? null)->name($name . '.edit');
    }
}
