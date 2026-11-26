<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Product title
            $table->longText('description'); // Product description
            $table->integer('price'); // Product price
            $table->integer('compare_at_price')->nullable(); // Optional compare at price
            $table->boolean('status')->default(true); // Whether the product is active
            $table->integer('inventory'); // Available inventory
            $table->boolean('is_featured')->default(false); // If the product is featured

            // Removed 'image_url' since images are now stored in a separate table

            $table->string('slug')->unique(); // SEO-friendly URL
            $table->json('tags')->nullable(); // Tags for search/filter
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
