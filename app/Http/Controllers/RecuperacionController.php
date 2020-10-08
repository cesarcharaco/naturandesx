<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Empleados;
use App\Clientes;
use App\User;
use App\CodigoRecuperacion;
use App\Http\Requests\RecuperacionRequest;
class RecuperacionController extends Controller
{
    public function index()
    {
    	return view('auth.recuperacion.index');
    }

    public function seleccion(Request $request)
    {
    	$opcion=$request->opcion;
    	if ($opcion==1) {
    		//buscando correo en user

    		$usuario=User::where('email',$request->email)->first();
            $id_usuario=$usuario->id;
    		if(!is_null($usuario)){
    			//si el correo existe
    		$destinatario=$usuario->email;
    		$codigo=$this->generar_codigo();
    		//dd($codigo);
    		$asunto="Código de Recuperación de Clave";
    		//buscando si tiene un código en estatus ENVIADO....
    		//para colocarlo como vencido y enviar otro
    		$buscar=CodigoRecuperacion::where('email',$destinatario)->where('status','Enviado')->first();
    		if (!is_null($buscar)) {
    			$buscar->status="Vencido";
    			$buscar->save();
    		} else {
    			
    			$enviado=new CodigoRecuperacion();
	    		$enviado->email=$destinatario;
	    		$enviado->codigo=$codigo;
	    		$enviado->save();
    		}
    		
    		//enviando correo
    			$r=Mail::send('auth.recuperacion.codigo_recuperacion',
                        ['codigo'=>$codigo], function ($m) use ($codigo,$asunto,$destinatario) {
                        $m->from('promociones@naturandeschile.com', 'Naturandes!');
                        $m->to($destinatario)->subject($asunto);
                        
                    });

    		toastr()->success('Éxito!!', 'El código de recuperación ha sido enviado a su correo');
    		 	return view('auth.recuperacion.validacion', compact('id_usuario','opcion'));
    		}else{
    			toastr()->warning('Alerta!!', 'El correo ingresado no se encuentra registrado');
    			return redirect()->back();
    		}
    	} else {
    		# en caso de recuperación por preguntas de seguridad
            $rut=$request->rut.'-'.$request->verificador;
            $usuario=User::where('rut',$rut)->first();
            $id_usuario=$usuario->id;
            if (!is_null($usuario)) {
            $preguntas=array();
            $i=0;
            foreach ($usuario->preguntas as $key) {
                $preguntas[$i]=$key->pregunta;
                $i++;
            }

            return view('auth.recuperacion.validacion', compact('opcion','preguntas','id_usuario'));
            } else {
                # code...
                toastr()->warning('Alerta!!', 'El RUT ingresado no se encuentra registrado');
                return redirect()->back();   
            }
            
    	}
    	
    }

    public function validar(Request $request)
    {
        $id_usuario=$request->id_usuario;
        $opcion=$request->opcion;
        if ($opcion==1) {
            $buscar=CodigoRecuperacion::where('id_usuario',$request->id_usuario)->where('codigo',$request->codigo)->where('status','Enviado')->first();
            if (!is_null($buscar)) {
                $buscar->status="Usado";
                toastr()->success('Éxito!!', 'Código correcto');
                return view('auth.recuperacion.nueva_clave', compact('opcion','id_usuario'));       
            } else {
                toastr()->warning('Alerta!!', 'Código Vencido o Incorrecto');
                return redirect()->back();
            }
            

        } else {
            $usuario=User::find($request->id_usuario);
            $hallado=0;
            foreach ($usuario->preguntas as $key) {
                if($key->pivot->respuesta==$respuesta1){
                    $hallado++;
                }
                if($key->pivot->respuesta==$respuesta2){
                    $hallado++;
                }
            }

            if ($hallado==2) {
                toastr()->success('Éxito!!', 'Código correcto');
                return view('auth.recuperacion.nueva_clave', compact('opcion','id_usuario'));       
            } else {
                toastr()->warning('Alerta!!', 'Las respuestas no coinciden');
                return redirect()->back();
            }
            
        }
        
    }

    public function nueva_clave(RecuperacionRequest $request)
    {
        $nueva_clave=\Hash::make($request->password);
        $usuario=User::find($request->id_usuario);
        $usuario->password=$nueva_clave;
        $usuario->save();

        toastr()->warning('Éxito!!', 'Contraseña cambiada');
        return redirect()->to('/');
    }
    private function generar_codigo()
    {

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;	
	 }
    
}
