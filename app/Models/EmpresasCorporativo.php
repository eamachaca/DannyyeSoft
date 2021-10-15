<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresasCorporativo extends Model
{
    use SoftDeletes;

    public function corporativo()
    {
        return $this->belongsTo(Corporativo::class, 'tw_usuarios_id');
    }
}
