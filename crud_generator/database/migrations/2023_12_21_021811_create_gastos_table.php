<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosTable extends Migration
{
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Name of the expense
            $table->string('tipo'); // Type of expense
            $table->float('porcentajeIva', 8, 2); // VAT percentage
            // Assuming a relationship with another table, e.g., a `categoria_id` foreign key
            // $table->unsignedBigInteger('categoria_id');
            $table->timestamps();

            // If there's a foreign key
            // $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
