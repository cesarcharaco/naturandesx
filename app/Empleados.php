<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table='empleados';

    protected $fillable=['id_usuario','id_qr','nombres','apellidos','rut','telefono','direccion','status'];

    public function usuario()
    {
        return $this->belongsTo('App\User','id_usuario');
    }

    public function qr()
    {
    	return $this->belongsTo('App\CodigoQr','id_qr');
    }
}
