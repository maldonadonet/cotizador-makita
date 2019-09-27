<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Producto;
use App\Cotizacion;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use App\DetalleCotizacion;
use Barryvdh\DomPDF\Facade as PDF;

class ProductosController extends Controller{

    public function __construct(){
        $this->middleware('auth');

    }

    public function index(Request $request ){
        $categoria = $request->input('categoria');
        //dd($categoria);

        if($request->input('categoria')){
            $query=trim($request->get('searchText'));
            $productos=DB::table('productos')
            ->where('modelo','LIKE','%'.$query.'%')
            ->where('tipo',$categoria)
            //->orwhere('descripcion','LIKE','%'.$query.'%')
            ->orderBy('precio_venta','asc')
            ->paginate(30);

            //dd($productos);
            return view('productos.index',["productos"=>$productos,"searchText"=>$query]);
        }else{
            $query=trim($request->get('searchText'));
            $productos=DB::table('productos')
            ->where('modelo','LIKE','%'.$query.'%')
            ->orwhere('descripcion','LIKE','%'.$query.'%')
            ->orderBy('precio_venta','asc')
            ->paginate(30);

            return view('productos.index',["productos"=>$productos,"searchText"=>$query]);
        }

    }

    public function create(){
        return view('productos.create');
    }

    public function store(Request $request){
        $producto=new Producto;
        $producto->modelo = $request->get('modelo');
        $producto->tipo=$request->get('tipo');
        $producto->isbn=$request->get('isbn');
        $producto->caja_master=$request->get('caja_master');
        $producto->descripcion=$request->get('descripcion');
        $producto->unidad=$request->get('unidad');
        $producto->moneda=$request->get('moneda');
        $producto->estatus=$request->get('estatus');
        $producto->precio_compra=$request->get('precio_compra');
        $producto->precio_unitario=$request->get('precio_unitario');
        $producto->cod_ant=$request->get('cod_ant');
        $producto->alterno=$request->get('alterno');
        $producto->cod_sat=$request->get('cod_sat');
        $producto->utilidad=$producto->precio_venta - $producto->precio_compra;
        $producto->precio_venta=$request->get('precio_venta');
        $producto->puntos=$request->get('puntos');
        $producto->save();
        return Redirect::to('productos');
    }

    // Metodo que manda los productos de la sesion, lst-vendedores, lst-clientes
    public function show(){
            if( \Session::get('item')){
                $producto = \Session::get('item');
            }else{
                $producto = array();
            }

            $clientes = DB::table('clientes')->get();
            $vendedores = DB::table('vendedores')->get();
            return view('productos.show',['producto'=>$producto,'clientes'=>$clientes,'vendedores'=>$vendedores]);
    }

    public function edit($id){
        return view('productos.edit',['producto'=>Producto::findOrFail($id)]);
    }

    public function update(Request $request,$id){
        $producto=Producto::findOrFail($id);
        $producto->modelo = $request->get('modelo');
        $producto->tipo=$request->get('tipo');
        $producto->isbn=$request->get('isbn');
        $producto->caja_master=$request->get('caja_master');
        $producto->descripcion=$request->get('descripcion');
        $producto->unidad=$request->get('unidad');
        $producto->moneda=$request->get('moneda');
        $producto->estatus=$request->get('estatus');
        $producto->precio_compra=$request->get('precio_compra');
        $producto->precio_unitario=$request->get('precio_unitario');
        $producto->cod_ant=$request->get('cod_ant');
        $producto->alterno=$request->get('alterno');
        $producto->cod_sat=$request->get('cod_sat');
        $producto->utilidad=$producto->precio_venta - $producto->precio_compra;
        $producto->precio_venta=$request->get('precio_venta');
        $producto->puntos=$request->get('puntos');
        $producto->update();
        return Redirect::to('productos');
    }

    public function destroy($id){
        $producto = Producto::findOrFail($id);
        //$producto->estatus = 'Inactivo';
        $producto->delete();
        return Redirect::to('productos');
    }

    public function agregar(Request $request){
        $id = $request->id;
        $cantidad = $request->cantidad;
        $product = Producto::findOrFail($id);
        
        if($cantidad ==""){
          return redirect('productos')->with('message','Falta indicar la cantidad de productos a cotizar');
        }

        if( \Session::get('id_element')){
            $mi_dato = \Session::get('id_element.0');
            $dato_final = $mi_dato + 1;
            //dd($dato_final);
        }else{
            \Session::push('id_element',0);
            $mi_dato = \Session::get('id_element.0');
            $dato_final = $mi_dato;
        }
        

        $item = (object) array(
            'id' => $id,
            'cantidad' => $cantidad,
            'modelo' => $product->modelo,
            'descripcion' => $product->descripcion,
            'unidad' => $product->unidad,
            'moneda' => $product->moneda,
            'precio_unitario' => $product->precio_unitario,
            'precio_venta' => $product->precio_venta,
            'id_elemento' => $dato_final
        );

        \Session::push('item',$item);
        
        session()->put('id_element.0', $dato_final);

        alert()->success('You have been logged out.', 'Good bye!');
        
        //return redirect('productos');
        return back();
    }

