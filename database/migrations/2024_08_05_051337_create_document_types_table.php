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
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['DNI', 'PASAPORTE', 'CARNET_EXT', 'RUC', 'OTROS']);
            $table->string('number', 15);
            $table->unique(['type', 'number', 'documentable_id', 'documentable_type'], 'doc_type_num_unique');
            $table->unsignedBigInteger('documentable_id');
            $table->string('documentable_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};
