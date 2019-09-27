<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistema de pedidos | Artículos Innovadores Leo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100" style="box-shadow: 2px 2px 15px #000; border-radius: 10px; padding: 20px;">
            {!!Form::open(array('url'=>'pedidos_post','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <form class="form-control">
				<span class="contact100-form-title">
					Sistema de pedidos | Artículos Innovadores leo.
                </span>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center mb-3">
                        <h4>Datos del cliente</h4>
                    </div>
                </div>
                <hr>
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre">Nombre Cliente/Razón social *</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre completo o razón social." required>
                            </div>
                        </div>
        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dir-fiscal">Dirección Fiscal *</label>
                                <input type="text" id="dir_fiscal" name="dir-fiscal" class="form-control" placeholder="Dirección fiscal registrada | Dato para facturación." required>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dir-entrega">Dirección de entrega *</label>
                                <input type="text" id="dir_entrega" name="dir_entrega" class="form-control" placeholder="Favor de indicar la dirección de entrega del material." required>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono">Teléfono *</label>
                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Teléfono de contacto principal." required>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Correo electrónico *</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico de contacto." required>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rfc">RFC | Dato requerido para facturación *</label>
                                <input type="text" id="rfc" name="rfc" class="form-control" placeholder="Dirección fiscal registrada | Dato para facturación." required>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="horario_entrega">Horario de entrega</label>
                                <input type="text" id="horario_entrega" name="horario_entrega" class="form-control" placeholder="Indique horario de entrega preferente..">
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="forma_pago">Forma de pago</label>
                                <select name="forma_pago" id="" class="form-control">
                                    <option value="">Selecciona una opción</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Deposito">Deposito</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                        </div>
    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="recepcion">Persona que recibe</label>
                                <input type="text" name="recepcion" class="form-control" placeholder="Indique persona que recibe material.">
                            </div>
                        </div>
                </div>
                <hr>
                <div class="row">
                        <div class="col-md-12 text-center mb-3">
                            <h2>Datos del pedido</h2>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="modelo">Modelo *</label>
                                <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo del producto requerido.">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cantidad">Cantidad *</label>
                                <input type="text" id="cantidad" name="cantidad" class="form-control" placeholder="Cantidad de productos requeridos.">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Acción</label><br>
                                <a href="#" class="btn btn-info btn-block" id="bt_add">Agregar</a>
                            </div>
                        </div>
                    
                </div>

                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#a9d0f5">
                                <th>Operaciones</th>
                                <th>Modelo</th>
                                <th>Cantidad</th>
                            </thead>
                            <tfoot>
                                <th>Partida</th>
                                <th></th>
                                <th></th>                                
                            </tfoot>
                            <tbody>
        
                            </tbody>
                        </table>
                    </div>
        
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
			</form>

		</div>
	</div>



	<div id="dropDownSelect1"></div>

    {!!Form::close()!!}

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>

{{--  --}}
 <!--Codigo JavaScript-->

 <script>
     $(document).ready(function(){
         $("#guardar").hide();
         $("#bt_add").click(function(){
             agregar();
         });
     });

     var cont=0;
     total=0;
     subtotal=[]; //array para cada detalle del ingreso
     
     //funcion agregar
     function agregar(){
         modelo = $("#modelo").val();
         cantidad=$("#cantidad").val();

     //Validamos que no esten vacios los campos
     if(modelo!="" && cantidad!="" && cantidad>0 )
     {
        
         var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input hidden name="modelo[]" value="'+modelo+'">'+modelo+'</td><td><input hidden name="cantidad[]" value="'+cantidad+'">'+cantidad+'</td></tr>;'
         cont++;
         limpiar();
         $("#total").html("S/."+ total);
         evaluar();
         $('#detalles').append(fila);
     }
     else
     {
         alert ("Error al ingresar el detalle del ingreso, revise los datos del articulo");
     }
     }


 //funcion para limpiar el formulario
     function limpiar(){
         $("#modelo").val("");
         $("#cantidad").val("");
     }

     //Funcion para verificar si no tengo ningun detalle en la tabla voy a ocultar los botones de guardar
     function evaluar(){
         if(modelo){
             $("#guardar").show();
         }else{
             $("#guardar").hide();
         }
     }

     //Funcion para eliminar cada detalle de ingreso
     function eliminar(index){
         total=total-subtotal[index];
         $("#total").html("$/. " + total);
         $("#fila" + index).remove();
         evaluar();
     }
 </script>
 





</body>
</html>
