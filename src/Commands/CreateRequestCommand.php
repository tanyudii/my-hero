<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Smoothsystem\Manager\Utilities\Services\StubService;

class CreateRequestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:request {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator request.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $entityNamePluralSnakeCase = Str::snake(Str::plural($name));
        $entityNameDashCase = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $name));

        $this->comment($name);
        $this->comment($entityNamePluralSnakeCase);
        $this->comment($entityNameDashCase);

        $pathCreate = app_path("Http/Request/{$name}CreateRequest.php");
        if (file_exists($pathCreate)) {
            $this->info("{$name}CreateRequest already exists");
        } else {
            $templateCreate = str_replace(
                ['{{ entityName }}'],
                [$name],
                StubService::getStub('CreateRequest')
            );

            file_put_contents($pathCreate, $templateCreate);

            $this->info('Successfully create CreateRequest');
        }

        $pathUpdate = app_path("Http/Request/{$name}UpdateRequest.php");
        if (file_exists($pathUpdate)) {
            $this->info("{$name}UpdateRequest already exists");
        } else {
            $templateUpdate = str_replace(
                ['{{ entityName }}'],
                [$name],
                StubService::getStub('UpdateRequest')
            );

            file_put_contents($pathUpdate, $templateUpdate);

            $this->info('Successfully create UpdateRequest');
        }

        return true;
    }
}