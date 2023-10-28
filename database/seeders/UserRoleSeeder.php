<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')
            ->insert(['id' => Str::ulid(), 'role' => 'reporter']);

        for ($i = 1; $i <= 9; $i++) {
            UserRole::factory()->create();
        }
    }
}
