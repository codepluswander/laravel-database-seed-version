<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Input\InputOption;

class SeedVersionCommand extends SeedCommand
{
    /**
     * Get a seeder instance from the container.
     *
     * @return Seeder
     */
    protected function getSeeder(): Seeder
    {
        $class = $this->input->getArgument('class') ?? $this->input->getOption('class');

        if (! str_contains($class, '\\')) {
            $class = 'Database\\Seeders\\'.$class;
        }

        if ($class === 'Database\\Seeders\\DatabaseSeeder' &&
            ! class_exists($class)) {
            $class = DatabaseSeederVersion::class;
        }

        return $this->laravel->make($class)
            ->setContainer($this->laravel)
            ->setCommand($this);
    }

    protected function getOptions(): array
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', DatabaseSeederVersion::class],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production'],
        ];
    }
}
