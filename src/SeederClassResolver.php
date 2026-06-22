<?php

declare(strict_types=1);

namespace Codepluswander\LaravelDatabaseSeedVersion;

class SeederClassResolver
{
    public function resolve(?string $class): string
    {
        $class ??= DatabaseSeederVersion::class;

        if (! str_contains($class, '\\')) {
            $class = 'Database\\Seeders\\'.$class;
        }

        if ($class === 'Database\\Seeders\\DatabaseSeeder' && ! class_exists($class)) {
            return DatabaseSeederVersion::class;
        }

        return $class;
    }
}
