<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAusenciasPersonalsTable extends Migration
{
    public function up()
    {
        Schema::create('ausencias_personals', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Type of absence
            $table->text('descripcion')->nullable(); // Description of the absence, nullable
            $table->timestamp('fechaDeInicio'); // Start date of the absence
            $table->timestamp('fechaDeFin')->nullable(); // End date of the absence, nullable
            $table->unsignedBigInteger('personal_id'); // Foreign key to Personal
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('personal_id')->references('id')->on('personal');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ausencias_personals');
    }
}
