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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('legajo')->unique(); // Unique client number
            $table->string('nombre'); // Client's name
            $table->string('tipo'); // Type of client
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        DB::table('clientes')->insert(
            array(
                'legajo' => 1,
                'nombre' => 'Basis Construcciones S.R.L.',
                'tipo' => 'Dueño'
            )
        );

        DB::table('clientes')->insert(
            array(
                'legajo' => 2,
                'nombre' => 'Cementos Avellaneda S.A.',
                'tipo' => 'Cementera'
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
