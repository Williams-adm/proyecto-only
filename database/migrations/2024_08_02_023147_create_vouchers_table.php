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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->enum('type_voucher',['BOLETA', 'FACTURA']);
            $table->string('num_voucher',15)->unique();
/*             $table->dateTime('issue_date'); */
            $table->string('path')->unique();
            $table->unsignedBigInteger('sale_id')->unique();
            $table->foreign('sale_id')->references('id')->on('sales')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
