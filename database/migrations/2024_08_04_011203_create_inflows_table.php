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
        Schema::create('inflows', function (Blueprint $table) {
            $table->id();
            $table->string('operation', 55);
            /* $table->dateTime('entry_date'); */
            $table->string('num_voucher', 15);
            $table->string('path_voucher')->unique();
            $table->decimal('total', 10, 2)->nullable();
            $table->text('reazon')->nullable();
            /* $table->string('num_voucher_sale', 15)->nullable(); */

            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')
            ->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inflows');
    }
};
