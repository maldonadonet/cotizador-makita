@extends ('layout/admin')
@section ('contenido')

<div class="container">
    <h1 class="text-center">Historial del Cliente</h1>
</div>
<hr>
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <h5 class="card-header">Datos del Cliente</h5>
                <div class="card-body">
                    <h5 class="card-title"><strong>Nombre: </strong>{{ $cliente->nombre }}</h5>
                    <p class="card-text"></p>
                    <p class="card-text"> <strong>Dirección: </strong>{{ $cliente->direccion }}</p>
                    <p class="card-text"> <strong>Teléfono: </strong>{{ $cliente->telefono }}</p>
                    <p class="card-text"> <strong>Email: </strong>{{ $cliente->email }}</p>
                    <p class="card-text"> <strong>Atención: </strong>{{ $cliente->atencion }}</p>
                    <p class="card-text"> <strong>Razón Social: </strong>{{ $cliente->razon_social }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <h5 class="card-header">Datos del Vendedor</h5>
                <div class="card-body">
                    <h5 class="card-title"><strong>Nombre: </strong>{{ $vendedor->nombre }}</h5>
                    <p class="card-text"><strong>Dirección: </strong> {{ $vendedor->direccion }}</p>
                    <p class="card-text"><strong>Teléfono: </strong> {{ $vendedor->tel }}</p>
                    <p class="card-text"><strong>Email: </strong> {{ $vendedor->email }}</p>
                    <p class="card-text"><strong>Área: </strong> {{ $vendedor->area }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center" style="margin-top:20px;">
        <h2>Historial de cotizaciones</h2>
        <br>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12">
                <table class="table table-striped table-inverse">
                    <thead class="thead-inverse">
                        <tr>
                            <th>Id</th>
                            <th>Id vendedor</th>
                            <th>Id Cliente</th>
                            <th>Cliente</th>
                            <th>Email cliente</th>
                            <th>Fecha Cotización</th>
                            <th>Total</th>
                            <th>Folio</th>
                            <th>Operaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($cotizaciones as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->id_vendedor }}</td>
                                <td>{{ $item->id_cliente }}</td>
                                <td>{{ $item->nombre_cliente }}</td>
                                <td>{{ $item->email_cliente }}</td>
                                <td>{{ $item->fecha }}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->folio }}</td>
                                <td><a href="{{URL::action('CotizacionesController@show',$item->id)}}"><button class="btn btn-primary btn-block">Detalles</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            
        </div>
    </div>
</div>

@endsection