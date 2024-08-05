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
        Schema::create('detail_sale', function (Blueprint $table) {
            $table->integer('quantity');
            $table->decimal('discount', 4,2);
            $table->decimal('unit_price', 5,2);
            $table->decimal('amount', 10,2);
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['sale_id', 'inventory_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_sale');
    }
};
