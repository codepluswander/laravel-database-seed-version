<?php

declare(strict_types=1);

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Codepluswander\LaravelDatabaseSeedVersion\Models\Seeder;

class SeedRun
{
    public function run(array $seeders, callable $runSeeder): bool
    {
        $pending = $this->pending($seeders);

        if ($pending === []) {
            return false;
        }

        $batch = ((int) Seeder::query()->max('batch')) + 1;

        foreach ($pending as $seeder) {
            $runSeeder($seeder);
            Seeder::create([
                'seeder' => $seeder,
                'batch' => $batch,
            ]);
        }

        return true;
    }

    public function pending(array $seeders): array
    {
        $ranSeeders = Seeder::query()->pluck('seeder')->all();

        return array_values(array_filter(
            array_unique($seeders),
            static fn (string $seeder): bool => ! in_array($seeder, $ranSeeders, true)
        ));
    }
}
