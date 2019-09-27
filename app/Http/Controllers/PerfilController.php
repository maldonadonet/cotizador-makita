<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\User;
use Crypt;
use DB;

class PerfilController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$usuario = Auth::user();
		$query = DB::table('users')->where('id','=',$usuario->id)->first();

		return view('perfil.index',['usuario' => $query]);
	}

	public function edit($id){
		$user = DB::table('users')->where('id','=',$id)->first();
		
		return view('perfil.edit',['user'=>$user]);
	}

	public function update(Request $request,$id){
		//dd($request);
		$user = User::findOrFail($id);
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = bcrypt($request->get('password'));

		if(Input::hasFile('image')){
          $file=Input::file('image');
          $file->move(public_path().'/img/users/',$file->getClientOriginalName());
          $user->image=$file->getClientOriginalName();
        }
        $user->update();
        return Redirect::to('perfil');
	}
}
