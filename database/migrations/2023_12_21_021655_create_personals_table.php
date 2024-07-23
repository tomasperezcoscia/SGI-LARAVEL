<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personals', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('legajo')->unique(); // Unique employee number
            $table->string('nombre'); // Name
            $table->integer('salario_hora'); // Hourly wage
            $table->char('estado', 1); // Status
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    
        DB::table('personals')->insert([
            ['legajo' => 226, 'nombre' => 'Ricardo Miguel', 'salario_hora' => 1262, 'estado' => 'B'],
            ['legajo' => 227, 'nombre' => 'Palacios Jorge Luis', 'salario_hora' => 1400, 'estado' => 'A'],
            ['legajo' => 228, 'nombre' => 'Musumeci Juan Jose', 'salario_hora' => 805, 'estado' => 'A'],
            ['legajo' => 229, 'nombre' => 'Balvidares Dario', 'salario_hora' => 830, 'estado' => 'A'],
            ['legajo' => 230, 'nombre' => 'Robert Gabriel', 'salario_hora' => 866, 'estado' => 'B'],
            ['legajo' => 231, 'nombre' => 'Medina Gian', 'salario_hora' => 866, 'estado' => 'A'],
            ['legajo' => 232, 'nombre' => 'Rivero Pablo', 'salario_hora' => 814, 'estado' => 'B'],
            ['legajo' => 233, 'nombre' => 'Mendoza Alberto', 'salario_hora' => 964, 'estado' => 'A'],
            ['legajo' => 234, 'nombre' => 'Vallejos Braian David', 'salario_hora' => 1080, 'estado' => 'A'],
            ['legajo' => 235, 'nombre' => 'Kreuzberger Ramon', 'salario_hora' => 900, 'estado' => 'A'],
            ['legajo' => 236, 'nombre' => 'Pedrero Emmanuel', 'salario_hora' => 1080, 'estado' => 'A'],
            ['legajo' => 237, 'nombre' => 'Espinoza Eulogio', 'salario_hora' => 1262, 'estado' => 'A'],
            ['legajo' => 238, 'nombre' => 'Burgos Kevin Nicolas', 'salario_hora' => 705, 'estado' => 'A'],
            ['legajo' => 239, 'nombre' => 'Contrera Alfredo Daniel', 'salario_hora' => 841, 'estado' => 'A'],
            ['legajo' => 240, 'nombre' => 'Cos Maico David', 'salario_hora' => 866, 'estado' => 'A'],
            ['legajo' => 241, 'nombre' => 'Font Lujan Brian', 'salario_hora' => 948, 'estado' => 'A'],
            ['legajo' => 242, 'nombre' => 'Villarruel Guillermo Emmanuel', 'salario_hora' => 705, 'estado' => 'A'],
            ['legajo' => 243, 'nombre' => 'Pacheco Maximiliano', 'salario_hora' => 850, 'estado' => 'B'],
            ['legajo' => 244, 'nombre' => 'Caro Marcelo', 'salario_hora' => 2500, 'estado' => 'B'],
            ['legajo' => 245, 'nombre' => 'Flores Fernando', 'salario_hora' => 1166, 'estado' => 'A'],
            ['legajo' => 246, 'nombre' => 'Salvaresqui Jonathan', 'salario_hora' => 850, 'estado' => 'A'],
            ['legajo' => 247, 'nombre' => 'Vallejos Guerra Alexis', 'salario_hora' => 1158, 'estado' => 'A'],
            ['legajo' => 248, 'nombre' => 'Ayala Nestor', 'salario_hora' => 725, 'estado' => 'A'],
            ['legajo' => 249, 'nombre' => 'Revollo Cabrita Jhemy', 'salario_hora' => 802, 'estado' => 'A'],
            ['legajo' => 250, 'nombre' => 'Burnet Agustin', 'salario_hora' => 950, 'estado' => 'A'],
            ['legajo' => 251, 'nombre' => 'Navarro', 'salario_hora' => 850, 'estado' => 'B'],
            ['legajo' => 252, 'nombre' => 'Mato Enrique', 'salario_hora' => 1112, 'estado' => 'B'],
            ['legajo' => 253, 'nombre' => 'Dufau Mauricio', 'salario_hora' => 950, 'estado' => 'A'],
            ['legajo' => 254, 'nombre' => 'Pacheco Marcelo', 'salario_hora' => 795, 'estado' => 'B'],
            ['legajo' => 255, 'nombre' => 'Atadio Diego', 'salario_hora' => 950, 'estado' => 'A'],
            ['legajo' => 256, 'nombre' => 'Rafufino Pascual', 'salario_hora' => 1070, 'estado' => 'A'],
            ['legajo' => 257, 'nombre' => 'Rodriguez Victor', 'salario_hora' => 873, 'estado' => 'B'],
            ['legajo' => 258, 'nombre' => 'Gaitan Emilio', 'salario_hora' => 873, 'estado' => 'A'],
            ['legajo' => 259, 'nombre' => 'IzaguIrre Juan', 'salario_hora' => 873, 'estado' => 'A'],
            ['legajo' => 260, 'nombre' => 'Moro Román', 'salario_hora' => 873, 'estado' => 'A'],
        ]);
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personals');
    }
};
