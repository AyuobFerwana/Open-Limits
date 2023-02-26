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
            $table->string('productName', 50);
            $table->string('discreption', 150);
            $table->json('colors');
            $table->json('size');
            $table->integer('quantity');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->float('price');
            $table->string('discount')->default(0);
            $table->boolean('flag')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
