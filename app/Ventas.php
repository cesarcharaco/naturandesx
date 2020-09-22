<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table='ventas';

    protected $fillable=['id_cliente','id_promocion','cantidad','monto_total'];

    public function cliente()
    {
        return $this->belongsTo('App\Clientes','id_cliente');
    }

    public function promociones()
    {
    	return $this->belongsTo('App\Promociones','id_promocion');
    }

    public function empleados_has_ventas()
    {
        return $this->hasMany('App\EmpleadosVentas','id_venta','id');
    }
}