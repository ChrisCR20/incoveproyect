<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_facturaC extends Model
{
    use HasFactory;

    protected $table='detalle_facturaC';
    protected $primaryKey='id_detallefacturaC';
    public $timestamps=false;
    
    protected $fillable = [
        'id_producto',
        'subtotal',
        'cantidad'

    ];
}
