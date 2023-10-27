<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maintenance_types')->insert([
            ['id' => str()->ulid(), 'type' => 'Oil change and filter replacement'],
            ['id' => str()->ulid(), 'type' => 'Serpentine belt inspection'],
            ['id' => str()->ulid(), 'type' => 'Wiper blade inspection'],
            ['id' => str()->ulid(), 'type' => 'Tire pressure checks'],
            ['id' => str()->ulid(), 'type' => 'Brake fluid exchange'],
            ['id' => str()->ulid(), 'type' => 'Spark plug replacement'],
            ['id' => str()->ulid(), 'type' => 'Transmission fluid inspection'],
            ['id' => str()->ulid(), 'type' => 'Timing belt replacement'],
            ['id' => str()->ulid(), 'type' => 'Battery testing'],
            ['id' => str()->ulid(), 'type' => 'Tire replacement'],
        ]);
    }
}
