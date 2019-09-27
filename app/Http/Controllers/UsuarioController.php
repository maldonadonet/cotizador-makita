<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use DB;
use Illuminate\Support\Facades\Input;



class UsuarioController extends Controller
{
    //Constructor
    public function __construct(){
      $this->middleware('auth');
    }

    //Lista de los usuarios
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('users')
            ->where('name','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate('7');
            return view('usuarios.index',['usuarios'=>$usuarios,'searchText'=>$query]);
        }
    }

    public function create(){
      return view('usuarios.create');
    }

    public function store(Request $request){
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->tipo_usuario = $request->get('tipo_usuario');
        if(Input::hasFile('imagen')){
          $file=Input::file('imagen');
          $file->move(public_path().'/img/user/',$file->getClientOriginalName());
          $usuario->image=$file->getClientOriginalName();
        }
        $usuario->save();
        return Redirect::to('usuarios');
    }

    public function edit($id){
        return view('usuarios.edit',['usuario'=>User::findOrFail($id)]);
    }

    public function update(Request $request,$id){
        $usuario=User::findOrFail($id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->tipo_usuario = $request->get('tipo_usuario');
        if(Input::hasFile('imagen')){
          $file=Input::file('imagen');
          $file->move(public_path().'/img/user/',$file->getClientOriginalName());
          $usuario->image=$file->getClientOriginalName();
        }
        $usuario->update();
        return Redirect::to('usuarios');
    }

    public function destroy($id){
        $usuario = DB::table('users')->where('id','=',$id)
        ->delete();
        return Redirect::to('usuarios');
    }

    public function getUser(){
      return $request->user();
    }

}
