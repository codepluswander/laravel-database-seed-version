<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class DatabaseSeedVersionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend(SeedCommand::class, function ($service, $app) {
            return $app->make(SeedVersionCommand::class);
        });
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
        foreach ($directories as $directory) {
            $files = File::allFiles($directory);
            foreach ($files as $file) {
                $class = $this->getClassFromFile($file);
                if ($class) {
                    $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) use ($class) {
                        $service->addSeeder([$class]);
                    });
                }
            }
        }
    }

    protected function getClassFromFile($file): ?string
    {
        $content = file_get_contents($file);
        if (preg_match('/namespace\s+(.+?);/', $content, $namespaceMatches) &&
            preg_match('/class\s+(\w+)/', $content, $classMatches)) {
            return $namespaceMatches[1] . '\\' . $classMatches[1];
        }
        return null;
    }
}
