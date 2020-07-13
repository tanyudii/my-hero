<?php

namespace Smoothsystem\Manager\Utilities\Services;

use Illuminate\Support\Facades\Route;

class RouteService
{
    public function fileService() {
        Route::group(['prefix' => 'file-manager', 'as' => 'file-manager.', 'namespace' => '\Smoothsystem\Manager\Http\Controllers'], function () {
            Route::get('/', 'FileManagerController@index')->name('index');
            Route::post('/','FileManagerController@store')->name('store');

        });
    }

    public function notificationService() {
        Route::group(['prefix' => 'notification', 'as' => 'notification.', 'namespace' => '\Smoothsystem\Manager\Http\Controllers'], function () {
            Route::get('/','NotificationController@index')->name('index');
            Route::get('/{id}', 'NotificationController@show')->name('show');
            Route::post('/read-all', 'NotificationController@readAll')->name('read-all');

        });
    }

    public function numberSettingService() {
        Route::group(['prefix' => 'number-setting', 'as' => 'number-setting.', 'namespace' => '\Smoothsystem\Manager\Http\Controllers'], function () {
            Route::get('/','NumberSettingController@index')->name('index');
            Route::post('/','NumberSettingController@store')->name('store');
            Route::get('/{id}','NumberSettingController@show')->name('show');
            Route::put('/{id}','NumberSettingController@update')->name('update');
            Route::delete('/{id}','NumberSettingController@destroy')->name('destroy');
        });
    }
}
