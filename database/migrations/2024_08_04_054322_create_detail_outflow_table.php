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
        Schema::create('detail_outflow', function (Blueprint $table) {
            $table->integer('quantity');
            $table->unsignedBigInteger('inventory_id');
            $table->foreign('inventory_id')->references('id')->on('inventory')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('outflow_id');
            $table->foreign('outflow_id')->references('id')->on('outflows')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

            $table->primary(['outflow_id', 'inventory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_outflow');
    }
};
