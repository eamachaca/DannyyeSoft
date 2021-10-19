<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresasCorporativo extends Model
{
    use SoftDeletes;

    protected $fillable=[
        'S_RazonSocial',
'S_RFC',
'S_Pais',
'S_Estado',
'S_Municipio',
'S_ColoniaLocalidad',
'S_Domicilio',
'S_CodigoPostal',
'S_UsoCFDI',
'S_UsoRFC',
'S_UrlActaConstitutiva',
'S_Activo',
'S_Comentarios',
'tw_corporativos_id'
    ];

    public function corporativo()
    {
        return $this->belongsTo(Corporativo::class, 'tw_usuarios_id');
    }
}
