<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosCorporativos extends Model
{
    public $timestamps = false;

    public function corporativos()
    {
        return $this->hasMany(Corporativo::class, 'tw_corporativos_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tw_documentos_id');
    }
}
