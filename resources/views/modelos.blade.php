<h1>Listado de productos</h1>

<br><br>

<ul>
    @foreach($productos as $pro)
        <li>
            <img src="{{asset('imagenes').'/'.$pro->modelo.'.jpg'}}" class="img-responsive" style="width:100px;"> - {{ $pro->modelo}}
        </li>
    @endforeach
</ul>