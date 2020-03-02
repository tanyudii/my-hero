<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Smoothsystem\Manager\Utilities\Services\StubService;

class CreateEntityCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:entity {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator enitty.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $entityPluralName = Str::plural($name);
        $entityNamePluralSnakeCase = Str::snake($entityPluralName);
        $entityNameDashCase = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $entityPluralName));

        $this->comment($name);
        $this->comment($entityPluralName);
        $this->comment($entityNamePluralSnakeCase);
        $this->comment($entityNameDashCase);
        /*Artisan::call('make:model Entities/' . $name);
        Artisan::call('make:controller ' . $name . 'Controller');
        Artisan::call('make:request ' . $name . 'CreateRequest');
        Artisan::call('make:request ' . $name . 'UpdateRequest');
        Artisan::call('make:resource ' . $name . 'Resource');*/
    }

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return StubService::getStub('Entity');
    }
}
