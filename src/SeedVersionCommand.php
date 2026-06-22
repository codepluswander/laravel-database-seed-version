<?php

namespace Codepluswander\LaravelDatabaseSeedVersion;

use Illuminate\Database\Console\Seeds\SeedCommand;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Input\InputOption;

class SeedVersionCommand extends SeedCommand
{
    public function __construct(
        Resolver $resolver,
        protected SeederClassResolver $classResolver
    ) {
        parent::__construct($resolver);
    }

    /**
     * Get a seeder instance from the container.
     *
     * @return Seeder
     */
    protected function getSeeder(): Seeder
    {
        $class = $this->classResolver->resolve(
            $this->input->getArgument('class') ?? $this->input->getOption('class')
        );

        return $this->laravel->make($class)
            ->setContainer($this->laravel)
            ->setCommand($this);
    }

    protected function getOptions(): array
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', DatabaseSeederVersion::class],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production'],
        ];
    }
}
