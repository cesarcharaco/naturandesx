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

    public function empleados_has_ventas()
    {
        return $this->hasMany('App\EmpleadosVentas','id_empleado','id');
    }

    public function pagos()
    {
        return $this->hasMany('App\Pagos','id_empleado','id');
    }

    public function ventas()
    {
        return $this->belongsToMany('App\Ventas','empleados_has_ventas','id_empleado','id_venta')->withPivot('status');
    }
}
