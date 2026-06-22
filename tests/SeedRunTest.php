<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Codepluswander\LaravelDatabaseSeedVersion\Models\Seeder;
use Codepluswander\LaravelDatabaseSeedVersion\SeedRun;
use PHPUnit\Framework\Attributes\Test;

class SeedRunTest extends TestCase
{
    #[Test]
    public function it_returns_only_pending_seeders(): void
    {
        Seeder::create([
            'seeder' => TestSeeder::class,
            'batch' => 1,
        ]);

        $seedRun = new SeedRun();

        $this->assertSame(
            [SecondTestSeeder::class],
            $seedRun->pending([
                TestSeeder::class,
                SecondTestSeeder::class,
            ])
        );
    }
}
