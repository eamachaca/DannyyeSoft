<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'S_Nombre', 'N_Obligatorio', 'S_Descripcion'
    ];
    public function documentoCorporativos()
    {
        return $this->hasMany(DocumentosCorporativo::class, 'tw_documentos_id');
    }

    public function corporativos()
    {
        return $this->belongsToMany(
            Corporativo::class,
            DocumentosCorporativo::class,
            'tw_documentos_id',
            'tw_corporativos_id'
        );
    }
}
