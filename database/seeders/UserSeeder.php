<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::where('slug', 'demo-company')->firstOrFail();

        $role = Role::where('organization_id', $organization->id)
            ->where('slug', 'administrator')
            ->firstOrFail();

        User::updateOrCreate(
            [
                'email' => 'admin@demo-company.local',
            ],
            [
                'organization_id' => $organization->id,
                'role_id' => $role->id,
                'name' => 'Administrator',
                'password' => 'password',
                'is_active' => true,
            ]
        );
    }
}