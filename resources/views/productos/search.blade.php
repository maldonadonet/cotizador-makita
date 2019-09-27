{!! Form::open(array('url'=>'productos','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Introduce producto a buscar" value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group badge">    
            <label for="categoria" style="margin-right: 5px; font-size:1.4em;" class="text-info text-capitalize">Herramientas</label> 
            <input type="checkbox" name="categoria" value="Maquinaria">
            <span style="margin-right: 10px;"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">    
            <label for="categoria" style="margin-right: 5px; font-size:1.4em;" class="text-info text-capitalize">Accesorios</label> 
            <input type="checkbox" name="categoria" value="Accesorios">
            <span style="margin-right: 10px;"></span>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">    
            <label for="categoria" style="margin-right: 5px; font-size:1.4em;" class="text-info text-capitalize">Refacciones</label> 
            <input type="checkbox" name="categoria" value="Refacciones">
            <span style="margin-right: 10px;"></span>
        </div>
    </div>
</div>
{{Form::close()}}




