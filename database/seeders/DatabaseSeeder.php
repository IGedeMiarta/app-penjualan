<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Categories;
use App\Models\Product;
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
      
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Categories::create([
            'category_name' => 'Dashboard Admin',
            'category_slug' => Str::slug('Dashboard Admin')
        ]);
        Categories::create([
            'category_name' => 'Landing Page',
            'category_slug' => Str::slug('Landing Page')
        ]);
        Categories::create([
            'category_name' => 'Wordpress',
            'category_slug' => Str::slug('Wordpress')
        ]);
        Categories::create([
            'category_name' => 'Portofolio',
            'category_slug' => Str::slug('Portofolio')
        ]);
        Author::create([
            'name' => 'test'
        ]);

        Product::factory(25)->create();

    }
}
