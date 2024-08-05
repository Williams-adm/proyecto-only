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
        Schema::create('discount_product', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('discount_id');
            $table->foreign('discount_id')->references('id')->on('discounts')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['product_id', 'discount_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_product');
    }
};
