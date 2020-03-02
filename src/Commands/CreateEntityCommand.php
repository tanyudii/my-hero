<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Smoothsystem\Manager\Utilities\Services\StubService;

class CreateEntityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:entity
                                {name : Class (singular) for example User}
                                {--m : with migration.}
                                {--migration : with migration.}
                                {--controller : with controller.}
                                {--rest-controller : with rest controller.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator entity.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $template = str_replace(
            ['{{ entityName }}'],
            [$name],
            StubService::getStub('Entity')
        );

        $path = app_path("Entities/{$name}.php");
        if (file_exists($path)) {
            $this->info("Entity {$name} already exists");

            return false;
        }

        file_put_contents($path, $template);

        $this->info('Successfully create entity');

        Artisan::call('make:resource', ['name' => $name . 'Resource']);

        if ($this->option('m') || $this->option('migration')) {
            Artisan::call('create:migration', ['name' => $name]);
        }

        return true;
    }
}
