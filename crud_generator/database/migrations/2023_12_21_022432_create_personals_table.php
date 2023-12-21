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
        Schema::create('personals', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('legajo')->unique(); // Unique employee number
            $table->string('nombre'); // Name
            $table->integer('salario_hora'); // Hourly wage
            $table->char('estado', 1); // Status
            $table->date('fechaDeAlta'); // Date of hiring
            $table->date('fechaDeBaja')->nullable(); // Date of termination, nullable
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
