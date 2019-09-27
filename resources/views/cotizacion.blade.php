<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        btn{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>
<body>
    
    <div style="width:95%; border:solid 3px #0097A7; margin:0 auto; padding:10px">
        <div>
            <center>      
                <img src="{{url('https://www.ail.com.mx/makita/img/logoleo.png')}}" class="img-responsive" width="300px">
                <h1>Cotización de productos MAKITA</h1>
                <h2>Artículos Innovadores Leo</h2>
            </center>
        </div>
        <div style="display:flex;  flex-direction: row; justify-content: space-between;">
            <div style="margin:5px; width:50%;">
                <h2>Datos del cliente</h2>
                <P><strong>Fecha: </strong>{{ $data->fecha }}</P>
                <p><strong>Cliente: </strong>{{ $cliente->nombre}}</p>
                <p><strong>Atención: </strong>{{ $cliente->atencion}}</p>
                <p><strong>Telefono: </strong>{{ $cliente->telefono}}</p>
                <p><strong>Correo: </strong>{{ $cliente->email}}</p>
            </div>
            <div style="margin:5px; width:50%; text-align:left">
                <h2>Datos del vendedor</h2>
                <p><strong>Empresa:   </strong>Artículos Innovadores Leo</p>
                <p><strong>Vendedor:  </strong>{{ $vendedor->nombre }}</p>
                <p><strong>Dirección: </strong>Cafetal No. 368 Col. Granjas México Del. Iztacalco, C.P. 08400</p>
                <p><strong>Télefono:  </strong>(55)2235-5565</p>
                <p><strong>Correo:    </strong>{{ $data->email_vendedor}}</p>
                @if($folio)
                    <p><strong>Folio:     </strong>{{ $folio->folio + 1}}</p>
                @else
                <p><strong>Folio:     </strong> 1</p>
                @endif
            </div>
        </div>
        <div style="margin: 0 auto;">
                <a href="https://articulosinnovadoresleo.com/assets/politicas.pdf" class="btn" target="_blank" style="background-color: #4CAF50;
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;"> Ver politicas y formas de pago</a>
        </div>
        <hr>
        <div>
            <h2 style="text-align:center; font-size:1.5em; font-weight:600; text-transform:uppercase;">Listado de productos</h2>
            <h3 style="text-align:center">Listamos los productos solicitados y/o recomendados</h3>
        </div>

        <div style="width:100%;">
            @foreach($producto as $pro)
            <div style="display:flex; flex-direction: row; justify-content: space-between; margin:5px; border-bottom:solid 1px #000;">
                <div style="width:30%;">
                    <img src="{{url('https://www.ail.com.mx/makita/img_prod/'.$pro->modelo.'.jpg')}}" width="100%">
                </div>
                <div style="width:70%; padding-left:15px;">
                    <p style="font-weight:800; font-size:1.6em;">Modelo: {{$pro->modelo}}</p>
                    <p><strong>Descripción: </strong>{{$pro->descripcion}}</p>
                    <p><strong>Unidad: </strong>{{$pro->unidad}}</p>
                    <p><strong>Moneda: </strong>{{$pro->moneda}}</p>
                    <p><strong>Precio Unitario: </strong><strong style="color:red; font-size:1.4em; text-decoration:line-through;">$ {{ number_format($pro->precio_unitario + ($pro->precio_unitario * .10), 2, '.', ',')}}</strong> <strong style="font-size:1em; color: dimgrey;">| PRODUCTO CON DESCUENTO ESPECIAL DE TEMPORADA</strong></p>
                    <p><strong>Precio Promocional: </strong><strong style="color:#0097A7; font-size:1.4em;">$ {{ number_format($pro->precio_unitario, 2, '.', ',')}}</strong></p>
                    <p><strong>Cantidad: </strong>{{$pro->cantidad}}</p>
                    <p><strong>Total: </strong><strong style="color:#0097A7; font-size:1.4em;">$ {{ number_format($pro->precio_unitario * $pro->cantidad, 2, '.', ',')}}</strong></p>
                </div>
            </div>
            @endforeach
        </div>

</div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
