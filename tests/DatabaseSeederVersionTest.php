<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Codepluswander\LaravelDatabaseSeedVersion\DatabaseSeederVersion;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeederVersionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_seeds_the_database(): void
    {
        $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) {
            $service->addSeeder([TestSeeder::class]);
        });

        $this->artisan('db:seed');

        $this->assertDatabaseCount('tests', 4);

        $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) {
            $service->addSeeder([SecondTestSeeder::class]);
        });

        $this->artisan('db:seed');

        $this->assertDatabaseHas('seeders', [
            'seeder' => SecondTestSeeder::class,
            'batch' => 2,
        ]);

        $this->assertDatabaseCount('tests', 6);
    }

    #[Test]
    public function it_only_runs_each_seeder_once_even_if_registered_twice(): void
    {
        $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) {
            $service->addSeeder([
                TestSeeder::class,
                TestSeeder::class,
            ]);
        });

        $this->artisan('db:seed');

        $this->assertDatabaseCount('tests', 4);
    }
}
