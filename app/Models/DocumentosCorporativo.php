<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentosCorporativo extends Model
{
    public $timestamps = false;
    protected $fillable = ['S_ArchivoUrl', "tw_corporativos_id", "tw_documentos_id"];

    public function corporativo()
    {
        return $this->belongsTo(Corporativo::class, 'tw_corporativos_id');
    }

    public function documento()
    {
        return $this->belongsTo(Documento::class, 'tw_documentos_id');
    }
}
