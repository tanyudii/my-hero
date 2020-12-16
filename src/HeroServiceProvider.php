<?php

namespace tanyudii\Hero;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use tanyudii\Hero\Http\Middleware\Gate;
use tanyudii\Hero\Http\Middleware\Notification;
use tanyudii\Hero\Utilities\Services\ExceptionService;
use tanyudii\Hero\Utilities\Services\FileService;
use tanyudii\Hero\Utilities\Services\MediaService;
use tanyudii\Hero\Utilities\Services\ResourceService;
use tanyudii\Hero\Utilities\Services\RouteService;
use tanyudii\Hero\Utilities\Services\StubService;

class HeroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerHelpers();

        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAssets();

        $this->registerSchemas();

        $this->registerEvents();

        $this->registerMiddleware();
    }

    protected function registerAssets() {
        $this->mergeConfigFrom($configHero = __DIR__ . '/../assets/config/hero.php','hero-config');

        if ($this->app->runningInConsole()) {
            $this->publishes([$configHero => config_path('hero.php')], 'hero-config');
        }

        $this->publishes([__DIR__ . '/../assets/migrations' => database_path('migrations')],'hero-migration');
        $this->publishes([__DIR__ . '/../assets/factories' => database_path('factories')],'hero-factory');
        $this->publishes([__DIR__ . '/../assets/seeders' => database_path('seeds')],'hero-seed');
    }

    private function registerSchemas()
    {
        Blueprint::macro('userTimeStamp', function($created = 'created_by', $updated = 'updated_by', $deleted = 'deleted_by') {
            $this->timestamps();
            $this->softDeletes();
            $this->unsignedBigInteger($created)->nullable();
            $this->unsignedBigInteger($updated)->nullable();
            $this->unsignedBigInteger($deleted)->nullable();
        });

        Blueprint::macro('relation', function($column, $table, $nullable = true) {
            $this->unsignedBigInteger($column)->nullable($nullable);
            $this->foreign($column)->on($table)->references('id')->onUpdate('cascade');
        });

        Blueprint::macro('uuidRelation', function($column, $table, $nullable = true) {
            $this->uuid($column)->nullable($nullable)->index();
            $this->foreign($column)->on($table)->references('id')->onUpdate('cascade');
        });
    }

    protected function registerHelpers()
    {
        foreach(glob(__DIR__ . '/Utilities/Helpers/*.php') as $fileHelper){
            require_once($fileHelper);
        }
    }

    protected function registerEvents()
    {
        Event::listen('Illuminate\Auth\Events\Login','tanyudii\Hero\Listeners\LogSuccessfulLogin');}

    protected function registerFacades()
    {
        app()->bind('exception.service', function() {
            return new ExceptionService;
        });

        app()->bind('file.service', function() {
            return new FileService;
        });

        app()->bind('media.service', function() {
            return new MediaService;
        });

        app()->bind('route.service', function() {
            return new RouteService;
        });

        app()->bind('resource.service', function() {
            return new ResourceService;
        });
    }

    private function registerMiddleware()
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        $kernel->pushMiddleware('Fruitcake\Cors\HandleCors');

        $this->app['router']->aliasMiddleware('hero.gate', Gate::class);
        $this->app['router']->aliasMiddleware('hero.notification', Notification::class);
    }

}
