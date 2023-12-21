<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Name of the obra
            $table->integer('legajo'); // Legajo number or identifier
            $table->unsignedBigInteger('id_cliente'); // Foreign key to Cliente
            // Assuming a relation with InsumosParaObra and HorasPersonal
            $table->unsignedBigInteger('id_insumosParaObra')->nullable();
            $table->unsignedBigInteger('id_horasDePersonal')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_cliente')->references('id')->on('clientes');
            // Add foreign key constraints for id_insumosParaObra and id_horasDePersonal if necessary
        });
    }

    public function down()
    {
        Schema::dropIfExists('obras');
    }
}
