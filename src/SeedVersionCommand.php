<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;

class SeedVersionCommand extends SeedCommand
{
    /**
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder()
    {
        return $this->laravel->make(DatabaseSeederVersion::class)
            ->setContainer($this->laravel)
            ->setCommand($this);
    }
}
