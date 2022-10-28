<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPago extends Model
{
    use HasFactory;

            
    protected $table='Tipo_pago';
    protected $primaryKey='id_tipopago';
    public $timestamps=false;
    
    protected $fillable = [
        'nombretipo',

    ];
}
