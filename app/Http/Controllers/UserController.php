<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Preguntas;
use App\Clientes;
use App\Empleados;

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
                    //Editar preguntas
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
                    //Editar preguntas
                }
                
            }
        } else if (\Auth::User()->tipo_usuario=="Admin") {
            $usuario = User::find($id);
            $usuario->usuario=$request->usuario;
            $usuario->email=$request->email;
            $usuario->save();
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
