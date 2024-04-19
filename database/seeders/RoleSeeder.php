<?php

namespace Database\Seeders;

use App\Enums\AppRole;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(
            [
                [
                    'id' => 1,
                    'name' => AppRole::Admin
                ],
                [
                    'id' => 2,
                    'name' => AppRole::Agent
                ],
                [
                    'id' => 3,
                    'name' => AppRole::Client
                ]
            ]
        );
    }
}
