@extends ('layout/admin')
@section ('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar vendedor: {{ $vendedor->nombre }}</h3>
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

    {!!Form::model($vendedor,['method'=>'PUT','route'=>['vendedores.update',$vendedor->id]])!!}
    {{Form::token()}}
    
    <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" required value="{{$vendedor->nombre}}" class="form-control" placeholder="Nombre..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" value="{{$vendedor->direccion}}" class="form-control" placeholder="Dirección..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="telefono">Télefono</label>
                <input type="tel" name="telefono" value="{{$vendedor->tel}}" class="form-control" placeholder="Télefono..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" value="{{$vendedor->email}}" class="form-control" placeholder="Email..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" value="{{$vendedor->password}}" class="form-control" placeholder="Contraseña..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="area">Área</label>
                <input type="text" name="area" value="{{$vendedor->area}}" class="form-control" placeholder="Dirección..">
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

