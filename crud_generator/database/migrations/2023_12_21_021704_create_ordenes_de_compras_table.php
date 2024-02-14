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
            $table->float('valorTarea')->nullable();
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
