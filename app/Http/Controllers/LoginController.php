<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;


class LoginController extends Controller
{
	public function index(){
		if(Auth::check()) {
			return redirect()->route('index_page');
		}
		return view('login');
	}

	public function logout () {
		Auth::logout();
		return redirect()->route('login');
	}

	public function registerPage()
	{
		if(Auth::check())
			return redirect()->route('index_page');
		
		return view('register');
	}

	public function register(Request $request)
	{
		$user = new User;
		$user->fill($request->all());
		$user->password = bcrypt($request->password);
		if ($request->role == 'dosen')
			$user->photo = 'profile2.png';
		else
			$user->photo = 'profile1.png';
		$user->save();

		return redirect()->route('login')->with('success', 'Register success');

	}

	public function cekLogin(Request $request) 
	{
		$data = [
			'email' => $request->email, 
			'password' => $request->password,
		];

        //Cek apakah data dari form sesuai dengan di DB
		if (Auth::attempt($data))
			return redirect()->route('index_page');

		return redirect()->back();
	}


}
