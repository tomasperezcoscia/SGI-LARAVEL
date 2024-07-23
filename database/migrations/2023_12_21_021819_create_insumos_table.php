<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosTable extends Migration
{
    public function up()
    {
        Schema::create('insumos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Name of the insumo
            $table->string('tipo'); // Type of the insumo
            $table->timestamp('fecha');
            $table->double('precio', 8, 2); // Price
            $table->unsignedBigInteger('proovedor_id')->nullable(); // Foreign key to Proovedores
            $table->unsignedBigInteger('orden_de_compra_id')->nullable();
            $table->string('factura');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('proovedor_id')->references('id')->on('proovedores');
            $table->foreign('orden_de_compra_id')->references('id')->on('ordenes_de_compras');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
