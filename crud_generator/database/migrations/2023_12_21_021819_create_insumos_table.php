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
            $table->double('precio', 8, 2); // Price
            $table->integer('inventario'); // Inventory quantity
            $table->date('ultimaFechaPrecio'); // Last date when the price was updated
            $table->unsignedBigInteger('proovedor_id')->nullable(); // Foreign key to Proovedores
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('proovedor_id')->references('id')->on('proovedores');
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumos');
    }
}
