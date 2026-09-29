<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::where('slug', 'demo-company')->firstOrFail();

        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Full access to the organization and all available modules.',
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Access to operational management and business data.',
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Standard access to the platform.',
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                [
                    'organization_id' => $organization->id,
                    'slug' => $role['slug'],
                ],
                $role
            );
        }
    }
}