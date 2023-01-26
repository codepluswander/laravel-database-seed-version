# Run Database seeders with history like migrations

This package allows you to run `db:seed` and it will keep track which seeders were already ran and not run them again just like migrations.

## Installation

Install via composer

```shell
composer require codepluswander/laravel-database-seed-version
```

Run the migrations to create the `seeders` table

```shell
php artisan migrate
```

## Usage

You can set seeder files in the config file

```shell
php artisan vendor:publish --provider="Codepluswander\LaravelDatabaseSeedVersion\DatabaseSeedVersionServiceProvider"
```

```php
<?php

return [
    'seeders' => [
        \MyNameSpace\MySeeder::class
    ],
];
```

You can also set seeders in your `AppServiceProvider` or any ServiceProvider `register` function. Just call the `addSeeder` function for the `DatabaseSeederVersion` class after resolving it.

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Codepluswander\LaravelDatabaseSeedVersion\DatabaseSeederVersion;
use Database\Seeders\TestSeeder;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->afterResolving(DatabaseSeederVersion::class, function ($service) {
            $service->addSeeder([TestSeeder::class]);
        });
    }
}
```

## Testing

```shell
composer test
```

## Changelog

Refer to [CHANGELOG](CHANGELOG.md) for recent changes.

## License

The MIT License (MIT) [License File](LICENSE.md).