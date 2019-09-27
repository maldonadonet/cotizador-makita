<div class="modal fade modal-slide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-{{$pro->id}}">
  {{Form::open(array('action'=>array('ProductosController@modificarcant',$pro->id),'method'=>'post'))}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">x</span>
                </button>
                <h4 class="modal-title">Correguir cantidad de producto</h4>
            </div>
            <div class="modal-body">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" class="form-control">
                <input type="hidden" name="id" value="{{$pro->id}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
  {{Form::Close()}}
</div>
