<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        $users=User::find($id);
        
        return view('user.show', compact('users'));
    }

    public function editar_perfil(Request $request)
    {
        dd($request->all());
        if (\Auth::User()->tipo_usuario=="Empleado") {
            $usuario = User::find($id);
            $usuario->usuario=$request->usuario;
            $usuario->email=$request->email;
            $usuario->password=$request->password;
            $usuario->save();

            $empleados =Empleados::find($request->id);
            $empleados->nombres=$request->nombres;
            $empleados->apellidos=$request->apellidos;
            $empleados->rut = $request->rut.'-'.$request->verificador;
            $empleados->telefono=$request->telefono;
            $empleados->status=$request->status;
            $empleados->direccion=$request->direccion;
            $empleados->save();
        } else if (\Auth::User()->tipo_usuario=="Cliente") {
            $clientes = Clientes::find($request->id);
            $clientes->nombres=$request->nombres;
            $clientes->apellidos=$request->apellidos;
            $clientes->rut = $request->rut.'-'.$request->verificador;
            $clientes->status=$request->status;
            $clientes->save();

            $usuario = User::find($id);
            $usuario->usuario=$request->usuario;
            if ($request->email=="") {
                $usuario->email=NULL;
            } else {
                $usuario->email=$request->email;
            }
            $usuario->save();
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
