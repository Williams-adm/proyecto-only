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
        Schema::create('employee_role', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['role_id', 'employee_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_role');
    }
};
