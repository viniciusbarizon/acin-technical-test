<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            ['id' => str()->ulid(), 'name' => 'Volkswagen'],
            ['id' => str()->ulid(), 'name' => 'Toyota'],
            ['id' => str()->ulid(), 'name' => 'Mercedes Benz'],
            ['id' => str()->ulid(), 'name' => 'Ford'],
            ['id' => str()->ulid(), 'name' => 'General Motors'],
            ['id' => str()->ulid(), 'name' => 'Honda'],
            ['id' => str()->ulid(), 'name' => 'Hyundai'],
            ['id' => str()->ulid(), 'name' => 'BMW'],
            ['id' => str()->ulid(), 'name' => 'Nissan'],
            ['id' => str()->ulid(), 'name' => 'Tesla'],
        ]);
    }
}
