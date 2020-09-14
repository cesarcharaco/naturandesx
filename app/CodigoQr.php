<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoQr extends Model
{
    protected $table="codigo_qr";

    protected $fillable=['codigo','codigo_recupera','status'];

    public function empleado()
    {
    	return $this->hasMany('App\Empleados','id_qr','id');
    }

    public function clientes()
    {
    	return $this->hasMany('App\Clientes','id_qr','id');
    }
}
