<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresupuestosTable extends Migration
{
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orden_de_compra_id')->constrained('ordenes_de_compras')->onDelete('cascade');
            $table->string('estado'); // in_progress, presupuestado, en_espera_de_pago, etc.
            $table->string('numero_legajo')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presupuestos');
    }
}
