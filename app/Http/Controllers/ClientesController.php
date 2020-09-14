<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use App\CodigoQr;
use QR_Code\Types\QR_Url;
use QRCode;
use App\Http\Requests\ClientesRequest;
use App\User;
use DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $num = 1;
        $clientes = Clientes::all();
        return view('clientes.index', compact('clientes','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientesRequest $request)
    {
        $nombre_qr = $request->rut.'-'.$request->verificador;
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
        
        $clientes = new Clientes();
        $clientes->id_qr=$qr->id;
        $clientes->nombres=$request->nombres;
        $clientes->apellidos=$request->apellidos;
        $clientes->rut = $request->rut.'-'.$request->verificador;
        $clientes->email=$request->email;
        $clientes->status=$request->status;
        $clientes->save();

        toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
        return redirect()->to('clientes');
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
        $clientes = Clientes::find($id);
        $clientes->nombres=$request->nombres;
        $clientes->apellidos=$request->apellidos;
        $clientes->rut = $request->rut.'-'.$request->verificador;
        $clientes->email=$request->email;
        $clientes->status=$request->status;
        $clientes->save();

        toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
        return redirect()->to('clientes');
    }

    public function eliminar(Request $request)
    {
        //dd($request->all());
        $password = $request['password'];
        $consulta = User::where('id',\Auth::User()->id)->first();
        $hashedPassword = $consulta->password;

        if (\Hash::check($password, $hashedPassword)) {
            DB::table('clientes')->delete($request->id);
            $data=CodigoQr::where('id',$request->id_qr)->first();
            $image_path = $data->codigo;  // the value is : localhost/project/image/filename.format

            if(file_exists($image_path)) {
                unlink($image_path);
            }
            DB::table('codigo_qr')->delete($request->id_qr);
            toastr()->success('Éxito!!', ' Cliente eliminado satisfactoriamente');
            return redirect()->to('clientes');
        }else{
            toastr()->error('Error!!', ' Contraseña incorrecta');
            return redirect()->to('clientes');
        }
    }

    public function buscarQR($QR)
    {
        return \DB::table('clientes')->where('rut',$QR)->get();
        // return 1;
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
