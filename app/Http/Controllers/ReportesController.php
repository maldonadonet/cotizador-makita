<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cotizacion;
use DB;

class ReportesController extends Controller
{
    public function index(Request $request) {

        if($request->input('fecha_inicio')){
            $fecha_inicio = trim($request->get('fecha_inicio'));
            $fecha_final = trim($request->get('fecha_final'));

            $cotizaciones_vendedor = DB::table('cotizaciones as c')
            ->join('vendedores as v','c.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(c.id_vendedor)as total'))
            ->where('c.created_at','>=',$fecha_inicio)
            ->where('c.created_at','<=',$fecha_final)
            ->groupBy('c.id_vendedor')->get();
            
            $papeletas_vendedor = DB::table('papeletas as p')
            ->join('vendedores as v','p.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(p.id_vendedor)as total'))
            ->whereIn('p.id_vendedor',[1,2,4])
            ->where('p.created_at','>=',$fecha_inicio)
            ->where('p.created_at','<=',$fecha_final)
            ->groupBy('p.id_vendedor')
            ->get();

            $ventas_vendedor = DB::table('seguimiento_cotizaciones as s')
            ->join('vendedores as v','s.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(s.venta)as total'))
            ->where('s.created_at','>=',$fecha_inicio)
            ->where('s.created_at','<=',$fecha_final)
            ->groupBy('s.id_vendedor')->get();

            $top_productos = DB::table('detalle_cotizacion as dc')
            ->join('productos as p','dc.modelo','=','p.modelo')
            ->select('dc.modelo','p.descripcion',DB::raw('count(dc.modelo)as total'))
            ->where('dc.created_at','>=',$fecha_inicio)
            ->where('dc.created_at','<=',$fecha_final)
            ->groupBy('dc.modelo')
            ->orderBy('total','desc')
            ->limit(10)
            ->get();

            $num_clientes = DB::table('clientes')
            ->where('created_at','>=',$fecha_inicio)
            ->where('created_at','<=',$fecha_final)
            ->count();

            $num_cotizaciones = DB::table('cotizaciones')
            ->where('created_at','>=',$fecha_inicio)
            ->where('created_at','<=',$fecha_final)
            ->count();

            $num_papeletas = DB::table('papeletas')
            ->where('created_at','>=',$fecha_inicio)
            ->where('created_at','<=',$fecha_final)
            ->count();

            $num_vendedores = DB::table('vendedores')->count();

            return view('reportes.index',['cotizaciones' => $cotizaciones_vendedor, 'papeletas' => $papeletas_vendedor, 'num_clientes' => $num_clientes, 'num_cot' => $num_cotizaciones, 'num_papeletas' => $num_papeletas, 'num_vendedores' => $num_vendedores, 'ventas' => $ventas_vendedor, 'top_productos' => $top_productos]);
        }else{
            $cotizaciones_vendedor = DB::table('cotizaciones as c')
            ->join('vendedores as v','c.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(c.id_vendedor)as total'))
            ->groupBy('c.id_vendedor')->get();
            
            $papeletas_vendedor = DB::table('papeletas as p')
            ->join('vendedores as v','p.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(p.id_vendedor)as total'))
            ->whereIn('p.id_vendedor',[1,2,4])
            ->groupBy('p.id_vendedor')
            ->get();

            $ventas_vendedor = DB::table('seguimiento_cotizaciones as s')
            ->join('vendedores as v','s.id_vendedor','=','v.id')
            ->select('v.nombre',DB::raw('count(s.venta)as total'))
            ->groupBy('s.id_vendedor')->get();

            $top_productos = DB::table('detalle_cotizacion as dc')
            ->join('productos as p','dc.modelo','=','p.modelo')
            ->select('dc.modelo','p.descripcion',DB::raw('count(dc.modelo)as total'))
            ->groupBy('dc.modelo')
            ->orderBy('total','desc')
            ->limit(10)
            ->get();

            $num_clientes = DB::table('clientes')->count();

            $num_cotizaciones = DB::table('cotizaciones')->count();

            $num_papeletas = DB::table('papeletas')->count();

            $num_vendedores = DB::table('vendedores')->count();


            //

            return view('reportes.index',['cotizaciones' => $cotizaciones_vendedor, 'papeletas' => $papeletas_vendedor, 'num_clientes' => $num_clientes, 'num_cot' => $num_cotizaciones, 'num_papeletas' => $num_papeletas, 'num_vendedores' => $num_vendedores, 'ventas' => $ventas_vendedor, 'top_productos' => $top_productos]);
        }

       
    }
}
