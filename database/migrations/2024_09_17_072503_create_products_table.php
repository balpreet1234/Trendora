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
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('photo')->nullable();
            $table->string('sku')->nullable();
            $table->string('stock')->nullable();
            $table->string('size')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->enum('condition',['default','new','hot'])->default('default');
            $table->string('tags')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('is_featured')->nullable();
            $table->string('cat_id')->nullable();
            $table->string('child_cat_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->timestamps();
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
