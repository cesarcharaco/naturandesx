<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadosVentas extends Model
{
    protected $table='empleados_has_ventas';

	protected $fillable=['id','id_empleado','id_venta','status'];

	public function empleado()
	{
	  	return $this->belongsTo('App\Empleados','id_empleado','id');
	}
	public function venta()
	{
	  	return $this->belongsTo('App\Ventas','id_venta','id');
	}
}
