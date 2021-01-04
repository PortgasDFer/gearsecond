@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Reporte de ganancias</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="row justify-content-center">
  <div class="col-md-12">
  <div class="col justify-content-center">
    <div class="table-responsive">
      <table class="table">
        <td><input type="hidden" class="form-control" id=""></td>
           <thead class="table-light">
            <form action="/generar" method="POST">
              @csrf
              <th scope="col">De Primera Fecha</th>
              <th scope="col"><input type="date" class="form-control" name="fecha1"></th>
              <th scope="col">Hasta Segunda Fecha</th>
              <th scope="col"><input type="date" class="form-control" name="fecha2"></th>
              <th scope="col"><button type="submit" class="btn btn-primary">Calcular</button></th>
            </form>
           </thead>
       </table>
      </div>
</div>
<h4>Visualizacion de Resultados de ganacias</h4>


<BR>
 <form action="" method="POST">
  @csrf
<div class="col justify-content-center">
                               <div class="table-responsive">
                                   <table class="table">
                                    <td><input type="hidden" class="form-control" id=""></td>
                                       <thead class="table-light">
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Descripcion</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col"> Total Compra</th>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <td>
                                                
                                               </td>
                                               <td>
                                                </td>
                                               <td>
                                               <td></td>
                                               <td><button class="btn btn-primary">Crear PDF</button></td> 
                                           
                                       </tbody>
                                   </table>
                                   
                               </div>
                           </div>
<input type="text" class="form-control"  placeholder="Total en dinero de todos los productos vendidos" id="">                 
</form>

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
                       
                        <input type="text" readonly  id="staticEmail2" name="folio" class="form-control" value="">
                       
                    </div>
                    <div class="form-group mb-2">
                        <label for="staticEmail2">PRECIO $&nbsp;</label>
                        <input type="text"   id="staticEmail2" name="precio" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label for="staticEmail2">CANTIDAD 2&nbsp;</label>
                        <input type="text"   id="staticEmail2" name="cantidad2" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label for="staticEmail2">CANTIDAD&nbsp;</label>
                        <input type="text"   id="staticEmail2" name="cantidad" class="form-control">
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
