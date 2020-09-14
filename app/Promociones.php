<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    protected $table="promociones";

    protected $fillable=['promocion','descripcion','monto','status'];

    public function ventas()
    {
        return $this->hasOne('App\Ventas','id_promocion','id');
    }
}
