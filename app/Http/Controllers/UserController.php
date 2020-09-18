<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Preguntas;
use App\Clientes;
use App\Empleados;
use App\CodigoQr;
use QR_Code\Types\QR_Url;
use QRCode;
use Mail;
use PDF;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preguntas =  \DB::table('preguntas_seguridad')->get();
        $users=User::find($id);
        
        return view('user.show', compact('users','preguntas'));
    }
    public function buscar_preguntas($id_pregunta)
    {
        return $preguntas=Preguntas::where('id','<>',$id_pregunta)->get();
    }

    public function editar_perfil(Request $request)
    {
        //dd($request->all());
        if (\Auth::User()->tipo_usuario=="Empleado") {
            $user=User::find($request->id_usuario);
            $buscar_user = User::where('usuario',$request->usuario)->where('id','<>',$user->id)->get();
            if ($request->datos_per==1) {
                if (count($buscar_user)>0) {
                    toastr()->error('Error!!', ' Usuario ya registrado en el sistema');
                    return redirect()->back();
                } else {
                    $buscar_email = User::where('email',$request->email)->where('id','<>',$user->id)->get();
                    if (count($buscar_email)>0) {
                        toastr()->error('Error!!', ' Email ya registrado en el sistema');
                        return redirect()->back();
                    } else {
                        $usuario = User::find($request->id_usuario);
                        $usuario->usuario=$request->usuario;
                        $usuario->email=$request->email;
                        $usuario->save();

                        $empleados =Empleados::find($request->id_empleado);
                        $empleados->nombres=$request->nombres;
                        $empleados->apellidos=$request->apellidos;
                        $empleados->telefono=$request->telefono;
                        $empleados->direccion=$request->direccion;
                        $empleados->save();

                        toastr()->success('Éxito!!', ' Perfil actualizado satisfactoriamente');
                        return redirect()->back();
                    }
                    
                }
                
            } else if ($request->datos_seg==1) {
                if ($request->cambiar_password==1) {
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();
                } else if ($request->cambiar_preguntas==1){
                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                } else if ($request->cambiar_password==1 && $request->cambiar_preguntas==1){
                    //dd($id_preguntas);
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();
                    
                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                }
            }
            
        } else if (\Auth::User()->tipo_usuario=="Cliente") {
            $user=User::find($request->id_usuario);
            $buscar_user = User::where('usuario',$request->usuario)->where('id','<>',$user->id)->get();
            if ($request->datos_per==1) {
                if (count($buscar_user)>0) {
                    toastr()->error('Error!!', ' Usuario ya registrado en el sistema');
                    return redirect()->back();
                } else {
                    $buscar_email = User::where('email',$request->email)->where('id','<>',$user->id)->get();
                    if (count($buscar_email)>0) {
                        toastr()->error('Error!!', ' Email ya registrado en el sistema');
                        return redirect()->back();
                    } else {
                        $clientes = Clientes::find($request->id_cliente);
                        $clientes->nombres=$request->nombres;
                        $clientes->apellidos=$request->apellidos;
                        $clientes->save();

                        $usuario = User::find($request->id_usuario);
                        $usuario->usuario=$request->usuario;
                        if ($request->email=="") {
                            $usuario->email=NULL;
                        } else {
                            $usuario->email=$request->email;
                        }
                        $usuario->save();
                    }
                }

                toastr()->success('Éxito!!', ' Perfil actualizado satisfactoriamente');
                return redirect()->back();

            } else if ($request->datos_seg==1){
                if ($request->cambiar_password==1) {
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();
                } else if ($request->cambiar_preguntas==1){
                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                } else if ($request->cambiar_password==1 && $request->cambiar_preguntas==1){
                    //dd($id_preguntas);
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();
                    
                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                }
                
            }
        } else if (\Auth::User()->tipo_usuario=="Admin") {
            $user=User::find($request->id_usuario);
            $buscar_user = User::where('usuario',$request->usuario)->where('id','<>',$user->id)->get();
            if ($request->datos_per==1) {
                if (count($buscar_user)>0) {
                    toastr()->error('Error!!', ' Usuario ya registrado en el sistema');
                    return redirect()->back();
                } else {
                    $buscar_email = User::where('email',$request->email)->where('id','<>',$user->id)->get();
                    if (count($buscar_email)>0) {
                        toastr()->error('Error!!', ' Email ya registrado en el sistema');
                        return redirect()->back();
                    } else {
                        $clientes = Empleados::find($request->id_empleado);
                        $clientes->nombres=$request->nombres;
                        $clientes->apellidos=$request->apellidos;
                        $clientes->telefono=$request->telefono;
                        $clientes->direccion=$request->direccion;
                        $clientes->save();

                        $usuario = User::find($request->id_usuario);
                        $usuario->usuario=$request->usuario;
                        $usuario->email=$request->email;
                        $usuario->save();
                    }
                }

                toastr()->success('Éxito!!', ' Perfil actualizado satisfactoriamente');
                return redirect()->back();

            } else if ($request->datos_seg==1){
                //dd($request->all());
                if ($request->cambiar_password==1) {
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();
                } else if ($request->cambiar_preguntas==1){
                    //dd($id_preguntas);
                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                } else if ($request->cambiar_password==1 && $request->cambiar_preguntas==1){
                    //dd($id_preguntas);
                    $clave = $request->password;
                    $usuario = new User();
                    $nueva_clave=\Hash::make($clave);
                    $usuario->password=$nueva_clave;
                    $usuario->save();

                    DB::table('usuarios_has_preguntas')->where('id_usuario',$request->id_usuario)->delete();
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta1,
                        'respuesta' => $request->respuesta1
                    ]);
                    \DB::table('usuarios_has_preguntas')->insert([
                        'id_usuario' => $request->id_usuario,
                        'id_pregunta' => $request->pregunta2,
                        'respuesta' => $request->respuesta2
                    ]);
                    
                    toastr()->success('Éxito!!', ' Perfil datos de seguridad actualizado satisfactoriamente');
                    return redirect()->back();
                }
                
            }
        }
        
    }

    public function generar_qr($id) 
    {
        $user = Empleados::where('id',$id)->first();
        $rut = $user->rut;
        $id_qr = $user->id_qr;
        //dd($id_qr);

        $qr_code = QRCode::text($rut)
        ->setOutfile('./img/qr-code/'.$rut.'.png')
        ->setSize(8)
        ->setMargin(2)
        ->png();

        $url_img = "img/qr-code/".$rut.".png";
        $qr = CodigoQr::find($id_qr);
        $qr->codigo=$url_img;
        $qr->save();

        toastr()->success('Éxito!!', ' QR generado satisfactoriamente');
        return redirect()->back();
    }

    public function descargar_qr_pdf($id)
    {
        if (\Auth::User()->tipo_usuario=="Admin" || \Auth::User()->tipo_usuario=="Empleado") {
            $user = Empleados::where('id',$id)->first();
            $nombres = $user->nombres.' '.$user->apellidos;
            $email = $user->usuario->email;
            $rut = $user->rut;
            $url_img = $user->qr->codigo;
            $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
            return $pdf->stream('carnet_qr.pdf');
        } else if (\Auth::User()->tipo_usuario=="Cliente") {
            $user = Clientes::where('id',$id)->first();
            $nombres = $user->nombres.' '.$user->apellidos;
            $email = $user->usuario->email;
            $rut = $user->rut;
            $url_img = $user->qr->codigo;
            $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
            return $pdf->stream('carnet_qr.pdf');
        }
        
    }

    public function enviar_qr($id)
    {
        if (\Auth::User()->tipo_usuario=="Admin" || \Auth::User()->tipo_usuario=="Empleado") {
            //dd('hola mundo');
            $user = Empleados::where('id',$id)->first();
            $nombres= $user->nombres.' '.$user->apellidos;
            $email= $user->usuario->email;
            $rut = $user->rut;
            $url_img = $user->qr->codigo;
            $asunto="Naturandes! | Bienvenido";
            $destinatario=$user->usuario->email;
            $mensaje="Bienvenido a Naturandes";
            
            //enviando correo si tiene email
            $r=Mail::send('email.carnet_qr',
            ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$rut,$url_img,$asunto,$destinatario,$mensaje) {
                $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
                $m->from('a.leon@eiche.cl', 'Naturandes!');
                $m->to($destinatario)->subject($asunto);
                $m->attachData($pdf->output(), "carnet_qr.pdf");
            });
            toastr()->success('Éxito!!', ' QR enviado al email satisfactoriamente');
            return redirect()->back();
        } else if (\Auth::User()->tipo_usuario=="Cliente") {
            $user = Clientes::where('id',$id)->first();
            $email= $user->usuario->email;
            if ($email=="") {
                toastr()->error('Error!!', 'No posee email registrado en el sistema');
                return redirect()->back();
            } else {
                $nombres= $user->nombres.' '.$user->apellidos;
                $email= $user->usuario->email;
                $rut = $user->rut;
                $url_img = $user->qr->codigo;
                $asunto="Naturandes! | Bienvenido";
                $destinatario=$user->usuario->email;
                $mensaje="Bienvenido a Naturandes";
                
                //enviando correo si tiene email
                $r=Mail::send('email.carnet_qr',
                ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$rut,$url_img,$asunto,$destinatario,$mensaje) {
                    $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
                    $m->from('a.leon@eiche.cl', 'Naturandes!');
                    $m->to($destinatario)->subject($asunto);
                    $m->attachData($pdf->output(), "carnet_qr.pdf");
                });
                toastr()->success('Éxito!!', ' QR enviado al email satisfactoriamente');
                return redirect()->back();
            }
            
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarPreguntas($opcion)
    {
        return $preguntas = \DB::table('preguntas_seguridad')->get();
    }
}
