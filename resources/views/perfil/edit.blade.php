@extends ('layout/admin')
@section ('contenido')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3>Editar perfil de usurio</h3>
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

{!!Form::model($user,['method'=>'PUT','route'=>['perfil.update',$user->id],'files'=>'true'])!!}
{{Form::token()}}

<div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Nombre completo">
        </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Correo institucional AIL">
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="passowrd">Contraseña</label>
          <input type="passowrd" name="password" value="" class="form-control" placeholder="Contraseña de acceso">
        </div>
    </div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="image">Foto de perdil</label>
          <input type="file" name="image" class="form-control">
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

@stop