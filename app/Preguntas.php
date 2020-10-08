<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    protected $table='preguntas_seguridad';

    protected $fillable=['preguntas'];

    public function usuarios()
    {
    	return $this->belongsToMany('App\User','usuarios_has_preguntas','id_pregunta','id_usuario')->withPivot('respuesta');
    }
}
