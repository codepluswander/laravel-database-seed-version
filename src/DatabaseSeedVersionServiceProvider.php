<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Support\ServiceProvider;

class DatabaseSeedVersionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend(SeedCommand::class, function ($service, $app) {
            return $app->make(SeedVersionCommand::class);
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}
