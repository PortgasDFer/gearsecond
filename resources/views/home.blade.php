@extends('layouts.admin')
@section('title','Home')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard - Abarrotes Tungui</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
        <div class="row mt-4">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$numventas}}</h3>

                <p>Ventas</p>
              </div>
              <div class="icon">
                <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
              </div>
              <a href="/venta" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$numdeudas}}</h3>

                <p>Deudas</p>
              </div>
              <div class="icon">
                <i class="fa fa-archive" aria-hidden="true"></i>
              </div>
              <a href="/deuda" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

<div class="row">
    <div class="col-xs-12 col-md-5">
      <!-- TABLE: ventas -->
      <div class="card mt-2">
        <div class="card-header border-transparent bg-success">
          <h3 class="card-title ">Ultimas ventas</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
              <tr>
                <th>Folio</th>
                <th>Fecha</th>
                <th>Revisar</th>
              </tr>
              </thead>
              <tbody>
                @foreach($ventas as $v)
                    <tr>
                        <td>{{$v->folio}}</td>
                        <td>{{$v->fecha}}</td>
                        <td>
                            <a href="/venta/{{$v->folio}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="/venta/create" class="btn btn-sm btn-info float-left">Genera nueva nota de venta</a>
          <a href="/venta" class="btn btn-sm btn-secondary float-right">Ver todas las notas</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>


    <div class="col-xs-12 col-md-7">
      <!-- TABLE: deudas -->
      <div class="card mt-2">
        <div class="card-header border-transparent bg-danger">
          <h3 class="card-title ">Deudas pendientes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table m-0">
              <thead>
              <tr>
                <th>Fecha</th>
                <th>Deudor</th>
                <th>Folio</th>
                <th>Monto</th>
                <th>Revisar</th>
                <th>Eliminar</th>
              </tr>
              </thead>
              <tbody>
                @foreach($deudas as $d)
                    <tr>
                        <td>{{$d->fecha}}</td>
                        <td>{{$d->nombre}} {{$d->apellidos}}</td>
                        <td>{{$d->folio}}</td>
                        <td>${{number_format($d->monto, 2, '.', ',')}}</td>
                        <td>
                            <a href="/venta/{{$d->folio}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        </td>
                        <td>
                            <form method="POST" action="/deuda/{{$d->id}}">
                                @method('DELETE')
                                @csrf
                               <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form> 
                        </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="/deuda" class="btn btn-sm btn-secondary float-right">Ver todas las deudas</a>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-6">
    <div class="card mt-2">
        <div class="card-header border-transparent bg-danger">
          <h3 class="card-title ">Productos urgentes</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive mt-2">
            <table class="table" id="urgentes" width="100%">
              <thead>
                <tr>
                    <th>Código de barras</th>
                    <th>Descripción</th>
                    <th>Existencias</th>
                        <th></th>
                    <th>Registrar</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <a href="/inventario" class="btn btn-sm btn-success float-right">Ver todas las existencias</a>
        </div>
        <!-- /.card-footer -->
      </div>
  </div>
</div>
</div>
@endsection
@section('datatable')
    <script>
            $(document).ready( function () {
                $('#urgentes').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "autoWidth": false,
                    "ajax": "api/urgentes",
                    "columns": [
                        {data:'codebar'},
                        {data:'desc'},
                        {data:'total'},
                        {data:'unidad',orderable:false, searchable:false},
                        {data: 'btnadd',orderable:false, searchable:false }
                    ]
                });
            } );
    </script>
@endsection
