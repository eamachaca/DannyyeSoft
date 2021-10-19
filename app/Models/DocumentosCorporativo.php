<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosCorporativo extends Model
{
    public $timestamps = false;
    protected $fillable = ['S_ArchivoUrl', "tw_corporativos_id", "tw_documentos_id"];

    public function corporativos()
    {
        return $this->hasMany(Corporativo::class, 'tw_corporativos_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'tw_documentos_id');
    }
}
