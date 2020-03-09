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

    public static function apiRoutes(array $resources, array $options = []) {
        foreach ($resources as $name) {
            self::apiRoute($name, '', $options);
        }
    }

    public static function apiRoute($name, string $controller = '', array $options = []) {
        $options['except'] = array_merge($options['except'], ['create','json','edit']);

        self::createRoute($name, $controller, $options);
    }

    private static function createRoute($name, string $controller = '', array $options = []) {
        $only = ['index', 'store', 'create', 'show', 'json', 'update', 'edit', 'destroy'];
        $middleware = $options['middleware'] ?? [];

        if (empty($controller)) {
            $controller = str_replace('-', '', ucwords($name, '-')) . 'Controller';
        }

        if (isset($options['except'])) {
            $only = array_diff($only, (array) $options['except']);
        }

        if (in_array('index', $only))
            Route::get('/' . $name, $controller .'@index')->middleware($middleware['index'] ?? null)->name($name . '.index');

        if (in_array('store', $only))
            Route::post('/' . $name, $controller .'@store')->middleware($middleware['store'] ?? null)->name($name . '.store');

        if (in_array('create', $only))
            Route::get('/' . $name . '/create', $controller .'@create')->middleware($middleware['create'] ?? null)->name($name . '.create');

        if (in_array('show', $only))
            Route::get('/' . $name . '/{id}', $controller .'@show')->middleware($middleware['show'] ?? null)->name($name . '.show');

        if (in_array('json', $only))
            Route::get('/' . $name . '/json/{id}', $controller .'@show')->middleware($middleware['json'] ?? null)->name($name . '.json');

        if (in_array('update', $only))
            Route::put('/' . $name . '/{id}', $controller .'@update')->middleware($middleware['update'] ?? null)->name($name . '.update');

        if (in_array('destroy', $only))
            Route::delete('/' . $name . '/{id}', $controller .'@destroy')->middleware($middleware['destroy'] ?? null)->name($name . '.destroy');

        if (in_array('edit', $only))
            Route::get('/' . $name . '/{id}/edit', $controller .'@edit')->middleware($middleware['edit'] ?? null)->name($name . '.edit');
    }
}
