<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorasPersonalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_personals', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->unsignedBigInteger('personal_id');
            $table->unsignedBigInteger('orden_de_compra_id');
            $table->unsignedFloat('cant_horas');
            $table->unsignedFloat('precio_hora_a_fecha_de_carga');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('personal_id')->references('id')->on('personals');
            $table->foreign('orden_de_compra_id')->references('id')->on('ordenes_de_compras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horas_personals');
    }
}
