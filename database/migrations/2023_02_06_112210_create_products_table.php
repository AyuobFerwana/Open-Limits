<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName', 50);
            $table->string('discreption', 150);
            $table->json('colors');
            $table->json('sizes');
            $table->integer('quantity');
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('price');
            $table->string('discount')->default(0);
            $table->boolean('flag')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
