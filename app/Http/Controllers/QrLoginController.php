<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class QrLoginController extends Controller
{
    
	public function checkUser(Request $request) {
		 $result =0;
			if ($request->data) {
				$user = User::where('QRpassword',$request->data)->first();
				if ($user) {
					//Sentinel::authenticate($user);
				    $result =1;
				 }else{
				 	$result =0;
				 }

				
			}
			
			return $result;
	}

	public function QrAutoGenerate(Request $request)
	{	
		$result=0;
		if ($request->action = 'updateqr') {
			//$user = Sentinel::getUser();
			if ($user) {
				$qrLogin=bcrypt($user->personal_number.$user->email.str_random(40));
		        $user->QRpassword= $qrLogin;
		        $user->update();
		        $result=1;
			}
		
		}
		
        return $result;
	}

}