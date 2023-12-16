<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Brand;
use App\Models\Categories;
use App\Models\Product;
use App\Models\SpecialProduct;
use App\Models\Tags;
use App\Models\Testimony;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
      
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'role'  => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Leader',
            'email' => 'leader@mail.com',
            'role'  => 'lead'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@mail.com',
        ]);

        // Categories::create([
        //     'category_name' => 'Brankas',
        //     'category_slug' => Str::slug('Brankas')
        // ]);
        // Categories::create([
        //     'category_name' => 'Alat Kantor',
        //     'category_slug' => Str::slug('Alat Kantor')
        // ]);
        // Brand::create([
        //     'name' => 'test'
        // ]);

        // Product::factory(100)->create();
        // Tags::factory(150)->create();
        // SpecialProduct::factory(20)->create();
        // Testimony::factory(20)->create();

    }
}
