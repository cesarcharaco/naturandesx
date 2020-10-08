<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodigoRecuperacion extends Model
{
    protected $table='codigos_recuperacion';

    protected $fillable=['email','codigo','status'];
}
