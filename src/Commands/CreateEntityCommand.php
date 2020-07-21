<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Smoothsystem\Manager\Utilities\Facades\StubService;

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
                                {--r-c : with rest controller.}
                                {--rest-controller : with rest controller.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator entity';

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

        if (!file_exists(app_path('Entities'))) {
            mkdir(app_path('Entities'), 0777, true);
        }

        $path = app_path("Entities/{$name}.php");
        if (file_exists($path)) {
            $this->info("Entity {$name} already exists");

            return false;
        }

        file_put_contents($path, $template);

        $this->info('Successfully create entity');

        if ($this->option('m') || $this->option('migration')) {
            Artisan::call('create:migration', ['name' => $name]);
        }

        if ($this->option('r-c') || $this->option('rest-controller')) {
            Artisan::call('create:rest-controller', ['name' => $name]);
        }

        return true;
    }
}
