<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CodigoQr;
use QR_Code\Types\QR_Url;
use QRCode;
use App\Empleados;
use App\Http\Requests\EmpleadosRequest;
use App\User;
use DB;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::user()->tipo_usuario == 'Admin'){
            // $empleados = Empleados::join('users', 'users.id', '=', 'empleados.id_usuario')
            // ->where('users.tipo_usuario','Cliente')->get();
            $empleados=Empleados::all();
            return view('empleados.index', compact('empleados'));
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
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
    public function store(EmpleadosRequest $request)
    {
        if(\Auth::user()->tipo_usuario == 'Admin'){
            $nombre_qr = $request->rut.'-'.$request->verificador;
            $clave = $request->rut.''.$request->verificador;
            $buscar_rut = Empleados::where('rut',$nombre_qr)->get();
            //dd($buscar_rut);
            if (count($buscar_rut)>0) {
                toastr()->error('Error!!', ' RUT ya se encuentra registrado');
                return redirect()->to('empleados');
            } else {
                //dd($request->all());

                $qr_code = QRCode::text($nombre_qr)
                ->setOutfile('./img/qr-code/'.$nombre_qr.'.png')
                ->setSize(8)
                ->setMargin(2)
                ->png();

                $url_img = "img/qr-code/".$nombre_qr.".png";
                $qr = new CodigoQr();
                $qr->codigo=$url_img;
                $qr->codigo_recupera=1234;
                $qr->status="Activo";
                $qr->save();

                $usuario = new User();
                $usuario->usuario=$request->usuario;
                if ($request->email=="") {
                    $usuario->email=NULL;
                } else {
                    $usuario->email=$request->email;
                }
                $nueva_clave=\Hash::make($clave);
                $usuario->password=$nueva_clave;
                $usuario->tipo_usuario="Empleado";
                $usuario->save();

                $empleados = new Empleados();
                $empleados->id_usuario=$usuario->id;
                $empleados->id_qr=$qr->id;
                $empleados->nombres=$request->nombres;
                $empleados->apellidos=$request->apellidos;
                $empleados->rut = $request->rut.'-'.$request->verificador;
                $empleados->telefono=$request->telefono;
                $empleados->direccion=$request->direccion;
                $empleados->status="Activo";
                $empleados->save();

                toastr()->success('Éxito!!', ' Empleado registrado satisfactoriamente');
                return redirect()->to('empleados');
            }
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function editar(Request $request)
    {
        if(\Auth::user()->tipo_usuario == 'Admin'){
            //dd($request->all());
            $usuario = User::find($request->id_usuario);
            $usuario->usuario=$request->usuario;
            if ($request->email=="") {
                $usuario->email=NULL;
            } else {
                $usuario->email=$request->email;
            }
            $usuario->save();

            $empleados =Empleados::find($request->id);
            $empleados->nombres=$request->nombres;
            $empleados->apellidos=$request->apellidos;
            $empleados->rut = $request->rut.'-'.$request->verificador;
            $empleados->telefono=$request->telefono;
            $empleados->status=$request->status;
            $empleados->direccion=$request->direccion;
            $empleados->save();

            toastr()->success('Éxito!!', ' Datos de empleado actualizado satisfactoriamente');
            return redirect()->to('empleados');
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
    }

    public function eliminar(Request $request)
    {
        if(\Auth::user()->tipo_usuario == 'Admin'){
            //dd($request->all());
            $password = $request['password'];
            $consulta = User::where('id',\Auth::User()->id)->first();
            $hashedPassword = $consulta->password;

            if (\Hash::check($password, $hashedPassword)) {
                DB::table('users')->delete($request->id_usuario);
                DB::table('empleados')->delete($request->id);
                $data=CodigoQr::where('id',$request->id_qr)->first();
                $image_path = $data->codigo;  // the value is : localhost/project/image/filename.format

                if(file_exists($image_path)) {
                    unlink($image_path);
                }
                DB::table('codigo_qr')->delete($request->id_qr);
                toastr()->success('Éxito!!', ' Empleado eliminado satisfactoriamente');
                return redirect()->to('empleados');
            }else{
                toastr()->error('Error!!', ' Contraseña incorrecta');
                return redirect()->to('empleados');
            }
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
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
}
