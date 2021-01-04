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
          <td>REPORTE DE GANANCIAS</td>
             <thead class="table-light">
                <th scope="col">De Primera Fecha</th>
                <th scope="col"><input type="date" class="form-control" name="fecha1" value="{{$de}}" disabled=""></th>
                <th scope="col">Hasta Segunda Fecha</th>
                <th scope="col"><input type="date" class="form-control" name="fecha2" value="{{$a}}" disabled=""></th>
             </thead>
         </table>
        </div>
      </div>
    <h4>Visualizacion de Resultados de ganacias</h4>
      @csrf
      <div class="col justify-content-center">
       <div class="table-responsive">
           <table class="table">
             <thead class="table-light">
                <th scope="col">Fecha</th>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total Compra</th>
             </thead>
             <tbody>
              <?php
                $dinero=0.0;
              ?>
              @foreach($reporte as $r)
                <tr>
                  <td>{{$r->fecha}}</td>
                  <td>{{$r->desc}}</td>
                  <td>{{$r->cantidad}} {{$r->unidad}}</td>
                  <td style="text-align: right;">${{number_format($r->precio, 2, '.', ',')}}</td>
                </tr>
                <?php
                  $dinero+=$r->precio;
                ?>
              @endforeach
             </tbody>
           </table>
           
       </div>
      </div>
    </div>
    <div class="col-md-6"><h4 style="text-align: right;">Total en dinero de todos los productos vendidos</h4></div>
    <div class="col-md-6"><input type="text" class="form-control"  disabled="" value="${{number_format($dinero, 2, '.', ',')}}" style="text-align: right;"></div>
</div>                 
<div class="container-fluid mt-5">
  <div class="col justify-content-center">
  <h2>Descuentos</h2>
    <div class="table-responsive">
      <table class="table">
        <td><input type="hidden" class="form-control" id=""></td>
           <thead class="table-light">
                <th scope="col">Concepto</th>
                <th scope="col">Monto Descuento</th>
           </thead>
           <tbody>
            <?php
                $descuento=0.0;
              ?>
              @foreach($descuentos as $d)
                  <tr>
                    <td>{{$d->concepto}}</td>
                    <td style="text-align: right;">$ {{number_format($d->monto, 2, '.', ',')}}</td>
                    <?php
                      $descuento+=$d->monto;
                    ?>
                  </tr>
                @endforeach
           </tbody>
      </table> 
    </div>
  </div>
  <div class="row mt-3"> 
    <div class="col-md-6"><h4 style="text-align: right;">Total descuentos</h4></div>
    <div class="col-md-6"><input type="text" class="form-control"  disabled="" value="${{number_format($descuento, 2, '.', ',')}}" style="text-align: right;"></div>
  </div>
</div>
<div class="container-fluid mt-4">
  <div class="row">
    <div class="col-md-6"><h4 style="text-align: right;">GANANCIA NETA</h4></div>
    <div class="col-md-6"><input type="text" class="form-control"  disabled="" value="${{number_format($dinero-$descuento, 2, '.', ',')}}" style="text-align: right;"></div>
  </div>
</div>
<div class="container-fluid mt-5"> 
  <div class="row"> 
    <div class="col justify-content-center">
      <center><a href="/generarpdf/{{$idreporte}}"><button class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> GENERAR PDF </button></a></center>
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
