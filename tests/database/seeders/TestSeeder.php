<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests\database\seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('tests')->insert([
            ['name' => 'Test 1'],
            ['name' => 'Test 2'],
        ]
        );
    }
}
