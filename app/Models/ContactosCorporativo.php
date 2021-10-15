<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactosCorporativo extends Model
{
    public function corporativo()
    {
        return $this->belongsTo(Corporativo::class,'tw_usuarios_id');
    }
}
