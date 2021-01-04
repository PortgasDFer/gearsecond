@extends('layouts.admin')

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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar producto</button>
                    <br>
                    <hr>
                       <div class="row">
                           <div class="col justify-content-center">
                               <div class="table-responsive">
                                   <table class="table">
                                       <thead class="table-light">
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Cantidad 2</th>
                                            <th scope="col">Precio unitario</th>
                                            <th scope="col">Precio total</th>
                                            <th scope="col">Remover</th>
                                       </thead>
                                       <tbody>
                                           @foreach($tabla as $t)
                                           <tr>
                                               <td>{{$t->desc}}</td>
                                               <td>{{$t->cantidad}}</td>
                                               <td>{{$t->cantidad2}}</td>
                                               <td>{{$t->precio}}</td>
                                               <td>{{$t->cantidad*$t->precio}}</td>
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
                                           @endforeach
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
//Realizacion de las pruebas

<div class="col-sm-9">
            <h4 class="m-0 text-dark">Venta de Productos a Granel</h4>
</div><!-- /.col -->
<BR>
 <form action="/granel" method="POST">
  @csrf
<div class="col justify-content-center">
                               <div class="table-responsive">
                                   <table class="table">
                                    <td><input type="hidden" class="form-control" id="id_granel"></td>
                                       <thead class="table-light">
                                            <th scope="col">Producto</th>
                                            <th scope="col">Peso</th>
                                            <th scope="col">Medida</th>
                                            <th scope="col">Precio</th>
                                            <th></th>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <td>
                                                <select class="form-control" id="nombre_granel">
                                                <option value="Huevo">Huevo</option>
                                                <option value="Azucar">Azucar</option>
                                                <option value="Arroz">Arroz</option>
                                                <option value="Queso">Queso</option>
                                                <option value="Jamon">Jamon</option>
                                                </select>                    
                                               </td>
                                               <td>
                                                <input type="text" class="form-control" placeholder="0.0" id="peso"></td>
                                               <td><select class="form-control"  id="medida">
                                                <option value="Huevo">gr</option>
                                                <option value="Azucar">kg</option>
                                                </select></td>
                                               <td><input type="text" class="form-control" placeholder="$ 0.0" id="precio_granel"></td>
                                               <td><button type="submit" class="btn btn-primary" data-toggle="modal">Agregar a la venta</button></td> 
                                               
                                           
                                       </tbody>
                                   </table>
                                   
                               </div>
                           </div>

</form>


<hr>
<hr>


//Fin de pruebas 
<hr>
<hr>

<br>
                       <a href="/indexventas/"><button class="btn btn-success">Finalizar venta</button></a>
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
                <form action="/dvp" method="POST">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="staticEmail2">FOLIO&nbsp;</label>
                       
                        <input type="text" readonly  id="staticEmail2" name="folio" class="form-control" value="{{$datos->folio}}">
                       
                    </div>
                    <div class="form-group mb-2">
                        <label for="staticEmail2">PRODUCTO&nbsp;</label>
                            <select id="idcliente" name="codebar" class="js-example-basic-single" style="width: 100%">
                                <option value="0">Buscar producto</option>
                                @foreach($productos as $p)
                                    <option value="{{$p->codebar}}">{{$p->codebar}} - {{$p->desc}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="staticEmail2">PRECIO $&nbsp;</label>
                        <input type="text"   id="staticEmail2" name="precio" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="staticEmail2">CANTIDAD&nbsp;</label>
                        <input type="text"   id="staticEmail2" name="cantidad2" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label for="staticEmail2">UNIDAD&nbsp;</label>
                          <select class="form-control"  id="medida" name="unidad">
                              <option value=""> Seleccione una unidad de medida </option>
                              <option value="Pza">Pieza</option>
                              <option value="Gr">Gramos</option>
                              <option value="Kg">Kilogramos</option>
                          </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Agregar">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2({
         width: 'resolve'
    });
});
</script>
@endsection
