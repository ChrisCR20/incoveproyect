<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table='Empleado';
    protected $primaryKey='id_empleado';
    public $timestamps=false;
    
    protected $fillable = [
        'codunicoid',
        'tel_corporativo',
        'status',

    ];
}
