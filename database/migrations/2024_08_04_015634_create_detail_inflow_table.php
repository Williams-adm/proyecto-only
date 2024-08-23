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
        Schema::create('detail_inflow', function (Blueprint $table) {
            $table->integer('quantity');
            $table->decimal('purcharse_price', 7,2)->nullable();
            $table->decimal('profit', 4,2)->nullable();
            $table->unsignedBigInteger('inflow_id');
            $table->foreign('inflow_id')->references('id')->on('inflows')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventories')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->primary(['inflow_id', 'inventory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_inflow');
    }
};
