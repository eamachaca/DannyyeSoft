<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactosCorporativo extends Model
{
    protected $fillable = ['S_Nombre', 'S_Puesto', 'S_Comentarios', 'N_TelefonoFijo', 'N_TelefonoMovil', 'S_Email', 'tw_corporativos_id'];
    public $timestamps = false;

    public function corporativo()
    {
        return $this->belongsTo(Corporativo::class, 'tw_corporativos_id');
    }
}
