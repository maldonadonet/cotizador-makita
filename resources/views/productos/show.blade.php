@extends ('layout/admin')
@section ('contenido')
    
   <h1 class="text-center h1">Artículos Innovadores Leo</h1>
   <h2 class="text-center">Cotización Makita</h2>

   <div class="container-fluid contenedor">
        <div class="col-xs-12 col-md-6">
            <h3>Datos del cliente</h3>
            {!!Form::open(array('url'=>'enviar_cotizacion','method'=>'POST','autocomplete'=>'off','name'=>'formulario1','id'=>'formulario2'))!!}
            {{Form::token()}}
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                    <tr>
                        <th scope="row">Fecha</th>
                        <th><input type="text" name="fecha" id="" value="{{ date("d/m/Y") }} {{ date("g:i a")}}"></th>
                    </tr>
                    <tr>
                        <th>Cliente</th>
                        <th>
                            <div class="form-group">
                                <select class="form-control" name="cliente" id="cliente" onchange="validar_cliente()" required="true">
                                    <option value="0">Seleccionar cliente</option>
                                    @foreach ($clientes as $cli)
                                        <option value="{{$cli->id}}">{{ $cli->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Atención</th>
                        <th>
                            <input type="text" name="atn" placeholder="Nombre de contacto con la empresa" class="form-control" id="atencion">
                        </th>
                    </tr>
                    <tr>
                        <th>Télefono</th>
                        <th>
                            <input type="tel" name="tel" placeholder="Telefono de contacto" class="form-control" id="telefono">
                        </th>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <th>
                            <input type="tel" name="email" placeholder="Correo electronico de contacto" class="form-control" id="email">
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-md-6">
            <h3>Datos del vendedor</h3>
            <table class="table table-striped table-inverse table-responsive">
                <tbody>
                    <tr>
                        <td scope="row">Empresa</td>
                        <td>Artículos Innovadores Leo S.A. de C.V. </td>
                    </tr>
                    <tr>
                        <td>Vendedor</td>
                        <td>
                            @if(Auth::user()->tipo_usuario == 'admin' || Auth::user()->tipo_usuario =='admin1')
                                <div class="form-group">
                                    <select class="form-control" name="vendedor" id="vendedor" onchange="validad_vendedor()" required="true">
                                        <option value="0">Seleccionar vendedor</option>
                                        @foreach ($vendedores as $ven)
                                            <option value="{{$ven->id}}">{{ $ven->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <select class="form-control" name="vendedor" id="vendedor" onchange="validad_vendedor()" required="true">
                                        <option value="{{ Auth::user()->id}}">{{ Auth::user()->name }}</option>
                                    </select>
                                </div>
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td>Cafetal No. 368 Col. Granjas México Del. Iztacalco, C.P. 08400</td>
                    </tr>
                    <tr>
                        <td>Télefono</td>
                        <td>(55)2235-5565</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            @if(Auth::user()->tipo_usuario == 'admin' || Auth::user()->tipo_usuario =='admin1')
                                <input type="text" value="" name="email_vendedor" id="email_vendedor" placeholder="email del vendedor" class="form-control">
                            @else
                            <input type="text" value="{{ Auth::user()->email }}" name="email_vendedor" id="email_vendedor" placeholder="email del vendedor" class="form-control">
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Folio</th>
                        <th>002</th>
                    </tr>
                </tbody>
                <tfoot>
                   
                </tfoot>
            </table>
        </div>
   </div>
   <div class="row text-center">
        <a href="https://articulosinnovadoresleo.com/assets/politicas.pdf" class="btn btn-primary" target="_blank"> Ver politicas y formas de pago</a>
   </div>
   <hr>
   <div class="contrainer-fluid">
        @foreach($producto as $pro)
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <!-- <img src="{{asset('imagenes').'/'.$pro->modelo.'.jpg'}}" class="img-responsive"> -->
                @if( file_exists(public_path().'/imagenes/'.$pro->modelo.'.jpg'))
                    <img src="{{asset('imagenes').'/'.$pro->modelo.'.jpg'}}" class="img-responsive">
                @elseif (file_exists(public_path().'/imagenes/'.$pro->modelo.'.png') )
                    <img src="{{asset('imagenes').'/'.$pro->modelo.'.png'}}" class="img-responsive">
                @else
                    <img src="{{asset('imagenes/No_disponible.jpg')}}" class="img-responsive">
                @endif
            </div>
            <div class="col-xs-12 col-md-8">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Campos</th>
                    <th scope="col">Datos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Modelo</th>
                    <th>{{$pro->modelo}}</th>
                    </tr>
                    <tr>
                    <th scope="row">Descripción</th>
                    <th>{{$pro->descripcion}}</th>
                    </tr>
                    <tr>
                    <th scope="row">Unidad</th>
                    <th>{{$pro->unidad}}</th>
                    </tr>
                    <tr>
                    <th scope="row">Moneda</th>
                    <th>{{$pro->moneda}}</th>
                    </tr>
                    <tr>
                        <th scope="row">Precio comercial</th>
                        <th>
                            <!-- $ {{ number_format($pro->precio_unitario, 2, '.', ',')}} -->
                            <strong style="color:red; font-size:1.4em; text-decoration:line-through;">$ {{ number_format($pro->precio_unitario + ($pro->precio_unitario * .10), 2, '.', ',')}}</strong> <strong style="font-size:1em; color: dimgrey;">| PRODUCTO CON DESCUENTO ESPECIAL DE TEMPORADA</strong></p>
                        </th>
                    </tr>
                    <tr>
                        <th>Precio Promocional</th>
                        <th>$ {{ number_format($pro->precio_unitario, 2, '.', ',')}}</th>
                    </tr>
                    
                    <tr>
                        <th>Cantidad</th>
                        <th>{{$pro->cantidad}}</th>
                    
                        <th style="display:none">
                            {!!Form::open(array('url'=>'modificarcant','method'=>'POST','autocomplete'=>'off','name'=>'formeditcant'))!!}
                            {{ csrf_field() }}
                                <input type="number" name="cantidad" placeholder="Indicar cantidad a modificar" class="form-control">
                                <input type="hidden" name="id_prod" value="{{$pro->id}}">
                                {{-- <input type="button" value="Procesar" class="btn btn-primary" onclick="enviarform1()"> --}}
                                {{-- <input type="button" class="form-control btn-info" value="Modificar" onclick="enviar_cantidad()"> --}}
                            {{ Form::close() }}
                        </th>
                    </tr>
                    <tr>
                    <th>Sub total</th>
                    <th>$ {{ number_format($pro->precio_unitario * $pro->cantidad, 2, '.', ',')}}</th>
                    <th>
                        {!!Form::open(array('url'=>'eliminaritem','method'=>'POST','autocomplete'=>'off'))!!}
                            {{ csrf_field() }}
                            <input type="hidden" name="id_elemento" value="{{ $pro->id_elemento}}">
                            <input type="submit" class="form-control btn-danger" value="Eliminar">
                            {{-- <input type="hidden" name="id_prod" value="{{$pro->id}}"> --}}
                        {{ Form::close() }}
                    </th>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        @endforeach


   </div>
   <div class="container-fluid">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Resumen de la cotización
            </div>
            <div class="panel-body">
                <table class="table table-striped table-inverse table-responsive">
                    @if($producto)
                    <tr>
                        <td>Total:</td>
                        <td><strong style="color:red;font-size:2em;">$ {{ number_format($total, 2, '.', ',')}}</strong></td>
                        <input type="hidden" name="total_cotizacion" value="{{$total}}">
                        <td>
                            <!-- <a href="enviar_cotizacion" class="btn btn-success">Enviar cotización</a> -->
                            <input type="button" value="Enviar cotizacion" class="btn btn-primary" onclick="enviar()">
                            <a id="enviar_pdf" class="btn btn-info" onclick="imprimir()">Imprimir</a>
                            <a id="guardar_cotizacion" class="btn btn-info" onclick="guardar_cotizacion()">Guardar cotizacion</a>
                            <a href="borrarcotizacion" class="btn btn-danger">Borrar cotizacion</a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
   </div>   
{{ Form::close() }}

@endsection

<script>

    function validar_cliente(){
        var id_cliente = $('#cliente option:selected').val();
        
        var parametros ={
            'id_cliente' : id_cliente
        };
        //alert(parametros.id_cliente);

        $.ajax({
            data: parametros,
            url: "{{ url('validar') }}",
            type : 'get',
            beforeSend: function () {
                //alert("Obteniendo datos del cliente");
            },
            success: function(respuesta){
                
                $("#telefono").val(respuesta['telefono']);
                $("#email").val(respuesta['email']);
                $("#atencion").val(respuesta['atencion']);
            },
            error: function(xhr, status){
                alert('No se pudo consultar los datos revise su conexión');
            }
        });
    }

    function validad_vendedor(){
        var id_vendedor = $('#vendedor option:selected').val();
        
        var parametros ={
            'id_vendedor' : id_vendedor
        };
        
        $.ajax({
            data: parametros,
            url: "{{ url('validar_vendedor') }}",
            type : 'get',
            beforeSend: function () {
                //alert("Obteniendo datos del cliente");
            },
            success: function(respuesta){
                
                $("#email_vendedor").val(respuesta.email);
            },
            error: function(xhr, status){
                alert('No se pudo consultar los datos revise su conexión');
            }
        });
    }

    function enviar(){
        var id_cliente = $('#cliente option:selected').val();
        var id_vendedor = $('#vendedor option:selected').val();
        if(id_cliente==0 || id_vendedor ==0){
            alert("No se ha seleccionado cliente o vendedor, Favor de revisar sus datos");
        }else{
            document.formulario1.submit();    
        }
    }

    function enviar_cantidad(){
        alert("click");
    }

    function imprimir(){
        var id_cliente = $('#cliente option:selected').val();
        var id_vendedor = $('#vendedor option:selected').val();
        var url = 'pdf/' + id_vendedor + '/' + id_cliente

        $(location).attr('href',url); 
    }

    function guardar_cotizacion(){
        var id_vendedor = $('#vendedor option:selected').val();
        var id_cliente = $('#cliente option:selected').val();

        $('#formulario2').attr('action', '{{url('guardar_cotizacion')}}');

        $('#formulario2').submit();
    }


</script>