<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
        
    protected $table='Proveedor';
    protected $primaryKey='id_proveedor';
    public $timestamps=false;
    
    protected $fillable = [
        'nombreproveedor',
        'direccionproveedor',
        'nitproveedor',

    ];
}
