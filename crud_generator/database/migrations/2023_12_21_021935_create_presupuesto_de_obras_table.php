<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestoDeObrasTable extends Migration
{
    public function up()
    {
        Schema::create('presupuesto_de_obras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra'); // Foreign key to Obra
            $table->string('nombre'); // Name of the budget
            $table->integer('legajo'); // Legajo number or identifier
            $table->unsignedBigInteger('id_cliente'); // Foreign key to Cliente
            $table->unsignedBigInteger('id_insumosParaObra')->nullable(); // Relation with InsumosParaObra
            $table->unsignedBigInteger('id_horasDePersonal')->nullable(); // Relation with HorasPersonal
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_obra')->references('id')->on('obras');
            $table->foreign('id_cliente')->references('id')->on('clientes');
            // Define foreign keys for id_insumosParaObra and id_horasDePersonal if necessary
        });
    }

    public function down()
    {
        Schema::dropIfExists('presupuesto_de_obras');
    }
}
