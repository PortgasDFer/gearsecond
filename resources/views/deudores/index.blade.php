@extends('layouts.admin')
@section('content')
@section('title','Deudores')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Todos los deudores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Deudores</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Registrar</h3>

                <p>Nuevo deudor</p>
              </div>
              <div class="icon">
               <i class="fas fa-pen-square"></i>
              </div>
              <a href="deudores/create" class="small-box-footer">
                Click aquí <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
    </div>
    <div class="container-fluid mt-2"> 
      <div class="row">
        <div class="col-md-12">
        <hr>
        @if(Auth::user()->hasRole('admin'))    
          <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="deudores">
              <thead> 
                <tr>  
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Revisar deudas</th>
                    <th>Eliminar</th>
                </tr>
              </thead>
            </table>
          </div>
        @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="deudores">
              <thead> 
                <tr>  
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Revisar deudas</th>
                </tr>
              </thead>
            </table>
          </div>
          @endif
        </div>
      </div>
    </div>
@endsection
@section('datatable')
  @if(Auth::user()->hasRole('admin'))
      <script>
          $(document).ready( function () {
              $('#deudores').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "autoWidth": false,
                  "ajax": "api/deudores",
                  "columns": [
                      {data:'nombre'},
                      {data:'apellidos'},
                      {data:'ver'},
                      {data:'delete'}
                  ]
              });
          } );
      </script>
  @else
  <script>
          $(document).ready( function () {
              $('#deudores').DataTable({
                  "processing": true,
                  "serverSide": true,
                  "autoWidth": false,
                  "ajax": "api/deudores",
                  "columns": [
                      {data:'nombre'},
                      {data:'apellidos'},
                      {data:'ver'}
                  ]
              });
          } );
      </script>
  @endif
@endsection