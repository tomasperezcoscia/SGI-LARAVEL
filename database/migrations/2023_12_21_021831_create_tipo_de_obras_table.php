<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoDeObrasTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_de_obras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Name of the type of obra
            $table->string('tipo'); // Type
            $table->text('descripcion')->nullable(); // Description, can be nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_de_obras');
    }
}
