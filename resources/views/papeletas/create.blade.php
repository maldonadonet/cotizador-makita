@extends ('layout/admin')
@section ('contenido')
      <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <h3>Agregar Papeleta</h3>
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

      {!!Form::open(array('url'=>'papeletas','method'=>'POST','autocomplete'=>'off'))!!}
      {{Form::token()}}

      <div class="row">
          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="empresa">Empresa</label>
                <input type="text" name="empresa" required value="{{old('empresa')}}" class="form-control" placeholder="Empresa/Razón Social">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre completo..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="email">Correo</label>
                <input type="tel" name="email" value="{{old('email')}}" class="form-control" placeholder="Correo electronico..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Telefono con lada..">
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="producto">Producto</label>
                <textarea name="producto" cols="30" rows="10" class="form-control"></textarea>
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="marca">Marca</label><br>
                <input type="radio" name="marca" class="form-check-input" value="3m">
                <label class="form-check-label" for="exampleRadios2">
                  3M
                </label>
                <input type="radio" name="marca" class="form-check-input" value="sika">
                <label class="form-check-label" for="exampleRadios2">
                  SIKA
                </label>
                <input type="radio" name="marca" class="form-check-input" value="makita">
                <label class="form-check-label" for="exampleRadios2">
                  MAKITA
                </label>
                <input type="radio" name="marca" class="form-check-input" value="mapei">
                <label class="form-check-label" for="exampleRadios2">
                  MAPEI
                </label>
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="cliente_nuevo">¿Cliente nuevo?</label><br>
                <input type="radio" name="cliente_nuevo" class="form-check-input" value="si">
                <label class="form-check-label" for="exampleRadios2">
                  Si
                </label>
                <input type="radio" name="cliente_nuevo" class="form-check-input" value="no">
                <label class="form-check-label" for="exampleRadios2">
                  No
                </label>
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="contacto">Medio de contacto</label><br>
                <input type="radio" name="contacto"  class="form-check-input" value="Facebook">
                <label class="form-check-label" for="exampleRadios2">
                  Facebook
                </label>
                <input type="radio" name="contacto"  class="form-check-input" value="Google">
                <label class="form-check-label" for="exampleRadios2">
                  Google
                </label>
                <input type="radio" name="contacto"  class="form-check-input" value="AIL">
                <label class="form-check-label" for="exampleRadios2">
                  AIL
                </label>
                <input type="radio" name="contacto"  class="form-check-input" value="Twitter">
                <label class="form-check-label" for="exampleRadios2">
                  Twitter
                </label>
                <input type="radio" name="contacto"  class="form-check-input" value="Instagram">
                <label class="form-check-label" for="exampleRadios2">
                  Instagram
                </label>
                <input type="radio" name="contacto"  class="form-check-input" value="Linkedin">
                <label class="form-check-label" for="exampleRadios2">
                  Linkedin
                </label>
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
