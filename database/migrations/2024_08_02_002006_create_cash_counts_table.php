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
        Schema::create('cash_counts', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_sale', 10,2);
            $table->decimal('total_income', 10,2);
            $table->decimal('total_outflow', 10,2);
            $table->decimal('total_cash', 10,2);
            /* $table->dateTime('cash_count_date'); */
            $table->string('path')->unique();
            $table->unsignedBigInteger('branch_id')->unique();
            $table->foreign('branch_id')->references('id')->on('branches')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_counts');
    }
};
