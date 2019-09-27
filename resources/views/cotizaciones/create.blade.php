@extends ('layout/admin')
@section ('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Alta de producto</h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

{!!Form::open(array('url'=>'productos','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}

<div class="row">
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" name="modelo" required value="{{old('modelo')}}" class="form-control" placeholder="Ingrese Modelo del producto">
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
            <label for="proveedor">Tipo</label>
            <select class="form-control" name="tipo">
                <option value="Maquinaria">Maquinaría</option>
                <option value="Accesorios">Accesorios</option>
                <option value="Refacciones">Refacciones</option>
            </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="isbn">ISBN</label>
          <input type="text" name="isbn" value="{{old('isbn')}}" class="form-control" placeholder="No ISBN">
      </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="caja_master">Caja Master</label>
          <input type="text" name="caja_master" value="{{old('caja_master')}}" class="form-control" placeholder="Caja Master">
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="unidad">Unidad</label>
          <select name="unidad" class="form-control">
              <option value="Pieza">Pieza</option>
              <option value="Caja">Caja</option>
          </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="moneda">Moneda</label>
          <select name="moneda" class="form-control">
              <option value="MXN">MXN</option>
              <option value="USD">USD</option>
          </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="estatus">Estatus</label>
          <select name="estatus" class="form-control">
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
          </select>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
        <div class="form-group">
          <label for="precio_compra">Precio Compra</label>
          <input type="text" name="precio_compra" required value="{{old('precio_compra')}}" class="form-control" placeholder="Precio de compra del producto">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="precio_unitario">Precio Unitario</label>
          <input type="text" name="precio_unitario" required value="{{old('precio_unitario')}}" class="form-control" placeholder="Precio unitario/venta">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="precio_venta">Precio Venta</label>
          <input type="text" name="precio_venta" required value="{{old('precio_venta')}}" class="form-control" placeholder="Precio unitario/venta">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="cod_ant">Código Anterior</label>
          <input type="text" name="cod_ant" value="{{old('cod_ant')}}" class="form-control" placeholder="Codigo anterior del producto">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="alterno">Alterno</label>
          <input type="text" name="alterno" value="{{old('alterno')}}" class="form-control" placeholder="No Alterno">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="cod_sat">Código del SAT</label>
          <input type="text" name="cod_sat" value="{{old('cod_sat')}}" class="form-control" placeholder="Código del SAT">
        </div>
    </div>

    <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="puntos">Puntos de promoción</label>
          <input type="text" name="puntos" value="{{old('puntos')}}" class="form-control" placeholder="Indicar la cantidad de puntos a este producto">
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" rows="4" style="width: 100%;"></textarea>
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </div>

</div>


{!!Form::close()!!}
@endsection
