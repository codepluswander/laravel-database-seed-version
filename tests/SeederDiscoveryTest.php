<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Codepluswander\LaravelDatabaseSeedVersion\SeederDiscovery;
use PHPUnit\Framework\Attributes\Test;

class SeederDiscoveryTest extends TestCase
{
    #[Test]
    public function it_discovers_seeders_from_a_directory(): void
    {
        $discovery = new SeederDiscovery();

        $this->assertSame(
            ['Codepluswander\\LaravelDatabaseSeedVersion\\Tests\\database\\seeders\\TestSeeder'],
            $discovery->discover([__DIR__.'/database/seeders'])
        );
    }
}
