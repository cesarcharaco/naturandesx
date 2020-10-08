<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Empleados;
use App\Clientes;
use App\User;
use App\CodigoRecuperacion;
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
    		}
    		//enviando correo
    			$r=Mail::send('auth.recuperacion.codigo_recuperacion',
                        ['codigo'=>$codigo], function () use ($codigo,$asunto,$destinatario) {
                        $m->from('promociones@naturandeschile.com', 'Naturandes!');
                        $m->to($destinatario)->subject($asunto);
                        
                    });

    		toastr()->succes('Éxito!!', 'El código de recuperación ha sido enviado a su correo');
    		 	return view('auth.recuperacion.validacion', compact('destinatario','opcion'));
    		}else{
    			toastr()->warning('Alerta!!', 'El correo ingresado no se encuentra registrado');
    			return redirect()->back();
    		}
    	} else {
    		# en caso de recuperación por preguntas de seguridad
    	}
    	
    }

    private function generar_codigo()
    {

		$key = '';
    	$pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$max = strlen($pattern)-1;
    	for($i=0;$i < 8;$i++) $key .= $pattern{mt_rand(0,$max)};
    	return $key;
	

		//Me funcionó esto
			$key = '';
		    $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $max = strlen($pattern)-1;
		    
		    for($i=0;$i < 8;$i++){
		    	$key .= $pattern=mt_rand(0,$max);
		    }
		    return $key;	
	    }
    	//
}
