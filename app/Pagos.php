<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table='pagos';

	protected $fillable=['id','id_empleado','cantidad','fecha'];

	public function empleados()
    {
    	return $this->belongsTo('App\Empleados','id_empleado');
    }
}
