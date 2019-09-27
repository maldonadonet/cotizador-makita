@extends ('layout/admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h3>Relación de cotizaciones</h3>
      @include('cotizaciones.search')
  </div>
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="">

  </div>
</div>

<!--  -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Id</th>
            <th>Cliente</th>
            <th>Id Cliente</th>
            <th>Email</th>
            <th>Vendedor</th>
            <th>Id Vendedor</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Folio</th>
            <th>Operaciones</th>
        </thead>

        @foreach ($cotizaciones as $cot)
        <tr>
            <td>{{ $cot->id }}</td>
            <td>{{ $cot->cliente }}</td>
            <td>{{ $cot->id_cliente }}</td>
            <td>{{ $cot->email }}</td>
            <td>{{ $cot->vendedor }}</td>
            <td>{{ $cot->id_vendedor }}</td>
            <th>{{ $cot->fecha}}</th>
            <th>$ {{ number_format($cot->total, 2, '.', ',')}}</th>
            <th>{{ $cot->folio}}</th>
            <td>
                <a href="{{URL::action('CotizacionesController@show',$cot->id)}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                <a href="{{URL::action('CotizacionesController@imprimir',['id_vendedor'=>$cot->id_vendedor,'id_cliente'=>$cot->id_cliente,'id_cotizacion'=>$cot->id,'fecha'=>$cot->fecha])}}"><button class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i></button></a>
                <a href="{{URL::action('CotizacionesController@enviar',['id_vendedor'=>$cot->id_vendedor,'id_cliente'=>$cot->id_cliente,'id_cotizacion'=>$cot->id,'fecha'=>$cot->fecha])}}"><button class="btn btn-success"><i class="fa fa-envelope" aria-hidden="true"></i></button></a>
            </td>
        </tr>
      @endforeach
  </table>
</div>
{{$cotizaciones->render()}}
</div>
</div>
@stop
