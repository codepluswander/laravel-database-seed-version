<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Codepluswander\LaravelDatabaseSeedVersion\Models\Seeder;
use Illuminate\Database\Seeder as BaseSeeder;

class DatabaseSeederVersion extends BaseSeeder
{
    protected array $seeders = [];

    public function run(): void
    {
        $existingSeeders = Seeder::orderBy('id', 'DESC')->get();
        $batch = ($existingSeeders->first()->batch ?? 0) + 1;
        $noSeeders = true;

        foreach ($this->getSeeders() as $seeder) {
            if (! $existingSeeders->contains('seeder', $seeder)) {
                $this->call($seeder);
                Seeder::create(['seeder' => $seeder, 'batch' => $batch]);
                $noSeeders = false;
            }
        }

        if ($noSeeders) {
            $this->command->info('Nothing to seed');
        }
    }

    public function addSeeder(array $seeders): self
    {
        $this->seeders = array_merge($this->seeders, $seeders);

        return $this;
    }

    public function getSeeders(): array
    {
        return array_merge(config('laravel-database-seed-version.seeders', []), $this->seeders);
    }
}
