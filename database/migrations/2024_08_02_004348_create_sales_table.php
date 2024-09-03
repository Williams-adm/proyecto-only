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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('code', 15)->unique();
            $table->decimal('sub_total', 10,2);
            $table->decimal('igv', 10,2);
            $table->decimal('total', 10,2);
            /* $table->dateTime('sale_date'); */
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')
            ->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')
            ->onDelete('set null')->onUpdate('cascade');
            
            $table->unsignedBigInteger('cash_count_id')->nullable();
            $table->foreign('cash_count_id')->references('id')->on('cash_counts')
            ->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('sales');
    }
};
