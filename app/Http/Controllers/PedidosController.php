<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use DB;
use App\detallePedido;
use App\Pedido;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Mail;
use Session;
use Barryvdh\DomPDF\Facade as PDF;


class PedidosController extends Controller
{
    public function levantar_pedido(){

        return view('pedidos.index');
    }

    public function hacer_pedido(Request $request){
        
        $cliente = DB::table('clientes')->where('email','=',$request->email)->first();
        
        DB::beginTransaction();
        try{
            $pedido = new Pedido;
            $pedido->id_cliente = $cliente->id;
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->dir_entrega = $request->get('dir_entrega');
            $pedido->telefono = $request->get('telefono');
            $pedido->dir_fiscal = $request->get('email');
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->dir_fiscal = $request->get('dir-fiscal');
            $pedido->save();

            $idproducto = $request->get('idproducto');
            $cantidad = $request->get('cantidad');
            $num_nota = $request->get('num_nota');
            $tipo_pago = $request->get('tipo_pago');
            $precio = $request->get('precio');
            $factura = $request->get('factura');
            $total = $request->get('subtotal');

            $cont=0;

            while($cont < count($idproducto)){
                $detalle = new DetallePedido();
                $detalle-> idpedido = $pedido->idpedido;
                $detalle-> idproducto= $idproducto[$cont];
                $detalle-> cantidad = $cantidad[$cont];
                $detalle-> num_nota = $num_nota[$cont];
                $detalle-> tipo_pago = $tipo_pago[$cont];
                $detalle-> precio = $precio[$cont];
                $detalle-> factura = $factura[$cont];
                $detalle-> total = $total[$cont];
                $detalle-> estatus = "Pendiente";
                $detalle->save();
                $cont=$cont+1;

            }
            DB::commit();

        }catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
        return Redirect::to('pedidos');
    }
}
