<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owners')->insert([
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
            ['id' => str()->ulid(), 'name' => fake()->name],
        ]);
    }
}
