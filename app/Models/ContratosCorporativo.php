<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratosCorporativo extends Model
{
    protected $fillable = [
        "D_FechaInicio", "D_FechaFin", "S_URLContrato", "tw_corporativos_id"
    ];
    public $timestamps = false;
}
