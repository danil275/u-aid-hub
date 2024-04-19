<?php

namespace Database\Seeders;

use App\Enums\AppRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', AppRole::Admin)->first();
        $agentRole = Role::where('name', AppRole::Agent)->first();
        $clientRole = Role::where('name', AppRole::Client)->first();
        $users = User::factory()->createMany([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('123123'),
            ],
            [
                'name' => 'Agent',
                'email' => 'agent@example.com',
                'password' => Hash::make('123123'),
            ],
            [
                'name' => 'Client',
                'email' => 'client@example.com',
                'password' => Hash::make('123123'),
            ]
        ]);

        $users[0]->roles()->save($adminRole);
        $users[1]->roles()->save($agentRole);
        $users[2]->roles()->save($clientRole);
    }
}
