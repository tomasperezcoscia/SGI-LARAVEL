<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_de_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('numeroOrdenInterna')->unique();
            $table->unsignedBigInteger('cliente_id');
            $table->integer('numeroOrden');
            $table->string('descripcionTarea')->nullable();
            $table->string('cuit_cuil', 13);
            $table->date('fechaDeIngreso');
            $table->char('caracter');
            $table->integer('polizaArt');
            $table->date('vencimientoPolizaArt');
            $table->integer('polizaDeAccPer');
            $table->date('vencimientoPolizaDeAccPer');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_de_compras');
    }
}
