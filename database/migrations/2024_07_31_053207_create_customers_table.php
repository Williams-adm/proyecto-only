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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 65)->nullable();
            $table->string('paternal_surname', 25)->nullable();
            $table->string('maternal_surname', 25)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('business_name', 85)->nullable();
            $table->string('fiscal_address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
