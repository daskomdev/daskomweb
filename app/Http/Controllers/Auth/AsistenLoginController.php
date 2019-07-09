<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;
use App\Asisten;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AsistenLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:asisten', ['except' => ['logout']]);
	}
	
	public function login(Request $request){

		// Validate the form data
		$this->validate($request, [
			'kode'      => 'required|size:3|string',
			'password'  => 'required|min:6|string',
		]);
		
		// Attempt to log the user in
		if (Auth::guard('asisten')->attempt(
			['kode' => $request->kode, 'password' => $request->password], false)) {

			$asisten = Asisten::where('kode', $request->kode)->first();
			$asisten->api_token = hash('sha256', Str::random(60));
			$asisten->save();
			
			return '{"message": "success"}';
		} 

        return '{"message": "Login Failed"}';
	}
	
	public function logout(){

		Auth::guard('asisten')->logout();
		return redirect('/login?comingFrom=asisten');
	}
}
