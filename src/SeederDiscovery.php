<?php

declare(strict_types=1);

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Support\Facades\File;

class SeederDiscovery
{
    public function discover(array $directories): array
    {
        $seeders = [];

        foreach ($directories as $directory) {
            foreach (File::allFiles($directory) as $file) {
                $class = $this->classFromFile($file->getPathname());

                if ($class !== null) {
                    $seeders[] = $class;
                }
            }
        }

        return array_values(array_unique($seeders));
    }

    public function classFromFile(string $path): ?string
    {
        $content = file_get_contents($path);

        if ($content === false) {
            return null;
        }

        if (! preg_match('/namespace\s+(.+?);/', $content, $namespaceMatches)) {
            return null;
        }

        if (! preg_match('/class\s+(\w+)/', $content, $contentMatches)) {
            return null;
        }

        return $namespaceMatches[1].'\\'.$contentMatches[1];
    }
}
