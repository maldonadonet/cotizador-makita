<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Cliente;
use App\Papeletas;
use Hash;

class PapeletasController extends Controller
{
    //Lista de los usuarios
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $papeletas = DB::table('papeletas')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('empresa','LIKE','%'.$query.'%')
            ->orderBy('id','asc')
            ->paginate('20');
            return view('papeletas.index',['papeletas'=>$papeletas,'searchText'=>$query]);
        }
    }

    public function create(){
      return view('papeletas.create');
    }

    public function store(Request $request){
    	//dd($request);
        $user = Auth::user();

        $papeleta = new Papeletas;
        $papeleta->empresa = $request->get('empresa');
        $papeleta->nombre = $request->get('nombre');
        $papeleta->email = $request->get('email');
        $papeleta->telefono = $request->get('telefono');
        $papeleta->producto = $request->get('producto');
        $papeleta->marca = $request->get('marca'); 
        $papeleta->cliente_nuevo = $request->get('cliente_nuevo'); 
        $papeleta->contacto = $request->get('contacto'); 
        $papeleta->save();

        return Redirect::to('papeletas');
    }

    public function edit($id){
        
    }

    public function update(Request $request,$id){
       
    }

    public function destroy($id){
        
    }
}
