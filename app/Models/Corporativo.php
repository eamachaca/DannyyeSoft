<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporativo extends Model
{
    protected $fillable = [
        'S_NombreCorto', 'S_NombreCompleto', 'S_LogoURL','S_DBName', 'S_DBUsuario', 'S_DBPassword',
        'S_SystemUrl', 'S_Activo', 'D_FechaIncorporacion','tw_usuarios_id', 'FK_Asignado_id', 'S_DBPassword',
    ];
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
            DocumentosCorporativo::class,
            'tw_corporativos_id',
            'tw_documentos_id'
        );
    }
}
