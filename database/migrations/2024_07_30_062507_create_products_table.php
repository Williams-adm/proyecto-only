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
            $table->string('name', 75)->unique();
            $table->string('code', 10)->unique();
            $table->text('description');
            $table->text('usage_recomendation')->nullable();
            $table->text('additional_features')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('cover_image_path')->unique();
            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('set null')->onUpdate('cascade');
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
