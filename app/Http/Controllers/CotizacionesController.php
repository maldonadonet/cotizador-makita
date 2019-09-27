<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Producto;
use Barryvdh\DomPDF\Facade as PDF;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use App\SeguimientoCotizacion;
use App\Cotizacion;


class CotizacionesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request ){
        $user = Auth::user();
        if($user->tipo_usuario == 'admin'){
                if($request){
                $query=trim($request->get('searchText'));
                $cotizaciones=DB::table('cotizaciones as c')
                ->join('vendedores as v','c.id_vendedor','=','v.id')
                ->select('c.id','c.id_cliente','c.id_vendedor','c.nombre_cliente as cliente','c.email_cliente as email','v.nombre as vendedor','c.fecha','c.total','c.folio')
                ->where('c.nombre_cliente','LIKE','%'.$query.'%')
                ->orWhere('c.email_cliente','LIKE','%'.$query.'%')
                ->orWhere('v.nombre','LIKE','%'.$query.'%')
                ->orWhere('c.created_at','LIKE','%'.$query.'%')
                ->orderBy('c.id','des')
                ->paginate(10);
                return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
            }
        }else{
               if($request){
                $query=trim($request->get('searchText'));
                $cotizaciones=DB::table('cotizaciones as c')
                ->join('vendedores as v','c.id_vendedor','=','v.id')
                ->select('c.id','c.id_vendedor','c.nombre_cliente as cliente','c.email_cliente as email','v.nombre as vendedor','c.fecha','c.total','c.folio')
                ->where('c.id_vendedor','=',$user->id_vendedor)
                ->where('c.email_cliente','LIKE','%'.$query.'%')
                ->where('v.nombre','LIKE','%'.$query.'%')
                ->where('c.created_at','LIKE','%'.$query.'%')
                ->orderBy('c.id','des')
                ->paginate(10);
                return view('cotizaciones.index',["cotizaciones"=>$cotizaciones,"searchText"=>$query]);
            }
        }
        
    }

    public function show($id){
        $cotizaciones = DB::table('detalle_cotizacion')
        ->select('id','modelo','descripcion','cantidad','unidad','moneda','precio_unitario','precio_venta','total','created_at')
        ->where('id_cotizacion','=',$id)->get();

        $seguimiento = DB::table('seguimiento_cotizaciones as sc')
        ->join('clientes as cli','sc.id_cliente','=','cli.id')
        ->join('vendedores as v','sc.id_vendedor','=','v.id')
        ->select('sc.id','sc.id_cot','cli.nombre as cliente','v.nombre as vendedor','sc.tipo_seguimiento as seguimiento','sc.comentarios','sc.fecha','sc.no_factura','sc.id_prod')
        ->where('sc.id_cot',$id)
        ->get();

        return view('cotizaciones.show',[ 'cotizaciones' => $cotizaciones,'seguimiento' => $seguimiento, 'id_cot' => $id ]);

    }

    public function registrarSeguimiento(Request $request){
        $id_cot = Cotizacion::where('id',$request->id_cot)->first();

        $seguimiento = new SeguimientoCotizacion;
        $seguimiento->id_cot = $id_cot->id;
        $seguimiento->id_cliente = $id_cot->id_cliente;
        $seguimiento->id_vendedor = $id_cot->id_vendedor;
        $seguimiento->tipo_seguimiento = $request->tipo_seguimiento;
        $seguimiento->comentarios = $request->comentarios;
        $seguimiento->fecha = $request->fecha;
        $seguimiento->no_factura = $request->no_factura;
        $seguimiento->id_prod = $request->producto;
        if( $seguimiento->tipo_seguimiento == '3ra Llamada - Cierre de venta' ) {
            $seguimiento->venta = 1;
        }
        $seguimiento->save();

        return Redirect::back()->with('message', 'Seguimiento agregado correctamente.');
    }

    public function imprimir(Request $request){
        
        $producto = DB::table('detalle_cotizacion')->where('id_cotizacion','=',$request->id_cotizacion)->get();
        
        $cliente = DB::table('clientes')->where('id','=',$request->id_cliente)->first();
        $vendedor = DB::table('vendedores')->where('id','=',$request->id_vendedor)->first();
        $fecha = date("d/m/Y");

        $pdf = PDF::loadView('imprimir',['producto'=>$producto,'cliente'=>$cliente,'vendedor'=>$vendedor,'fecha'=>$fecha]);
        return $pdf->stream();
    }

    public function enviar(Request $request){
        $total = 0;
        $producto = DB::table('detalle_cotizacion')->where('id_cotizacion','=',$request->id_cotizacion)->get();
        $cliente = DB::table('clientes')->where('id','=',$request->id_cliente)->first();
        $vendedor = DB::table('vendedores')->where('id','=',$request->id_vendedor)->first();
        $query = DB::table('cotizaciones')->where('id_vendedor',$vendedor->id)->orderBy('id','des')->first();
        $fecha = date("d/m/Y");

        foreach($producto as $pro_session){
            $subtotal = $pro_session->precio_venta * $pro_session->cantidad;
            $total = $total + $subtotal;
        }

        Mail::send('cotizacion',['data'=>$request,'producto'=>$producto,'cliente'=>$cliente,'vendedor'=>$vendedor,'total'=>$total,'folio'=>$query] , function($msj) use($cliente) {
            
            $msj->subject('Cotización Makita | Artículos Innovadores Leo');
            $msj->to($cliente->email);
        });

        Session::flash('message','Mensaje enviado correctamente');
        return redirect('productos')->with('message','Cotización enviada correctamente');
    }

}
