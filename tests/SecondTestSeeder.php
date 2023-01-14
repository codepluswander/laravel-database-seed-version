<?php

namespace Codepluswander\LaravelDatabaseSeedVersion\Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SecondTestSeeder extends Seeder
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
            ['name' => 'Test 3'],
            ['name' => 'Test 4'],
        ]
        );
    }
}
