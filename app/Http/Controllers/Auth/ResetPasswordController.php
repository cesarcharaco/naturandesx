<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Preguntas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    public function resetPassword(Request $request)
    {
        if ($request->opcion == 1) {
            $user=User::find($request->id_usuario);
            $pregunta=\DB::table('usuarios_has_preguntas')->where('id_usuario',$user->id)->first();
            $preguntas=Preguntas::all();

            if($pregunta->respuesta == $request->respuesta){
                return View('auth.passwords.reset', compact('user'));
            }else{
                if (is_null($pregunta)) {
                    $pregunta=null;
                }                
                return view('auth.passwords.pregunta-user', compact('preguntas','user','pregunta'));
            }
        }
    }




    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
