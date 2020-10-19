<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Clientes;
use App\CodigoQr;
use QR_Code\Types\QR_Url;
use QRCode;
use App\Http\Requests\ClienteRegisterRequest;
use DB;
use Mail;
use PDF;
use App\Preguntas;
class RegisterController extends Controller
{    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombres' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:15', 'unique:users'],
            'email' => ['max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //
    }

    public function store(ClienteRegisterRequest $request)
    {
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        //return $randomString;

        //dd($request->all());
        if($request->pregunta1==0 || $request->respuesta1=="" || $request->pregunta2==0 || $request->respuesta2==""){
            toastr()->error('Error!!', 'Debe Seleccionar las preguntas y colocar sus respectivas respuestas');
            return redirect()->to('registerClienteExterno');
        }else{
            $nombre_qr = $request->rut.'-'.$request->verificador;
            $buscar_rut = Clientes::where('rut',$nombre_qr)->get();
            $buscar_email = User::where('email',$request->email)->get();
            if (count($buscar_rut)>0) {
                toastr()->error('Error!!', ' RUT ya se encuentra registrado');
                return redirect()->to('registerClienteExterno');
            } else if(count($buscar_email)>0) {
                toastr()->error('Error!!', 'Email ya se encuentra registrado');
                return redirect()->to('registerClienteExterno');
            } else {
                $qr_code = QRCode::text($nombre_qr)
                ->setOutfile('./img/qr-code/'.$nombre_qr.'.png')
                ->setSize(8)
                ->setMargin(2)
                ->png();

                $url_img = "img/qr-code/".$nombre_qr.".png";
                $qr = new CodigoQr();
                $qr->codigo=$url_img;
                $qr->codigo_recupera=$randomString;
                $qr->status="Sin Aprobar";
                $qr->save();

                $clave = $request->password;
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
                //registrando preguntas de seguridad
                
                \DB::table('usuarios_has_preguntas')->insert([
                    'id_usuario' => $usuario->id,
                    'id_pregunta' => $request->pregunta1,
                    'respuesta' => $request->respuesta1
                ]);
                \DB::table('usuarios_has_preguntas')->insert([
                    'id_usuario' => $usuario->id,
                    'id_pregunta' => $request->pregunta2,
                    'respuesta' => $request->respuesta2
                ]);
                //------------------------------
                $clientes = new Clientes();
                $clientes->id_qr=$qr->id;
                $clientes->id_usuario=$usuario->id;
                $clientes->nombres=$request->nombres;
                $clientes->apellidos=$request->apellidos;
                $clientes->rut = $request->rut.'-'.$request->verificador;
                $clientes->status="Sin Aprobar";
                $clientes->save();
                //--- clientes externos---

                if ($request->email!="") {
                    //dd('email y pdf');
                    $nombres= $request->nombres.' '.$request->apellidos;
                    $email= $request->email;
                    $rut = $request->rut.'-'.$request->verificador;
                    $asunto="Naturandes! | Bienvenido";
                    $destinatario=$request->email;
                    $mensaje="Bienvenido a Naturandes";
                    $mensaje1="Cliente registrado";
                    
                    //enviando correo si tiene email
                    $r=Mail::send('email.carnet_qr',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$email,$rut,$url_img,$asunto,$destinatario,$mensaje) {

                        $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
                        $m->from('promociones@naturandeschile.com', 'Naturandes!');
                        $m->to($destinatario)->subject($asunto);
                        $m->attachData($pdf->output(), "carnet_qr.pdf");
                    });

                    $send_admin=Mail::send('email.nuevo_cliente',
                        ['nombres'=>$nombres, 'mensaje1' => $mensaje1], function ($m) use ($nombres,$email,$rut,$url_img,$mensaje1) {

                        $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,'email'=>$email,'rut'=>$rut,'url_img'=>$url_img));
                        $m->from('promociones@naturandeschile.com', 'Naturandes!');
                        $m->to('promociones@naturandeschile.com')->subject('Nuevo cliente registrado');
                        $m->attachData($pdf->output(), "carnet_qr.pdf");
                    });
                }

                toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
                return redirect()->to('RegisterClienteExitoso');
            }
        }
    }
}
