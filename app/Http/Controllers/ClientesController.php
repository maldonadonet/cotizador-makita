<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Cliente;
use App\Vendedor;
use DB;
use App\Cotizacion;

class ClientesController extends Controller
{
  //Constructor
  public function __construct(){
    $this->middleware('auth');
  }

  //Metodo Index
  public function index(Request $request ){
    $user = Auth::user();
    if($user->tipo_usuario == 'admin'){
      if($request){
        $query=trim($request->get('searchText'));
        $clientes=DB::table('clientes as c')
        ->join('vendedores as v','c.id_vendedor','=','v.id')
        ->select('c.id','c.nombre','c.direccion','c.telefono','c.email','c.atencion','c.rfc','c.razon_social','v.nombre as vendedor')
        ->where('c.nombre','LIKE','%'.$query.'%')
        ->orderBy('id','desc')
        ->paginate(7);
        return view('clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
      }
    }else{
      if($request){
        $query=trim($request->get('searchText'));
        $clientes=DB::table('clientes as c')
        ->join('vendedores as v','c.id_vendedor','=','v.id')
        ->select('c.id','c.id_vendedor','c.nombre','c.direccion','c.telefono','c.email','c.atencion','c.rfc','c.razon_social','v.nombre as vendedor')
        ->where('c.id_vendedor','=',$user->id_vendedor)
        ->where('c.nombre','LIKE','%'.$query.'%')
        ->orderBy('id','desc')
        ->paginate(7);
        return view('clientes.index',["clientes"=>$clientes,"searchText"=>$query]);
      }
    }
  }

  //Metodo Create
  public function create(){
    $vendedores = DB::table('vendedores')->get();
    return view('clientes.create',['vendedores'=>$vendedores]);
  }

  //Metodo storer para almacenar
  public function store(Request $request){
    $user = Auth::user();
    if($user->tipo_usuario == 'admin'){
        $cliente=new Cliente;
        $cliente->nombre = $request->get('nombre');
        $cliente->direccion =$request->get('direccion');
        $cliente->telefono =$request->get('telefono');
        $cliente->email =$request->get('email');
        $cliente->atencion = $request->get('atencion');
        $cliente->rfc =$request->get('rfc');
        $cliente->razon_social =$request->get('razon_social');
        $cliente->id_vendedor =$request->get('vendedor');
        $cliente->save();
        return Redirect::to('clientes');
    }else{
        $cliente=new Cliente;
        $cliente->nombre = $request->get('nombre');
        $cliente->direccion =$request->get('direccion');
        $cliente->telefono =$request->get('telefono');
        $cliente->email =$request->get('email');
        $cliente->atencion = $request->get('atencion');
        $cliente->rfc =$request->get('rfc');
        $cliente->razon_social =$request->get('razon_social');
        $cliente->id_vendedor = $user->id_vendedor;
        $cliente->save();
        return Redirect::to('clientes');
    }
  }

  //Metodo show para mostrar
  public function show(Request $request, $id){
    
    $cliente = Cliente::where('id',$id)->first();
    $vendedor = Vendedor::where('id',$cliente->id_vendedor)->first();
    $cotizaciones = Cotizacion::where('id_cliente',$cliente->id)->get();

    //dd();

    return view('clientes.show',['cliente'=>$cliente,'vendedor'=>$vendedor,'cotizaciones'=>$cotizaciones]);

  }

  //Metodo edit para modificar
  public function edit($id){
    $vendedor = DB::table('clientes as c')
    ->join('vendedores as v','c.id_vendedor','=','v.id')
    ->select('v.id','v.nombre')
    ->where('c.id',$id)
    ->first();

    $cliente=Cliente::findOrFail($id);
    $vendedores = Vendedor::all();

    return view('clientes.edit',['cliente'=>$cliente,'vendedores'=>$vendedores,'vendedor'=>$vendedor]);
  }

  //Metodo update para actualizar
  public function update(Request $request,$id){
    $user = Auth::user();
    if($user->tipo_usuario == 'admin'){
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->direccion =$request->get('direccion');
        $cliente->telefono =$request->get('telefono');
        $cliente->email =$request->get('email');
        $cliente->atencion =$request->get('atencion');
        $cliente->rfc =$request->get('rfc');
        $cliente->razon_social =$request->get('razon_social');
        $cliente->id_vendedor =$request->get('vendedor');
        $cliente->update();
        return Redirect::to('clientes');
    }else{
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->direccion =$request->get('direccion');
        $cliente->telefono =$request->get('telefono');
        $cliente->email =$request->get('email');
        $cliente->atencion =$request->get('atencion');
        $cliente->rfc =$request->get('rfc');
        $cliente->razon_social =$request->get('razon_social');
        $cliente->id_vendedor = $user->id_vendedor;
        $cliente->update();
        return Redirect::to('clientes');
    }
  }

  //Metodo destroy para eliminar un objeto y destruirlo de la tabla y la db
  public function destroy($id){
    $cliente=Cliente::findOrFail($id);
    $cliente->delete();
    return Redirect::to('clientes');
  }
}
