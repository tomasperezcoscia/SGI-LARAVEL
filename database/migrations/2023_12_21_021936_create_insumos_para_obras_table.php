<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosParaObrasTable extends Migration
{
    public function up()
    {
        Schema::create('insumos_para_obras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_insumo'); // Foreign key to Insumos
            $table->unsignedBigInteger('id_obra'); // Foreign key to Obras
            $table->integer('cantidad'); // Quantity of the insumo used in the obra
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_insumo')->references('id')->on('insumos');
            $table->foreign('id_obra')->references('id')->on('obras');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumos_para_obras');
    }
}
