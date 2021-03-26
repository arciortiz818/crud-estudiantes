<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombres','apellidos','tipo_identificacion','nro_identificacion','sexo','fecha_nacimiento','carrera'];
}
