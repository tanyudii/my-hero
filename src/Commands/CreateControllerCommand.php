<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Smoothsystem\Manager\Utilities\Facades\StubService;

class CreateControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:controller {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator controller';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $entityNameDashCase = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $name));

        $template = str_replace(
            ['{{ entityName }}', '{{ entityNameDashCase }}'],
            [$name, $entityNameDashCase],
            StubService::getStub('Controller')
        );

        $path = app_path("Http/Controllers/{$name}Controller.php");
        if (file_exists($path)) {
            $this->info("{$name}Controller already exists");

            return false;
        }

        file_put_contents($path, $template);

        $this->info('Successfully create controller');

        Artisan::call('create:request', ['name' => $name]);

        return true;
    }
}
