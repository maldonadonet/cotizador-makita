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
    <div class="col-md-10 col-md-offset-1 text-center">
        <hr>
        <h1 class="text-center text-info"> Productos cotizados</h1>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Id</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>            
                    <th>Unidad</th>
                    <th>Moneda</th>
                    <th>Precio unitario</th>
                    <th>Precio venta</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </thead>

                @foreach ($cotizaciones as $cot)
                <tr>
                    <td>{{ $cot->id }}</td>
                    <td>{{ $cot->modelo }}</td>
                    <td>{{ $cot->descripcion }}</td>
                    <td>{{ $cot->cantidad }}</td>
                    <th>{{ $cot->unidad }}</th>
                    <th>{{ $cot->moneda }}</th>
                    <th>{{ $cot->precio_unitario }}</th>
                    <th>{{ $cot->precio_venta }}</th>
                    <th>{{ $cot->total }}</th>
                    <th>{{ $cot->created_at }}</th>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<div class="container-fluid" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
            <hr>
            <h1 class="text-center text-info"> Reporte de seguimiento </h1>
            <hr>
            <a class="btn btn-info" href="#" role="button"  data-toggle="modal" data-target="#modalseguimiento">Agregar seguimiento</a>
        </div>
    </div>
    @if ( $seguimiento )
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-striped table-inverse">
                <thead class="thead-inverse">

                    <tr>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Seguimiento</th>
                        <th>Comentarios</th>
                        <th>Fecha</th>
                        <th>No Factura</th>
                        <th>Producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seguimiento as $item)
                    <tr>
                        <td scope="row">{{ $item->id }}</td>
                        <td>{{ $item->cliente }}</td>
                        <td>{{ $item->vendedor }}</td>
                        <td>{{ $item->seguimiento }}</td>
                        <td>{{ $item->comentarios }}</td>
                        <td>{{ $item->fecha }}</td>
                        <td>{{ $item->no_factura }}</td>
                        <td>{{ $item->id_prod }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="modalseguimiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title">Agregar seguimiento</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {!!Form::open(array('url'=>'registrar_seguimiento','method'=>'POST','autocomplete'=>'off','id_cot'=>$id_cot))!!}
                {{Form::token()}}
                    <input type="hidden" value="{{ $id_cot }}" name="id_cot">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                            <label for="tipo_seguimiento">Seguimiento</label>
                            <select class="form-control" name="tipo_seguimiento">
                                <option value="">Seleccionar</option>
                                <option value="1era Llamada - Confirmación de cotización">1era Llamada - Confirmación de cotización</option>
                                <option value="2da Llamada - Respuesta de cotización">2da Llamada - Respuesta de cotización</option>
                                <option value="3ra Llamada - Cierre de venta">3ra Llamada - Cierre de venta</option>
                                <option value="Seguimiento Adicional">Seguimiento Adicional</option>
                            </select>                            
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <label for="comentarios">Comentarios</label>
                        <input type="text" name="comentarios" class="form-control" placeholder="Agrega los comentarios de la llamada">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" class="form-control">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label for="no_factura">No. Factura</label>
                        <input type="text" name="no_factura" class="form-control" placeholder="Ingresa No de factura">
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <label for="producto">Producto</label>
                        <input type="text" name="producto" class="form-control" placeholder="Ingresa producto vendido">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
                    {!!Form::close()!!}
    </div>
</div>
  

      
@endsection
