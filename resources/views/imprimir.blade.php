<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización Makita 2019</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <style>
        #bg{
            background-color: #f2f2f2;
            background-image: url('img/fondo.jpg');  
        }
        body,html{
            margin:0;
        }
        .mt-2{
            margin-top: 20px;
        }
        hr {
        page-break-after: always;
        border: 0;
        margin: 0;
        padding: 0;
        }
        
    </style>
</head>
<body id="bg">
    
    <div class="container">
        <div class="row text-center mt-2">
            <div class="col-md-4 col-lg-4" style="padding: 20px;">
                <img src="{{url('https://www.ail.com.mx/makita/img/logoleo.png')}}" class="" width="200px">
            </div>
            <div class="col-md-4 col-lg-4">
                <h1>Artículos Innovadores Leo</h1>
                <h2>Cotización de productos</h2>
            </div>
        </div>
        <div class="row" style="font-size: 11px;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Datos del cliente</th>
                  <th scope="col"></th>
                  <th scope="col">Datos del vendedor</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Fecha: </th>
                  <th>{{$fecha}}</th>
                  <td scope="row">Empresa: </td>
                  <th>Artículos Innovadores Leo</th>
                </tr>
                <tr>
                  <th scope="row">Nombre: </th>
                  <td>{{$cliente->nombre}}</td>
                  <td scope="row">Vendedor: </td>
                  <th>{{$vendedor->nombre}}</th>
                </tr>
                <tr>
                  <th scope="row">Atención: </th>
                  <td>{{$cliente->atencion}}</td>
                  <th scope="row">Dirección: </th>
                  <td>Cafetal No. 368 Col. Granjas México Del. Iztacalco, C.P. 08400</td>
                </tr>
                <tr>
                  <th scope="row">Telefono: </th>
                  <td>{{$cliente->telefono}}</td>
                  <th scope="row">Telefono: </th>
                  <td>{{$vendedor->tel}}</td>
                </tr>
                <tr>
                  <th scope="row">Correo: </th>
                  <td>{{$cliente->email}}</td>
                  <th scope="row">Correo: </th>
                  <td>{{$vendedor->email}}</td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="col">No de folio: </th>
                    <th>0001</th>
                </tr>
              </tbody>
            </table>
        </div>
         @foreach($producto as $pro)
        <div class="row" style="margin-bottom: 10px; background-color: white;">
            <div>
                <div style="width: 30%; float: left;">
                    <img src="{{url('https://www.ail.com.mx/makita/img_prod/'.$pro->modelo.'.jpg')}}" width="60%" class="img img-responsive" style="margin-top: 14px; margin-left: 20px;">
                </div>
                <div style="width: 70%; float: right; ">
                    <span style="font-size: 20px;"><strong>Modelo: </strong>{{$pro->modelo}}</span><br>
                    <span><strong>Descripción: </strong>{{$pro->descripcion}}</span><br>
                    <span><strong>Unidad: </strong>{{$pro->unidad}}</span><br>
                    <span><strong>Moneda: </strong>{{$pro->moneda}}</span><br>
                    <span><strong>Precio Unitario: </strong>$ {{ number_format($pro->precio_unitario + ($pro->precio_unitario * .10), 2, '.', ',')}}| PRODUCTO CON DESCUENTO ESPECIAL DE TEMPORADA</span><br>
                    <span><strong>Precio Promocional: </strong><strong style="text-decoration: line-through; color: red;">$ {{ number_format($pro->precio_unitario, 2, '.', ',')}}</strong></span><br>
                    <span><strong>Cantidad: </strong>{{$pro->cantidad}}</span><br>
                    <span><strong>Total: </strong><strong>$ {{ number_format($pro->precio_unitario * $pro->cantidad, 2, '.', ',')}}</strong></span><br>
                </div>
            </div>
            <br>
        </div>
        @endforeach
    </div>
    <hr>
    <div class="row" style="margin: 20px;">
        <h2 class="text-center">Formas de pago</h2>
        <div class="">
            <ul class="list-group">
                <li class="list-group-item">DEPOSITO</li>    
                <li class="list-group-item">PAGO CON TARJETA DE DEBITO</li>
                <li class="list-group-item">PAGO CON TARJETA DE CREDITO</li>
                <li class="list-group-item">TRANSFERENCIA BANCARIA</li>
                <li class="list-group-item">EFECTIVO</li>
                <li class="list-group-item">CHEQUE DEPOSITADO A CUENTA</li>
            </ul>
        </div>
        <div class="">
            <ul class="list-group">
                <li class="list-group-item text-center">
                    <img src="img/visa-master.png" style="width: 50%;">
                </li>
                <li class="list-group-item">
                    <h3>Bancomer (MXN)</h3>
                    <strong>BBV BANCOMER MXN</strong><br>
                    <strong>CUENTA: </strong>0184605934<br>
                    <strong>TRANSFERENCIA: </strong> 012 180 001 8460 5934 2<br>
                    <strong>SUCURSAL: </strong>0043 PLAZA ORIENTE
                </li>
                <li class="list-group-item">
                    <h3>Bancomer (USD)</h3>
                    <strong>BBV BANCOMER DOLARES <br>Clave: ABA -A.B.A. 021000021<br>SWIFT-BCMRMXMMPYM</strong><br>
                    <strong>CUENTA: </strong>0110982180<br>
                    <strong>TRANSFERENCIA: </strong> 012 180 001 1098 2180 6<br>
                    <strong>SUCURSAL: </strong>0043 PLAZA ORIENTE
                </li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row" style="padding:30px;">
        <h2 class="text-center">POLITICAS DE PAGO</h2>
        <ul class="list-group" style="font-size: 10px;">
            <li class="list-group-item">Sus pagos podrán realizarse mediante depósito anticipado a nuestra cuenta o con efectivo.</li>
            <li class="list-group-item">Le sugerimos que en caso de hacer un depósito con cheque sea del mismo banco que el nuestro, o por SPEI, con el fin de que el pago se acredite inmediatamente a nuestra cuenta y sus pedidos puedan ser liberados para su facturación y entrega de producto.</li>
            <li class="list-group-item">Todos los comprobantes de pago deben ser enviados con el detalle de facturas (números y cantidades que están pagando) al correo de su vendedor y al correo de ventas@ail.com.mx.</li>
            <li class="list-group-item">Los depósitos de cheques salvo buen fin se pueden tardar de 2 a 3 días hábiles para que se confirme que haya pasado en firme.</li>
            <li class="list-group-item">No se aceptan cheques.</li>
            <li class="list-group-item">Pago con tarjeta de crédito ó tarjeta de debito</li>
            <li class="list-group-item">si el pago es realizado en nuestras instalaciones.Los pagos serán procesados Lunes a Viernes en el horario de las 08:30 y hasta las 17:30; después de ese horario se procesará hasta el siguiente día hábil, al igual que los pagos realizados durante el fin de semana o días festivos.</li>
            <li class="list-group-item">El material se entrega hasta que se compruebe la transferencia bancaria o el depósito en firme.</li>
        </ul>
        <!-- <img src="img/politicas.png" style="margin-top: 20px;" class="text-center"> -->
        <!-- <hr> -->
        <h2 class="text-center">POLITICAS DE VENTA</h2>
        <ul class="list-group" style="font-size: 10px;">
            <li class="list-group-item">Se agregará el 16% del IVA.</li>
            <li class="list-group-item">Los precios están en MN en Moneda Nacional (Pesos Mexicanos).</li>
            <li class="list-group-item">Precios sujetos a cambio sin previo aviso.</li>
            <li class="list-group-item">Los precios son LAB en Ciudad de México o zona metropolitana. Entregas a domicilio compras a partir de $1,000.00 MN.</li>
            <li class="list-group-item">Entregas en el Territorio Nacional, distinto a la Ciudad de México y Zona Metropolitana es a cuenta del Cliente. El Cliente nos indicará el nombre del transportista de su preferencia. Si el Cliente no nos indica alguna transportista, la Empresa escogerá la que consideré la que de mejor servicio y a un precio accesible.</li>
            <li class="list-group-item">DISTRIBUIDORES, favor de recoger en nuestras oficinas o bodegas.</li>
            <li class="list-group-item">No se aceptan cancelaciones ni cambios para pedidos especiales o de servicio ya habiendo sido aceptado por EL FABRICANTE.</li>
            <li class="list-group-item">Devoluciones: Solo serán aceptadas por herramientas con <strong>mal funcionamiento</strong> y serán revisadas antes de dar un informe por escrito para hacer válida la garantía y cambio de la misma.</li>
        </ul>
        
    </div>
</body>
</html>
