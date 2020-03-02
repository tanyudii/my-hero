<?php

namespace Smoothsystem\Core\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Smoothsystem\Core\Utilities\Services\StubService;

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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

        Artisan::call('make:model Entities/' . $name);
        Artisan::call('make:controller ' . $name . 'Controller');
        Artisan::call('make:request ' . $name . 'CreateRequest');
        Artisan::call('make:request ' . $name . 'UpdateRequest');
        Artisan::call('make:resource ' . $name . 'Resource');
    }

    /**
     * @inheritDoc
     */
    protected function getStub()
    {
        return StubService::getStub('Entity');
    }
}
