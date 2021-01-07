@extends('layouts.admin')
@section('title','Realizar nota de ventas')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Realizar una venta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card">  
                    <div class="card-header">   
                        Datos de la venta: 
                    </div>
            </div>
        </div>   
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">   
                    <form class="form-inline" action="" method="POST">
                        @method('POST')
                         @csrf
                        
                         <div class="form-group mb-2">
                            <label for="staticEmail2">FOLIO&nbsp;</label>
                            <input type="text" readonly  id="staticEmail2" name="folio" class="form-control" value="{{$datos->folio}}">
                        </div>
                         <div class="form-group mx-sm-3 mb-2">
                            <label for="fecha">Fecha&nbsp;</label>
                            <input type="text" class="form-control" name="fecha" value="{{$datos->fecha}}" readonly="">
                        </div>
                    </form>
                </div>
                <div class="card-body">
                        <form action="  " method="POST">
                                
                        </form>      
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"> <i class="fa fa-cart-plus" aria-hidden="true"></i> 		Agregar producto
                    </button>
                    <br>
                    <div class="row">
                      <div class="col">
                        <form action="/insert-ajax" class="form-group" method="POST">
                          @csrf
                          <label for="">Ingrese Código de Barras</label>
                          <input type="text" class="form-control" autofocus name="codebar" id="codebar-insert">
                          <input type="hidden" name="folio" value="{{$datos->folio}}">
                        </form>
                      </div>
                    </div>
                    <hr>
                       <div class="row">
                           <div class="col justify-content-center">
                               <div class="table-responsive">
                                   <table class="table">
                                       <thead class="table-light">
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Precio unitario</th>
                                            <th scope="col">Precio total</th>
                                            <th scope="col">Remover</th>
                                       </thead>
                                       <tbody>
                                           <?php $sum=0.0;?>
                                           @foreach($tabla as $t)
                                           <tr>
                                               <td>{{$t->desc}}</td>
                                               <td>{{$t->cantidad}}</td>
                                               <td>{{$t->unidad}}</td>
                                               <td>${{number_format($t->precio, 2, '.', ',')}}</td>
                                               <td>${{number_format($t->cantidad*$t->precio, 2, '.', ',')}}</td>
                                               <td> 
                                                    <form action="/dvp/{{$t->id}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="folio" value="{{$t->folio}}">
                                                        <input type="hidden" name="codebar" value="{{$t->codebar}}">
                                                        <button class="btn btn-warning" type="submit"><i class="fa fa-minus-square-o" aria-hidden="true"></i></button>
                                                    </form>
                                               </td>
                                           </tr>
                                           <?php $sum+= $t->precio*$t->cantidad;?>
                                           @endforeach
                                           <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td style="text-align: right;">TOTAL </td>
                                            <td>${{number_format($sum, 2, '.', ',')}}</td>
                                            <td></td>
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                       <a href="/indexventas/"><button class="btn btn-success btn-btnblock"> <i class="fa fa-money" aria-hidden="true"></i> Finalizar venta</button></a>
                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fa fa-id-card" aria-hidden="true"></i> Venta con deuda</button>
                </div>
            </div>
        </div>
    </div>
   
    <div class="modal fade bd-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="/dvp" method="POST" name="producto" id="agregar">
                    @csrf
                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Folio</label>
                      <div class="col-md-6">
                          <input id="codebar" type="text"  class="form-control" value="{{$datos->folio}}" disabled="">
                          <input type="hidden" name="folio" value="{{$datos->folio}}">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Código de barras</label>
                      <div class="col-md-6">
                          <input type="text"   id="codebar" name="codebar" class="form-control" autofocus="" onchange="obtener_datos(this.value)">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Nombre del producto</label>
                      <div class="col-md-6">
                        <strong><div id="nombre"></div></strong>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Imagen del producto</label>
                      <div class="col-md-6">
                          <img src="/productosimg/blocks.gif" id="myimage"/ class="img-fluid img-thumbnail">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Precio</label>
                      <div class="col-md-6">
                          <input type="text"   id="precio" name="precio" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Unidad de medida</label>
                      <div class="col-md-6">
                        <select class="form-control"  id="medida" name="unidad">
                              <option value="" id="medida"> Seleccione una unidad de medida </option>
                              <option value="Pza">Pieza</option>
                              <option value="Gr">Gramos</option>
                              <option value="Kg">Kilogramos</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="name" class="col-md-4 col-form-label text-md-right">Cantidad</label>
                      <div class="col-md-6">
                          <input type="text"   id="staticEmail2" name="cantidad" class="form-control">
                      </div>
                    </div>
                    <!--
                    <div class="form-group mb-2">
                        <label for="staticEmail2">PRODUCTO&nbsp;</label>
                            <select id="idcliente" name="codebar" class="js-example-basic-single" style="width: 100%">
                                <option value="0">Buscar producto</option>
                                @foreach($productos as $p)
                                    <option value="{{$p->codebar}}">{{$p->codebar}} - {{$p->desc}}</option>
                                @endforeach
                            </select>
                    </div>
                    -->

                    <div class="form-group row">
                     <label for="name" class="col-md-4 col-form-label text-md-right">Confirmar</label>
                     <div class="col-md-6">
                       <input type="submit" class="btn btn-success btn-block" value="Agregar">
                     </div>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Deudor-->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">ASIGNAR DEUDOR</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/asignarDeudor" method="POST">
                @csrf
                <div class="form-group mb-2">
                  <label for="staticEmail2">FOLIO&nbsp;</label>
                  <input type="text"   id="staticEmail2" name="mostrar" class="form-control" value="{{$datos->folio}}" disabled="">
                </div>
                <div class="form-group mb-2">
                  <label for="staticEmail2">DEUDOR&nbsp;</label>
                      <input type="hidden" name="folio" value="{{$datos->folio}}">
                        <input type="hidden" name="monto" value="{{$sum}}">
                      <select id="iddeudor" name="id_deudor" class="js-example-placeholder-single  form-control" style="width: 100%">
                        <option value="0">Buscar deudor</option>
                          @foreach($deudores as $d)
                              <option value="{{$d->id}}">{{$d->id}} - {{$d->nombre}} {{$d->apellidos}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group mb-2">  
                    <label for=" Monto">Monto</label>
                    <input type="text"   id="staticEmail2" class="form-control" value="${{number_format($sum, 2, '.', ',')}}" disabled="">
                </div>
                <div class="form-group mb-2">
                  <label for="Button">REGISTRAR</label>
                   <button type="submit" class="btn btn-success form-control btn-btnblock">Guardar cambios</button>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <hr>
              <form action="/nuevoDeudor" method="POST">
                @csrf
                <input type="hidden" name="folio" value="{{$datos->folio}}">
                <button type="submit" class="btn btn-primary">Registre nuevo deudor aquí</button>
              </form>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
      <!--/.Deudor-->
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
      $('.js-example-basic-single').select2({
           width: 'resolve'
      });
      $('#iddeudor').select2({
        dropdownParent: $('#exampleModalCenter')
      });
    });
