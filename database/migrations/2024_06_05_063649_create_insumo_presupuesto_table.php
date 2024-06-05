<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumoPresupuestoTable extends Migration
{
    public function up()
    {
        Schema::create('insumo_presupuesto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('presupuesto_id')->constrained()->onDelete('cascade');
            $table->foreignId('insumo_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insumo_presupuesto');
    }
}
