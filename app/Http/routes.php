<?php
use App\Producto;

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('clientes','ClientesController');
Route::resource('productos','ProductosController');
Route::resource('cotizaciones','CotizacionesController');
Route::resource('vendedores','VendedoresController');
Route::resource('reportes','ReportesController');
Route::resource('perfil','PerfilController');
Route::resource('papeletas','PapeletasController');

Route::post('agregar','ProductosController@agregar');
Route::get('vercotizacion','ProductosController@vercotizacion');
Route::get('borrarcotizacion','ProductosController@borrarcotizacion');

Route::get('modelos',function(){
    $productos = DB::table('productos')->get();
    $cant =0;
    foreach($productos as $pro){
        $nombre_fichero = public_path().'/imagenes/'.$pro->modelo.'.jpg';

        //dd($nombre_fichero);

        if (file_exists($nombre_fichero)) {
            //echo "Existe"."<br>".$pro->modelo."<br>";
        } else {
           echo $pro->modelo."<br>";
        }
        $cant = $cant + 1;
    }
    echo "total de elementos: ". $cant;
    //return view('modelos',['productos'=>$productos]);
});

Route::post('modificarcant','ProductosController@modificarcant');

Route::post('eliminaritem','ProductosController@eliminaritem');

Route::get('validar','ProductosController@validar');

Route::get('validar_vendedor','ProductosController@validar_vendedor');

Route::post('enviar_cotizacion','ProductosController@enviar_cotizacion');

Route::get('cotizacion','ProductosController@enviar_cotizacion');

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('pdf/{id_vendedor}/{id_cliente}','ProductosController@imprimir');

Route::post('guardar_cotizacion','ProductosController@guardar_cotizacion');

Route::get('imprimir','CotizacionesController@imprimir');

Route::get('enviar','CotizacionesController@enviar');

Route::get('pedidos','PedidosController@levantar_pedido');

Route::post('pedidos_post','PedidosController@hacer_pedido');

Route::post('registrar_seguimiento','CotizacionesController@registrarSeguimiento');

//Si la ruta no existe
//Route::get('/{slug?}','HomeController@index');
