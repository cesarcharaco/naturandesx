<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empleado()
    {
        return $this->hasOne('App\Empleados','id_usuario','id');
    }

    public function clientes()
    {
        return $this->hasOne('App\Clientes','id_usuario','id');
    }

    public function preguntas()
    {
        return $this->belongsToMany('App\Preguntas','usuarios_has_preguntas','id_usuario','id_pregunta')->withPivot('respuesta');
    }

}
