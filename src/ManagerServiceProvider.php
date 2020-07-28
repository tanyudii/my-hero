<?php

namespace Smoothsystem\Manager;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Smoothsystem\Manager\Http\Middleware\Gate;
use Smoothsystem\Manager\Http\Middleware\Notification;
use Smoothsystem\Manager\Utilities\Services\FileLogService;
use Smoothsystem\Manager\Utilities\Services\ExceptionService;
use Smoothsystem\Manager\Utilities\Services\FileService;
use Smoothsystem\Manager\Utilities\Services\ResourceService;
use Smoothsystem\Manager\Utilities\Services\RouteService;
use Smoothsystem\Manager\Utilities\Services\StubService;

class ManagerServiceProvider extends ServiceProvider
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

        $this->registerCommands();

        $this->registerMiddleware();

        if (config('smoothsystem.passport.register', true)) {
            $this->registerPassport();
        }

    }

    protected function registerAssets() {
        $this->mergeConfigFrom($configVodeaManager = __DIR__ . '/../assets/config/smoothsystem.php','smoothsystem-config');

        if ($this->app->runningInConsole()) {
            $this->publishes([$configVodeaManager => config_path('smoothsystem.php')], 'smoothsystem-config');
        }

        $this->publishes([__DIR__ . '/../assets/migrations' => database_path('migrations')],'smoothsystem-migration');
        $this->publishes([__DIR__ . '/../assets/factories' => database_path('factories')],'smoothsystem-factory');
        $this->publishes([__DIR__ . '/../assets/seeds' => database_path('seeds')],'smoothsystem-seed');
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
    }

    protected function registerEvents()
    {
        Event::listen('Illuminate\Auth\Events\Login','Smoothsystem\Manager\Listeners\LogSuccessfulLogin');
        Event::listen('Laravel\Passport\Events\AccessTokenCreated','Smoothsystem\Manager\Listeners\TokenSuccessfulGenerate');
    }

    protected function registerCommands()
    {
        $this->commands('Smoothsystem\Manager\Commands\RefreshCommand');
        $this->commands('Smoothsystem\Manager\Commands\PermissionSeedCommand');
        $this->commands('Smoothsystem\Manager\Commands\CreatePassportClientCommand');
        $this->commands('Smoothsystem\Manager\Commands\CreateEntityCommand');
        $this->commands('Smoothsystem\Manager\Commands\CreateMigrationCommand');
        $this->commands('Smoothsystem\Manager\Commands\CreateRequestCommand');
        $this->commands('Smoothsystem\Manager\Commands\CreateRestControllerCommand');
    }

    protected function registerPassport()
    {
        if (!config('smoothsystem.passport.custom_routes', false)) {
            Passport::routes();
        }

        Passport::tokensExpireIn(Carbon::now()->addDays(config('smoothsystem.passport.expires.token', 15)));

        Passport::refreshTokensExpireIn(Carbon::now()->addDays(config('smoothsystem.passport.expires.refresh_token', 30)));

        Passport::personalAccessTokensExpireIn(Carbon::now()->addMonths(config('smoothsystem.passport.expires.personal_access_token', 6)));
    }

    protected function registerFacades()
    {
        app()->bind('exception.service', function() {
            return new ExceptionService;
        });

        app()->bind('file.service', function() {
            return new FileService;
        });

        app()->bind('file_log.service', function() {
            return new FileLogService;
        });

        app()->bind('stub.service', function() {
            return new StubService;
        });

        app()->bind('route.service', function() {
            return new RouteService;
        });

        app()->bind('resource.service', function() {
            return new ResourceService;
        });
    }

    private function registerHelpers()
    {
        foreach(glob(__DIR__ . '/Utilities/Helpers/*.php') as $fileHelper){
            require_once($fileHelper);
        }
    }

    private function registerMiddleware()
    {
        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        $kernel->pushMiddleware('Fruitcake\Cors\HandleCors');

        $this->app['router']->aliasMiddleware('smoothsystem.gate', Gate::class);
        $this->app['router']->aliasMiddleware('smoothsystem.notification', Notification::class);
    }

}
