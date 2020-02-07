<?php

namespace Smoothsystem\Core;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHelpers();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../assets/configs/smoothsystem.php',
            'smoothsystem'
        );

        $this->publishes(
            [__DIR__ . '/../assets/migrations' => database_path('migrations')],
            'smoothsystem'
        );

        $this->publishes(
            [__DIR__ . '/../assets/seeds' => database_path('seeds')],
            'smoothsystem'
        );

        $this->registerSchemas();

        $this->registerEvents();

    }

    protected function registerSchemas()
    {
        Blueprint::macro('userTimeStamp', function($created = 'created_by', $updated = 'updated_by', $deleted = 'deleted_by', $table = 'users', $reference = 'id') {
            $this->timestamps();
            $this->softDeletes();
            $this->unsignedBigInteger($created)->nullable();
            $this->foreign($created)->references($reference)->on($table)->onUpdate('cascade');
            $this->unsignedBigInteger($updated)->nullable();
            $this->foreign($updated)->references($reference)->on($table)->onUpdate('cascade');
            $this->unsignedBigInteger($deleted)->nullable();
            $this->foreign($deleted)->references($reference)->on($table)->onUpdate('cascade');
        });

        Blueprint::macro('relation', function($column, $table, $nullable = true) {
            if ($nullable) {
                $this->unsignedBigInteger($column)->nullable();
            } else {
                $this->unsignedBigInteger($column);
            }

            $this->foreign($column)->on($table)->references('id')->onUpdate('cascade');
        });
    }

    protected function registerHelpers()
    {
        foreach(glob(__DIR__ . '/Helpers/*.php') as $fileHelper){
            require_once($fileHelper);
        }
    }

    protected function registerEvents()
    {
        Event::listen(
            'Illuminate\Auth\Events\Login',
            'Smoothsystem\Core\Listeners\LogSuccessfulLogin'
        );

        Event::listen(
            'Laravel\Passport\Events\AccessTokenCreated',
            'Smoothsystem\Core\Listeners\TokenSuccessfulGenerate'
        );
    }
}