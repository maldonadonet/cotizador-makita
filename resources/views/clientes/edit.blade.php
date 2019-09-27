@extends ('layout/admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Modificar datos de cliente</h3>
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

    {!!Form::model($cliente,['method'=>'PUT','route'=>['clientes.update',$cliente->id]])!!}
    {{Form::token()}}

      <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{ $cliente->nombre}}" class="form-control" placeholder="Nombre..">
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="{{$cliente->direccion}}" class="form-control" placeholder="Dirección fiscal">
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" value="{{$cliente->telefono}}" class="form-control" placeholder="No de telefono personal">
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="{{$cliente->email}}" class="form-control" placeholder="Correo electronico">
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="atencion">Atención</label>
              <input type="text" name="atencion" value="{{$cliente->atencion}}" class="form-control" placeholder="Persona de contacto con el cliente">
            </div>
        </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" name="rfc" value="{{$cliente->rfc}}" class="form-control" placeholder="RFC..">
              </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="razon_social">Razón social</label>
                <input type="text" name="razon_social" value="{{$cliente->razon_social}}" class="form-control" placeholder="Razón social..">
              </div>
          </div>

          @if(Auth::user()->tipo_usuario == 'admin')
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                  <label>Vendedor asignado</label>
                  <select class="form-control" name="vendedor">
                      <option value="{{$vendedor->id}}">{{$vendedor->nombre}}</option>
                      @foreach ($vendedores as $ven)
                          <<option value="{{$ven->id}}">{{$ven->nombre}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
          @endif
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Guardar</button>
              <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
          </div>
      </div>

      {!!Form::close()!!}
@endsection
