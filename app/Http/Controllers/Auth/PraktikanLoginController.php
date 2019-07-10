<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use App\Praktikan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PraktikanLoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest:praktikan', ['except' => ['logout']]);
    }

    public function login(Request $request){

        // Validate the form data
        $this->validate($request, [
            'nim'      => 'required|size:10|string',
            'password'  => 'required|min:6|string',
        ]);
        
        // Attempt to log the user in
        if (Auth::guard('praktikan')->attempt(
            ['nim' => $request->nim, 'password' => $request->password], false)) {

            $praktikan = Praktikan::where('nim', $request->nim)->first();
            $praktikan->api_token = hash('sha256', Str::random(60));
            $praktikan->save();
			
            return '{"message": "success"}';
		} 

        return '{"message": "Login Failed"}';
    }

    public function logout(){

        Auth::guard('praktikan')->logout();
		return redirect('/login?comingFrom=praktikan');
    }
}
