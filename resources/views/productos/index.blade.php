@extends('layouts.admin')
@section('content')
@section('title','Productos')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Todos los productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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

                <p>Nuevo producto</p>
              </div>
              <div class="icon">
               <i class="fas fa-pen-square"></i>
              </div>
              <a href="producto/create" class="small-box-footer">
                Click aquí <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Cargar</h3>

                <p>Alta masiva de productos</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-upload"></i>
              </div>
              <a href="/masiva" class="small-box-footer">
                Click aquí <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>    
            <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" id="productos">
                    <thead>
                    	@if(Auth::user()->hasRole('admin'))
	                        <tr>
	                            <th>Código de barras</th>
	                            <th>Descripción</th>
	                            <th>Precio de compra</th>
	                            <th>Precio de venta</th>
	                            <th>Total</th>
                              <th></th>
	                            <th>Editar</th>
	                            <th>Eliminar</th>
	                        </tr>
                        @else
                        	<tr>
	                            <th>Código de barras</th>
	                            <th>Descripción</th>
	                            <th>Precio de compra</th>
	                            <th>Precio de venta</th>
	                            <th>Total</th>
                              <th> </th>
	                            <th>Editar</th>
	                        </tr>
                        @endif
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>    
        </div>
    </div>
</div>
@endsection
@section('datatable')
	@if(Auth::user()->hasRole('admin'))
	    <script>
	        $(document).ready( function () {
	            $('#productos').DataTable({
	                "processing": true,
	                "serverSide": true,
	                "autoWidth": false,
	                "ajax": "api/productos",
	                "columns": [
	                    {data:'codebar'},
	                    {data:'desc'},
	                    {data:'pcompra'},
	                    {data:'pventa'},
	                    {data:'total'},
                      {data:'unidad',orderable:false, searchable:false },
	                    {data: 'btn',orderable:false, searchable:false },
	                    {data: 'btnD',orderable:false, searchable:false }
	                ]
	            });
	        } );
	    </script>
	@else
	<script>
	        $(document).ready( function () {
	            $('#productos').DataTable({
	                "processing": true,
	                "serverSide": true,
	                "autoWidth": false,
	                "ajax": "api/producto",
	                "columns": [
	                    {data:'codebar'},
	                    {data:'desc'},
	                    {data:'pcompra'},
	                    {data:'pventa'},
	                    {data:'total'},
                       {data:'unidad',orderable:false, searchable:false },
	                    {data: 'btn',orderable:false, searchable:false }
	                ]
	            });
	        } );
	    </script>
	@endif
@endsection

