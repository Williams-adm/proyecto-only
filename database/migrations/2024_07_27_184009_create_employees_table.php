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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 65);
            $table->string('paternal_surname', 25);
            $table->string('maternal_surname', 25);
            $table->date('date_of_brith');
            $table->decimal('salary', 8,2);
            $table->string('payment_date', 120);
            $table->string('photo_path')->nullable()->unique();
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