    public function vercotizacion(){
       $user = Auth::user();
           if($user->tipo_usuario == 'admin' || $user->tipo_usuario == 'admin1'){
               $total = 0;
                if( \Session::get('item')){
                    $producto = \Session::get('item');
                    foreach($producto as $pro_session){
                        $subtotal = $pro_session->precio_unitario * $pro_session->cantidad;
                        $total = $total + $subtotal;

                    }
                }else{
                    $producto = array();
                }

                $clientes = DB::table('clientes')->get();
                $vendedores = DB::table('vendedores')->get();
                return view('productos.show',['producto'=>$producto,'clientes'=>$clientes,'vendedores'=>$vendedores,'total'=>$total]);
            }else{
                $total = 0;
                    if( \Session::get('item')){
                        $producto = \Session::get('item');
                        foreach($producto as $pro_session){
                            $subtotal = $pro_session->precio_venta * $pro_session->cantidad;
                            $total = $total + $subtotal;

                        }
                    }else{
                        $producto = array();
                    }

                    $clientes = DB::table('clientes')->where('id_vendedor','=',$user->id)->get();
                    $vendedores = DB::table('vendedores')->get();
                    return view('productos.show',['producto'=>$producto,'clientes'=>$clientes,'vendedores'=>$vendedores,'total'=>$total]);
            }
    }

    public function borrarcotizacion(){
        \Session::forget('item');
        \Session::forget('id_element');
        return redirect('productos');
    }

    public function modificarcant(Request $request){
        $item = session()->get('item');
        $cont =0;
        $total = count($item);
        $eliminar = "item";
        $eliminar_full = $eliminar.$cont;
        $user = Auth::user();

        foreach ($item as $value) {
            if($value->id == $request->id_prod){
                $value->cantidad = $request->cantidad;
                return redirect('vercotizacion');
            }else{
        
            }
            $cont++;
        }

        

    }

    // Peticición ajax para obtener la data del cliente seleccionado
    public function validar(Request $request){
        $id_cliente = $request->get('id_cliente');
        $respuesta = DB::table('clientes')->where('id','=',$id_cliente)->first();
        return response()->json($respuesta);
    }

    // Petición Ajax para obtener la data del vendedor seleccionado
    public function validar_vendedor(Request $request){
        $id_vendedor = $request->get('id_vendedor');
        $respuesta = DB::table('vendedores')->where('id','=',$id_vendedor)->first();
        return response()->json($respuesta);
    }

    public function eliminaritem(Request $request){
        $item = session()->get('item');        

        foreach ($item as $value) {
            if($value->id_elemento == $request->id_elemento){
                session()->pull("item.".$request->id_elemento);
                return redirect('vercotizacion');
            }else{
               
            }
        }
    }

    public function enviar_cotizacion(Request $request){
        
        $user = Auth::user();
        $total = 0;
        if( \Session::get('item') ){
            $producto = \Session::get('item');
            foreach($producto as $pro_session){
                $subtotal = $pro_session->precio_unitario * $pro_session->cantidad;
                $total = $total + $subtotal;
            }
        }else{
            $producto = array();
        }

        $cliente = DB::table('clientes')->where('id','=',$request->cliente)->first();
        $vendedor = DB::table('vendedores')->where('id','=',$request->vendedor)->first();        
        $query = DB::table('cotizaciones')->where('id_vendedor',$vendedor->id)->orderBy('id','des')->first();
        
        Mail::send('cotizacion',['data'=>$request,'producto'=>$producto,'cliente'=>$cliente,'vendedor'=>$vendedor,'total'=>$total,'folio'=>$query] , function($msj) use($cliente) {
            
            $msj->subject('Cotización Makita | Artículos Innovadores Leo');
            $msj->to($cliente->email);
        });

        $folio_db = DB::table('cotizaciones')->count();
        
        if($folio_db > 0){
            $cotizacion = new Cotizacion;
            $cotizacion-> id_vendedor = $vendedor->id;
            $cotizacion->id_cliente = $cliente->id;
            $cotizacion->nombre_cliente = $cliente->nombre;
            $cotizacion->email_cliente = $cliente->email;
            $cotizacion->fecha = $request->fecha;
            $cotizacion->total = $total;
            if($query){
                $cotizacion->folio = $query->folio + 1;
            }else{
                $cotizacion->folio =  1;
            }
            $cotizacion->save();
        }else{
            $cotizacion = new Cotizacion;
            $cotizacion-> id_vendedor = $vendedor->id;
            $cotizacion->id_cliente = $cliente->id;
            $cotizacion->nombre_cliente = $cliente->nombre;
            $cotizacion->email_cliente = $cliente->email;
            $cotizacion->fecha = $request->fecha;
            $cotizacion->total = $total;
            $cotizacion->folio = 1;
            $cotizacion->save();
        }
        

        foreach($producto as $pro){
            $detalle_cotizacion = new DetalleCotizacion;
            $detalle_cotizacion->id_cotizacion = $cotizacion->id;
            $detalle_cotizacion->id_producto = $pro->id;
            $detalle_cotizacion->cantidad =  $pro->cantidad;
            $detalle_cotizacion->modelo = $pro->modelo;
            $detalle_cotizacion->descripcion = $pro->descripcion;
            $detalle_cotizacion->unidad = $pro->unidad;
            $detalle_cotizacion->moneda = $pro->moneda;
            $detalle_cotizacion->precio_unitario = $pro->precio_unitario;
            $detalle_cotizacion->precio_venta = $pro->precio_venta;
            $detalle_cotizacion->total = $pro->precio_unitario * $pro->cantidad;
            $detalle_cotizacion->save();
        }

        Session::flash('message','Mensaje enviado correctamente');

        \Session::forget('item');
        \Session::forget('id_element');

        return redirect('productos')->with('message','Cotización enviada correctamente');
    }

