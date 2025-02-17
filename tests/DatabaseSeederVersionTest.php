<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Codepluswander\LaravelDatabaseSeedVersion\DatabaseSeederVersion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeederVersionTest extends TestCase
{
    use RefreshDatabase;

    public function testItSeedsTheDatabase()
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
}
