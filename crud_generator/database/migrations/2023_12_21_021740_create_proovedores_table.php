<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProovedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proovedores', function (Blueprint $table) {
            $table->id();
            $table->integer('legajo')->unique(); // Unique provider number
            $table->string('nombre'); // Provider's name
            $table->bigInteger('numeroDeTelefono'); // Phone number as long int
            $table->string('cuil', 14); // CUIL number
            $table->string('tipo'); // Type of provider
            $table->date('fechaAlta'); // Date of registration
            $table->date('fechaBaja')->nullable(); // Date of deregistration, nullable
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proovedores');
    }
}
