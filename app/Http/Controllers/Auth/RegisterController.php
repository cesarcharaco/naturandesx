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

class RegisterController extends Controller
{
    /*
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
        //dd($request->all());
        $nombre_qr = $request->rut.'-'.$request->verificador;
        $buscar_rut = Clientes::where('rut',$nombre_qr)->get();
        if (count($buscar_rut)>0) {
            toastr()->error('Error!!', ' RUT ya se encuentra registrado');
            return redirect()->to('register');
        } else {
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
            
            $clientes = new Clientes();
            $clientes->id_qr=$qr->id;
            $clientes->id_usuario=$usuario->id;
            $clientes->nombres=$request->nombres;
            $clientes->apellidos=$request->apellidos;
            $clientes->rut = $request->rut.'-'.$request->verificador;
            $clientes->status="Activo";
            $clientes->save();

            if ($request->email!="") {
                //dd('email y pdf');
                $nombres= $request->nombres.' '.$request->apellidos;
                $asunto="Naturandes! | Bienvenido";
                $destinatario=$request->email;
                $mensaje="Bienvenido a Naturandes";
                
                $pdf = PDF::loadView(('pdf/carnet_qr'),array('nombres'=>$nombres,))->save('pdfs/'.$nombre_qr.'.pdf');
                $output = $pdf->output();
                //$pdfPath = $pdf->download(BUDGETS_DIR.'/pdf.pdf');
                //enviando correo si no tiene avisos registrados
                $r=Mail::send('email.carnet_qr',
                    ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje,$output) {
                    $m->from('a.leon@eiche.cl', 'Naturandes!');
                    $m->to($destinatario)->subject($asunto);
                    $m->attach($output);
                });
            }

            toastr()->success('Éxito!!', ' Cliente registrado satisfactoriamente');
            return redirect()->to('register');
        }
    }
}
