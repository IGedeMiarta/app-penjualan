<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
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
        \App\Models\User::factory(10)->create();
      
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
            'category_name' => 'Wordpress  Templates',
            'category_slug' => Str::slug('Wordpress Templates')
        ]);
        Categories::create([
            'category_name' => 'Portofolio Templates',
            'category_slug' => Str::slug('Portofolio  Templates')
        ]);
        Categories::create([
            'category_name' => 'Presentation Templates',
            'category_slug' => Str::slug('Presentation Templates')
        ]);
        Categories::create([
            'category_name' => 'Graphic Design Templates',
            'category_slug' => Str::slug('Graphic Design Templates')
        ]);
        Author::create([
            'name' => 'test'
        ]);

        Product::factory(100)->create();
        Tags::factory(150)->create();
        SpecialProduct::factory(20)->create();
        Testimony::factory(20)->create();

    }
}
