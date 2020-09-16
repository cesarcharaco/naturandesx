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
use Mail;
use PDF;

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
        $preguntas =  \DB::table('preguntas_seguridad')->get();
        return view('clientes.index', compact('clientes','num','preguntas'));
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
        if(\Auth::user()->tipo_usuario == 'Admin'){
            $nombre_qr = $request->rut.'-'.$request->verificador;
            $clave = $request->rut.''.$request->verificador;
            //dd($clave);

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
            $usuario->tipo_usuario="Cliente";
            $usuario->save();
            
            $clientes = new Clientes();
            $clientes->id_qr=$qr->id;
            $clientes->id_usuario=$usuario->id;
            $clientes->nombres=$request->nombres;
            $clientes->apellidos=$request->apellidos;
            $clientes->rut = $request->rut.'-'.$request->verificador;
            $clientes->status=$request->status;
            $clientes->save();

            \DB::table('usuarios_has_preguntas')->insert([
                'id_usuario' => $usuario->id,
                'id_pregunta' => $request->pregunta,
                'respuesta' => $request->respuesta
            ]);

            if ($request->email!="") {
                //dd('email y pdf');
                $nombres= $request->nombres.' '.$request->apellidos;
                $email= $request->email;
                $rut = $request->rut.'-'.$request->verificador;
                $asunto="Naturandes! | Bienvenido";
                $destinatario=$request->email;
                $mensaje="Bienvenido a Naturandes";
                
                //enviando correo si tiene email
                $r=Mail::send('email.carnet_qr',
                    ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$rut,$url_img,$asunto,$destinatario,$mensaje) {

                    $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
                    $m->from('a.leon@eiche.cl', 'Naturandes!');
                    $m->to($destinatario)->subject($asunto);
                    $m->attachData($pdf->output(), "carnet_qr.pdf");
                });
            }

            toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
            return redirect()->to('clientes');
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
    }

    public function carnet_qr(){
        $pdf = \PDF::loadView('pdf/carnet_qr');
        return $pdf->stream('carnet_qr.pdf');
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

            $clientes = Clientes::find($request->id);
            $clientes->nombres=$request->nombres;
            $clientes->apellidos=$request->apellidos;
            $clientes->rut = $request->rut.'-'.$request->verificador;
            $clientes->status=$request->status;
            $clientes->save();

            $usuario = User::find($request->id_usuario);
            $usuario->usuario=$request->usuario;
            if ($request->email=="") {
                $usuario->email=NULL;
            } else {
                $usuario->email=$request->email;
            }
            $usuario->save();

            toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
            return redirect()->to('clientes');
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
        }else{
            toastr()->warning('no puede acceder!!', 'ACCESO DENEGADO');
            return redirect()->back();
        }
    }

    public function buscarQR($QR)
    {
        return \DB::table('users')
        ->join('clientes','clientes.id_usuario','=','users.id')
        ->where('clientes.rut',$QR)
        ->select('clientes.*','users.email')
        ->get();
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
