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
        Schema::create('cargas_sociales', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->decimal('f931',12,2)->default(0)->nullable();
            $table->decimal('uocra',12,2)->default(0)->nullable();
            $table->decimal('intereses',12,2)->default(0)->nullable();
            $table->decimal('ieric',12,2)->default(0)->nullable();
            $table->decimal('fondoDesempleo',12,2)->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas_sociales');
    }
};
