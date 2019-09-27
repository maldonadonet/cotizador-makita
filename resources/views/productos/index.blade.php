@extends ('layout/admin')
@section ('contenido')
<div class="row">
    @if (session('message'))
        <div class="alert alert-warning" role="alert">
            {{ session('message') }}
        </div>
    @endif
</div>

<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Productos <a href="productos/create"><button class="btn btn-success">Agregar producto</button></a></h3>
        @include('productos.search')
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="">
        <h3 class="text-right"><a href="vercotizacion" class="btn btn-info">Ver cotización</a></h3>
    </div>
</div>
<style>
    table tbody, table thead
    {
        display: block;
    }
    table tbody 
    {
    overflow: auto;
    height: 100vh;
    scrollbar-width: none;
    }
    th
    {
        width: 5%;
    }
    td
    {
        width: 5%;
    }
</style>
<!--  -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover table-fixed">
                <thead>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Moneda</th>
                    <th>Precio Venta</th>
                    <th>Foto</th>
                    <th>Operaciones</th>
                </thead>
                <tbody>
                @foreach ($productos as $pro)
                <tr>
                    <td>{{ $pro->modelo }}</td>
                    <td>{{ $pro->tipo }}</td>
                    <td>{{ $pro->descripcion }}</td>
                    <td>{{ $pro->unidad }}</td>
                    <th>{{ $pro->moneda}}</th>
                    <th>$ {{ number_format($pro->precio_unitario, 2, '.', ',')}}</th>
                    <th>
                        @if( file_exists(public_path().'/imagenes/'.$pro->modelo.'.jpg'))
                            <img src="{{asset('imagenes').'/'.$pro->modelo.'.jpg'}}" class="img-responsive" style="width:100px">
                        @else
                            <img src="{{asset('imagenes/No_disponible.jpg')}}" class="img-responsive" style="width:100px">
                        @endif
                    </th>
                    <td>
                        <a href="#" data-target="#modal-add-{{$pro->id}}" data-toggle="modal"><button class="btn btn-primary btn-block">Agregar</button></a>
                        <a href="{{URL::action('ProductosController@edit',$pro->id)}}"><button class="btn btn-warning btn-block">Editar</button></a>
                        @if(Auth::user()->tipo_usuario == 'admin')
                            <a href="#" data-target="#modal-delete-{{$pro->id}}" data-toggle="modal"><button class="btn btn-danger btn-block">Eliminar</button></a>
                        @endif
                    </td>
                </tr>
                @include('productos.modal')
                @include('productos.modalcarrito')
                @endforeach
                </tbody>
            </table>
        </div>
        @include('sweet::alert')
        <!-- {{$productos->links()}} -->
        {{ $productos->appends(['searchText' => $searchText])->links() }}
    </div>
</div>
@stop

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            //$("#btn_enviar").hide();
        });
    </script>
@endpush