    public function guardar_cotizacion(Request $request){
        //dd( $request );      
        $total=0;
        if( \Session::get('item') ){
            $producto = \Session::get('item');
            foreach($producto as $pro_session){
                $subtotal = $pro_session->precio_unitario * $pro_session->cantidad;
                $total = $total + $subtotal;
            }
        }else{
            $producto = array();
        }
        
        $cliente = DB::table('clientes')->where('id','=',$request->cliente)->first();
        $vendedor = DB::table('vendedores')->where('id','=',$request->vendedor)->first();        
        $query = DB::table('cotizaciones')->where('id_vendedor',$vendedor->id)->orderBy('id','des')->first();
        
        $folio_db = DB::table('cotizaciones')->count();
        
        if($folio_db > 0){
            $cotizacion = new Cotizacion;
            $cotizacion->id_vendedor = $vendedor->id;
            $cotizacion->id_cliente = $cliente->id;
            $cotizacion->nombre_cliente = $cliente->nombre;
            $cotizacion->email_cliente = $cliente->email;
            $cotizacion->fecha = $request->fecha;
            $cotizacion->total = $total;
            if($query){
                $cotizacion->folio = $query->folio + 1;
            }else{
                $cotizacion->folio =  1;
            }
            $cotizacion->save();
        }else{
            $cotizacion = new Cotizacion;
            $cotizacion-> id_vendedor = $vendedor->id;
            $cotizacion->id_cliente = $cliente->id;
            $cotizacion->nombre_cliente = $cliente->nombre;
            $cotizacion->email_cliente = $cliente->email;
            $cotizacion->fecha = $request->fecha;
            $cotizacion->total = $total;
            $cotizacion->folio = 1;
            $cotizacion->save();
        }
        

        foreach($producto as $pro){
            $detalle_cotizacion = new DetalleCotizacion;
            $detalle_cotizacion->id_cotizacion = $cotizacion->id;
            $detalle_cotizacion->id_producto = $pro->id;
            $detalle_cotizacion->cantidad =  $pro->cantidad;
            $detalle_cotizacion->modelo = $pro->modelo;
            $detalle_cotizacion->descripcion = $pro->descripcion;
            $detalle_cotizacion->unidad = $pro->unidad;
            $detalle_cotizacion->moneda = $pro->moneda;
            $detalle_cotizacion->precio_unitario = $pro->precio_unitario;
            $detalle_cotizacion->precio_venta = $pro->precio_venta;
            $detalle_cotizacion->total = $pro->precio_unitario * $pro->cantidad;
            $detalle_cotizacion->save();
        }

        Session::flash('message','Cotización guardada correctamente');

        \Session::forget('item');
        \Session::forget('id_element');

        return redirect('productos')->with('message','Cotización guardada correctamente');
    }

    public function imprimir($id_vendedor, $id_cliente){
        $producto = \Session::get('item');
        $cliente = DB::table('clientes')->where('id','=',$id_cliente)->first();
        $vendedor = DB::table('vendedores')->where('id','=',$id_vendedor)->first();
        $fecha = date("d/m/Y");

        $pdf = PDF::loadView('imprimir',['producto'=>$producto,'cliente'=>$cliente,'vendedor'=>$vendedor,'fecha'=>$fecha]);
        return $pdf->stream();
    }

}
