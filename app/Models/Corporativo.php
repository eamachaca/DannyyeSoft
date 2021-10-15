<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporativo extends Model
{
    use SoftDeletes;

    public function usuario()
    {
        return $this->belongsTo(Usuario::class,'tw_usuarios_id');
    }

    public function usuarioAsignado()
    {
        return $this->belongsTo(Usuario::class,'FK_Asignado_id');
    }

    public function contactos()
    {
        return $this->hasMany(ContactosCorporativo::class,'tw_usuarios_id');
    }

    public function empresas()
    {
        return $this->hasMany(EmpresasCorporativo::class,'tw_usuarios_id');
    }

    public function documentos()
    {
        return $this->belongsToMany(
            Documento::class,
            DocumentosCorporativos::class,
            'tw_corporativos_id',
            'tw_documentos_id'
        );
    }
}
