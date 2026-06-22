<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Codepluswander\LaravelDatabaseSeedVersion\DatabaseSeederVersion;
use Codepluswander\LaravelDatabaseSeedVersion\SeederClassResolver;
use PHPUnit\Framework\Attributes\Test;

class SeederClassResolverTest extends TestCase
{
    #[Test]
    public function it_falls_back_to_the_package_database_seeder(): void
    {
        $resolver = new SeederClassResolver();

        $this->assertSame(
            DatabaseSeederVersion::class,
            $resolver->resolve('DatabaseSeeder')
        );
    }
}
