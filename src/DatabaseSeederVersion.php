<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Seeder as BaseSeeder;

class DatabaseSeederVersion extends BaseSeeder
{
    protected array $seeders = [];

    public function __construct(
        protected ?SeedRun $seedRun = null
    ) {}

    public function run(): void
    {
        $ranSeeders = $this->seedRun()->run(
            $this->getSeeders(),
            function (string $seeder): void {
                $this->call($seeder);
            }
        );

        if (! $ranSeeders) {
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
        return array_values(array_unique(array_merge(
            config('laravel-database-seed-version.seeders', []),
            $this->seeders,
        )));
    }

    protected function seedRun(): SeedRun
    {
        return $this->seedRun ??= app(SeedRun::class);
    }
}
