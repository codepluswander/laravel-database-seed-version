<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Support\ServiceProvider;

class DatabaseSeedVersionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(SeedCommand::class, function ($service, $app) {
            return $app->make(SeedVersionCommand::class);
        });

        $this->app->singleton(SeederClassResolver::class);
        $this->app->singleton(SeederDiscovery::class);
        $this->app->singleton(SeedRun::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/laravel-database-seed-version.php' => config_path('laravel-database-seed-version.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-database-seed-version.php', 'laravel-database-seed-version'
        );

        $this->registerSeedersFromDirectories(config('laravel-database-seed-version.seeder_directories', []));
    }

    protected function registerSeedersFromDirectories(array $directories): void
    {
        foreach ($this->app->make(SeederDiscovery::class)->discover($directories) as $class) {
            $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) use ($class) {
                $service->addSeeder([$class]);
            });
        }
    }
}
