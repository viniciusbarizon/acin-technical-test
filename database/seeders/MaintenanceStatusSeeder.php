<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maintenance_statuses')->insert([
            ['id' => str()->ulid(), 'status' => 'On queue'],
            ['id' => str()->ulid(), 'status' => 'Doing'],
            ['id' => str()->ulid(), 'status' => 'Done'],
            ['id' => str()->ulid(), 'status' => 'To be pick up'],
            ['id' => str()->ulid(), 'status' => 'Picked up'],
        ]);
    }
}
