<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\ContactRole;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            OrganizationSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);

        $organization = Organization::where('slug', 'demo-company')->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = [];

        foreach ([
            'Electronics',
            'Office Supplies',
            'Raw Materials',
        ] as $name) {
            $category = Category::firstOrCreate(
                [
                    'organization_id' => $organization->id,
                    'slug' => str($name)->slug(),
                ],
                [
                    'name' => $name,
                    'description' => "Demo category: {$name}",
                    'is_active' => true,
                ]
            );

            $categories[$category->slug] = $category;
        }

        /*
        |--------------------------------------------------------------------------
        | Locations
        |--------------------------------------------------------------------------
        */

        $warehouse = Location::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'name' => 'Main Warehouse',
            ],
            [
                'type' => 'warehouse',
                'description' => 'Main company warehouse.',
                'address' => 'Industrial Park, 1',
                'city' => 'Vinaròs',
                'postal_code' => '12500',
                'country' => 'ES',
                'is_active' => true,
            ]
        );

        $store = Location::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'name' => 'Main Store',
            ],
            [
                'type' => 'store',
                'description' => 'Main retail location.',
                'city' => 'Vinaròs',
                'postal_code' => '12500',
                'country' => 'ES',
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Items
        |--------------------------------------------------------------------------
        */

        $laptop = Item::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'sku' => 'DEMO-LAPTOP-001',
            ],
            [
                'category_id' => $categories['electronics']->id,
                'name' => 'Laptop Pro 15"',
                'description' => 'Demo laptop product.',
                'type' => 'product',
                'unit' => 'unit',
                'minimum_stock' => 5,
                'is_active' => true,
            ]
        );

        $officeChair = Item::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'sku' => 'DEMO-CHAIR-001',
            ],
            [
                'category_id' => $categories['office-supplies']->id,
                'name' => 'Office Chair',
                'description' => 'Demo office chair.',
                'type' => 'product',
                'unit' => 'unit',
                'minimum_stock' => 10,
                'is_active' => true,
            ]
        );

        $steel = Item::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'sku' => 'DEMO-STEEL-001',
            ],
            [
                'category_id' => $categories['raw-materials']->id,
                'name' => 'Steel Sheet',
                'description' => 'Demo raw material.',
                'type' => 'material',
                'unit' => 'kg',
                'minimum_stock' => 100,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Inventory
        |--------------------------------------------------------------------------
        */

        Inventory::updateOrCreate(
            [
                'item_id' => $laptop->id,
                'location_id' => $warehouse->id,
            ],
            [
                'organization_id' => $organization->id,
                'quantity' => 25,
            ]
        );

        Inventory::updateOrCreate(
            [
                'item_id' => $laptop->id,
                'location_id' => $store->id,
            ],
            [
                'organization_id' => $organization->id,
                'quantity' => 8,
            ]
        );

        Inventory::updateOrCreate(
            [
                'item_id' => $officeChair->id,
                'location_id' => $warehouse->id,
            ],
            [
                'organization_id' => $organization->id,
                'quantity' => 18,
            ]
        );

        Inventory::updateOrCreate(
            [
                'item_id' => $steel->id,
                'location_id' => $warehouse->id,
            ],
            [
                'organization_id' => $organization->id,
                'quantity' => 75,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Contacts
        |--------------------------------------------------------------------------
        */

        $customer = Contact::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'name' => 'Demo Customer',
            ],
            [
                'tax_id' => 'B00000001',
                'email' => 'customer@example.local',
                'phone' => '+34 600 000 001',
                'city' => 'Vinaròs',
                'postal_code' => '12500',
                'country' => 'ES',
                'is_active' => true,
            ]
        );

        ContactRole::firstOrCreate([
            'contact_id' => $customer->id,
            'role' => 'customer',
        ]);

        $supplier = Contact::firstOrCreate(
            [
                'organization_id' => $organization->id,
                'name' => 'Demo Supplier',
            ],
            [
                'tax_id' => 'B00000002',
                'email' => 'supplier@example.local',
                'phone' => '+34 600 000 002',
                'city' => 'Castellón',
                'postal_code' => '12001',
                'country' => 'ES',
                'is_active' => true,
            ]
        );

        ContactRole::firstOrCreate([
            'contact_id' => $supplier->id,
            'role' => 'supplier',
        ]);
    }
}