</script>

<script language="javascript">
   function obtener_datos(codebar) {
      var img = document.getElementById("myimage");
      
      var img_dir = "/productosimg/";
      $.get('/obtenerProducto/' + codebar, function (data) {
        console.log(data);
        if (img) {
          img.src = img_dir+data.foto;
        }
        costo=data.pventa;
        nombre=data.desc;
        unidad=data.unidad;
        document.getElementById('nombre').innerHTML = nombre;
        document.producto.precio.value=costo;
        document.producto.unidad.value=unidad;

      })
    }
</script>
<script language="javascript">
	$("#codebar-insert").keyup(function(){ 
		var codebar=$("#codebar").val()
		var folio=$("#folio").val()
		if(codebar!=""){
			$.ajaxSetup({
		        headers: {
		            "_token": $("meta[name='csrf-token']").attr("content")
		        }
		    });
			$.ajax({
            url: '/insert-ajax',
            type: 'POST',
            data:{ 
            		codebar:codebar,
            		folio:folio
            	},
            dataType: "json",
            cache: false,
            contentType: "application/json",
             success:function(response){
				if(response.success){
				  alert(response.message)
				  location.reload(); //Message come from controller
				}else{
				  alert("Error")
				}
           	},
            error: function (xhr, status) {

            },
        });
		}
	});
</script>
@endsection
