<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete()->after('id');
            $table->string('vehicle_type')->default('motorcycle')->after('slug');
            $table->string('condition')->default('new')->after('vehicle_type');
            $table->string('model_year')->nullable()->after('condition');
            $table->string('sku')->unique()->nullable()->after('id');
            $table->string('video_url')->nullable()->after('description');
            $table->string('manual_pdf')->nullable()->after('video_url');
            $table->string('warranty_info')->nullable()->after('manual_pdf');
            $table->json('highlights')->nullable()->after('tags');
            $table->json('colors')->nullable()->after('highlights');
            $table->string('meta_title')->nullable()->after('colors');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->string('og_image')->nullable()->after('meta_description');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'brand_id', 'vehicle_type', 'condition', 'model_year', 'sku',
                'video_url', 'manual_pdf', 'warranty_info',
                'highlights', 'colors', 'meta_title', 'meta_description', 'og_image',
            ]);
        });
    }
};
