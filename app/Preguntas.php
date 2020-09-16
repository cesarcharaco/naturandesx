<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preguntas extends Model
{
    protected $table='pregustas_seguridad';

    protected $fillable=['preguntas'];

    public function usuarios()
    {
    	return $this->belongsTo('App\User','id');
    }
}
