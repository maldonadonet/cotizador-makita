<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\UsuarioFormRequest;
use Illuminate\Support\Facades\Input;
use DB;
use App\Vendedor;
use App\User;
use Hash;

class VendedoresController extends Controller
{
    //Constructor
    public function __construct(){
      $this->middleware('auth');
    }

    //Lista de los usuarios
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $vendedores = DB::table('vendedores')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('area','LIKE','%'.$query.'%')
            ->orwhere('email','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate('10');
            return view('vendedores.index',['vendedores'=>$vendedores,'searchText'=>$query]);
        }
    }

    public function create(){
      return view('vendedores.create');
    }

    public function store(Request $request){
        $vendedor = new Vendedor;
        $vendedor->nombre = $request->get('nombre');
        $vendedor->direccion = $request->get('direccion');
        $vendedor->tel = $request->get('telefono');
        $vendedor->email = $request->get('email');
        $vendedor->password = $request->get('password');
        $vendedor->area = $request->get('area'); 
        $vendedor->save();

        $user = new User;
        $user->name = $vendedor->nombre;
        $user->email = $vendedor->email;
        $user->password = Hash::make($vendedor->password);
        $user->tipo_usuario = 'vendedor';
        $user->id_vendedor = $vendedor->id;
        $user->remember_token = str_random(60);
        $user->save();

        return Redirect::to('vendedores');
    }

    public function edit($id){
        return view('vendedores.edit',['vendedor'=>Vendedor::findOrFail($id)]);
    }

    public function update(Request $request,$id){
        $vendedor=Vendedor::findOrFail($id);
        $vendedor->nombre = $request->get('nombre');
        $vendedor->direccion = $request->get('direccion');
        $vendedor->tel = $request->get('telefono');
        $vendedor->email = $request->get('email');
        $vendedor->password = $request->get('password');
        $vendedor->area = $request->get('area'); 
        $vendedor->update();

        $user = User::findOrFail($id);
        $user->name = $vendedor->nombre;
        $user->email = $vendedor->email;
        $user->password = Hash::make($vendedor->password);
        $user->update();

        return Redirect::to('vendedores');
    }

    public function destroy($id){
        $vendedor=Vendedor::findOrFail($id);
        $vendedor->delete();
        return Redirect::to('vendedores');
    }

}
