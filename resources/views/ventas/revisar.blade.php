@extends('layouts.admin')
@section('title','Revisar nota de ventas')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Revisar una venta</h1>
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
                    <br>
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
                       <a href="/home"><button class="btn btn-success btn-btnblock"> <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Regresar</button></a>
                </div>
            </div>
        </div>
    </div>
      <!--/.Deudor-->
    </div>
@endsection
