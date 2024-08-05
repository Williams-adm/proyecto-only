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
        Schema::create('detail_images', function (Blueprint $table) {
            $table->id();
            $table->string('path')->unique();
            $table->unsignedBigInteger('detail_value_id');
            $table->foreign('detail_value_id')->references('id')->on('detail_values')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_images');
    }
};
