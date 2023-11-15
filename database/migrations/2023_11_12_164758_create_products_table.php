<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_slug')->unique();
            $table->unsignedBigInteger('id_category');
            $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
            $table->float('price');
            $table->text('description');
            $table->string('tags')->nullable();
            $table->string('images')->nullable();
            $table->string('url')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->boolean('status')->default(1);
            $table->timestamps();

            // $table->foreign('id_categories')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
