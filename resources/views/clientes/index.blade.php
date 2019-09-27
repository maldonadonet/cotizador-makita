@extends ('layout/admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <!-- Boton que en el href nos lleva a la ruta categoria/create -->
      <h3>Listado de Clientes <a href="clientes/create"><button class="btn btn-success">Agregar</button></a></h3>
      <!--Se incluye el archivo que vincula el formulario con la eleccion de categorias  -->
      @include('clientes.search')
    </div>
  </div>

  <!--  -->
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Atención</th>
            <th>RFC</th>
            <th>Razón Social</th>
            <th>Vendedor</th>
            <th>Operaciones</th>
          </thead>
          
          @foreach ($clientes as $cli)
          <tr>
            <td>{{ $cli->id }}</td>
            <td>{{ $cli->nombre }}</td>
            <td>{{ $cli->direccion }}</td>
            <td>{{ $cli->telefono }}</td>
            <td>{{ $cli->email }}</td>
            <td>{{ $cli->atencion }}</td>
            <td>{{ $cli->rfc }}</td>
            <td>{{ $cli->razon_social }}</td>
            <td>{{ $cli->vendedor }}</td>
            <td>
              <a href="{{URL::action('ClientesController@show',$cli->id)}}"><button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
              <a href="{{URL::action('ClientesController@edit',$cli->id)}}"><button class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
              @if(Auth::user()->tipo_usuario == 'admin')
                <a href="#" data-target="#modal-delete-{{$cli->id}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
              @endif
            </td>
          </tr>
          @include('clientes.modal')
          @endforeach
        </table>
      </div>
      <!-- Funcion render que nos va hacer la paginacion -->
      {{$clientes->render()}}
    </div>
  </div>
@stop
