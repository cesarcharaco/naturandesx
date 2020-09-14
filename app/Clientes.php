<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table='clientes';

    protected $fillable=['id_qr','nombres','apellidos','rut','email','status'];

    public function qr()
    {
    	return $this->belongsTo('App\CodigoQr','id_qr');
    }

    public function venta()
    {
    	return $this->hasMany('App\Clientes','id_cliente','id');
    }
}
