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
        Schema::create('outflows', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique();
            $table->string('operation', 55);
            $table->string('reazon', 155)->nullable();
            $table->string('type_voucher', 50)->nullable();
            $table->string('num_voucher', 15)->nullable();
            $table->string('path_voucher')->unique()->nullable();
            /* $table->dateTime('departure_date'); */
            $table->unsignedBigInteger('branch_id');
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
        Schema::dropIfExists('outflows');
    }
};
