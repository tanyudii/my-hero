<?php

namespace Smoothsystem\Manager\Utilities;

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
        $options['except'] = array_merge($options['except'] ?? [], ['create','json','edit']);

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
            Route::get("/{$name}","{$controller}@index")->name($name . '.index')->middleware($middleware['index'] ?? null);

        if (in_array('store', $only))
            Route::post("/{$name}","{$controller}@store")->name($name . '.store')->middleware($middleware['store'] ?? null);

        if (in_array('create', $only))
            Route::get("/{$name}","{$controller}@create")->name($name . '.create')->middleware($middleware['create'] ?? null);

        if (in_array('show', $only))
            Route::get("/{$name}/{id}","{$controller}@show")->name($name . '.show')->middleware($middleware['show'] ?? null);

        if (in_array('json', $only))
            Route::get("/{$name}/json/{id}","{$controller}@json")->name($name . '.json')->middleware($middleware['json'] ?? null);

        if (in_array('update', $only))
            Route::put("/{$name}/json/{id}","{$controller}@update")->name($name . '.update')->middleware($middleware['update'] ?? null);

        if (in_array('destroy', $only))
            Route::delete("/{$name}/json/{id}","{$controller}@destroy")->name($name . '.destroy')->middleware($middleware['destroy'] ?? null);

        if (in_array('edit', $only))
            Route::get("/{$name}/json/{id}","{$controller}@edit")->name($name . '.edit')->middleware($middleware['edit'] ?? null);
    }
}
