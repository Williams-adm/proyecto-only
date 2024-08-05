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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 10,2);
            $table->enum('type', ['salida','entrada']);
            $table->text('description');
            $table->dateTime('cash_transaction_date');
            $table->unsignedBigInteger('cash_count_id')->nullable();
            $table->foreign('cash_count_id')->references('id')->on('cash_counts')
            ->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};
