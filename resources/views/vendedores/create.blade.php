@extends ('layout/admin')
@section ('contenido')
      <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <h3>Agregar vendedor</h3>
              <!--Si existe algun error muestra el div con la lista de errores-->
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

      {!!Form::open(array('url'=>'vendedores','method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}

      <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Dirección..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="telefono">Télefono</label>
                <input type="tel" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Télefono..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Contraseña..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="area">Área</label>
                <input type="text" name="area" value="{{old('area')}}" class="form-control" placeholder="Dirección..">
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
