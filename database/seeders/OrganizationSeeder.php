<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::firstOrCreate(
            ['slug' => 'demo-company'],
            [
                'name' => 'Demo Company',
                'email' => 'admin@demo-company.local',
                'phone' => '+34 900 000 000',
                'address' => 'Calle Principal, 1',
                'city' => 'Vinaròs',
                'postal_code' => '12500',
                'country' => 'ES',
                'timezone' => 'Europe/Madrid',
                'currency' => 'EUR',
                'is_active' => true,
            ]
        );
    }
}