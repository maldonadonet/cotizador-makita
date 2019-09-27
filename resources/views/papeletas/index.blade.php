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
        <h3>PAPELETAS <a href="papeletas/create"><button class="btn btn-success">Nuevo</button></a></h3>
        @include('papeletas.search')
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover table-fixed">
                <thead>
                    <th>Id</th>
                    <th>Empresa</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>C/Nuevo</th>
                    <th>Medio</th>
                </thead>
                <tbody>
                @foreach ($papeletas as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->empresa }}</td>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->email }}</td>
                    <th>{{ $p->telefono }}</th>
                    <th>{{ $p->producto }}</th>
                    <th>{{ $p->marca }}</th>
                    <th>{{ $p->cliente_nuevo }}</th>
                    <th>{{ $p->contacto }}</th>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('sweet::alert')
        {{$papeletas->render()}}
    </div>
</div>
@stop

