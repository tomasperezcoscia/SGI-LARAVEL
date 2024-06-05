<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumoObraTable extends Migration
{
    public function up()
    {
        Schema::create('insumo_obra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('obra_id')->constrained()->onDelete('cascade');
            $table->foreignId('insumo_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumo_obra');
    }
}
