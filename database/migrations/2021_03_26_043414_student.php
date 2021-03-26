<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students',function(Blueprint $table){
            $table->id();
            $table->string('nombres',100);
            $table->string('apellidos',100);
            $table->string('tipo_identificacion',20);
            $table->string('nro_identificacion',20);
            $table->string('sexo',20);
            $table->date('fecha_nacimiento');
            $table->string('carrera',30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
