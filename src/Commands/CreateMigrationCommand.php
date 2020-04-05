<?php

namespace Smoothsystem\Manager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Smoothsystem\Manager\Utilities\Facades\StubService;

class CreateMigrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:migration {name : Class (singular) for example User}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator migration';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $entityNamePlural = Str::plural($name);
        $entityNamePluralSnakeCase = Str::snake(Str::plural($name));

        $template = str_replace(
            ['{{ entityNamePlural }}', '{{ entityNamePluralSnakeCase }}'],
            [$entityNamePlural, $entityNamePluralSnakeCase],
            StubService::getStub('Migration')
        );

        $path = database_path('migrations/' . Carbon::now()->format('Y_m_d_his') . "_create_{$entityNamePluralSnakeCase}_table.php");
        if (file_exists($path)) {
            $this->info("Migration {$name} already exists");

            return false;
        }

        file_put_contents($path, $template);

        $this->info('Successfully create migration');

        return true;
    }
}
