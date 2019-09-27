@extends ('layout/admin')
@section ('contenido')

<div class="container-fluid">
	<div class="row text-center">
		<h1>Artículos Innovadores Leo</h1>
		<h2>Perfil de usuario</h2>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-4 col-lg-4">
			<img src="{{ asset('img/users/'.$usuario->image)}}" class="img img-responsive img-circle text-center" style="width: 250px; height: 250px; margin-bottom: 25px;">
		</div>
		<div class="col-sm-12 col-md-8 col-lg-8">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>Campos</th>
						<th>Datos</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Id</th>
						<th>{{$usuario->id}}</th>
					</tr>
					<tr>
						<th>Nombre</th>
						<th>{{$usuario->name}}</th>
					</tr>
					<tr>
						<th>Email</th>
						<th>{{$usuario->email}}</th>
					</tr>
					<tr>
						<th>Tipo de usuario</th>
						<th>{{$usuario->tipo_usuario}}</th>
					</tr>
				</tbody>
			</table>
			<a href="{{URL::action('PerfilController@edit',$usuario->id)}}" class="btn btn-info">Actualizar</a>
		</div>
	</div>
</div>


@stop