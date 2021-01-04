@extends('layouts.admin')

@section('content')
 <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Reportes</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
          <li class="breadcrumb-item active">Reportes</li>
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
	            <h3>Generar</h3>

	            <p>Nuevo reporte</p>
	          </div>
	          <div class="icon">
	           <i class="fas fa-pen-square"></i>
	          </div>
	          <a href="/nuevo" class="small-box-footer">
	            Click aquí <i class="fas fa-arrow-circle-right"></i>
	          </a>
	        </div>
	      </div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<hr>
			<div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" id="reportes">
                	<thead>
                		@if(Auth::user()->hasRole('admin'))
	                		<tr>
	                			<th>Fechas</th>
	                			<th></th>
	                			<th>Ver</th>
	                			<th>Generar PDF</th>
	                			<th>Eliminar</th>
	                		</tr>
	                	@else
	                		<tr>
	                			<th>Fechas</th>
	                			<th></th>
	                			<th>Ver</th>
	                			<th>Generar PDF</th>
	                		</tr>
	                	@endif
                	</thead>
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
	            $('#reportes').DataTable({
	                "processing": true,
	                "serverSide": true,
	                "autoWidth": false,
	                "ajax": "api/reportes",
	                "columns": [
	                    {data:'fecha1'},
	                    {data:'fecha2'},
                      	{data:'ver',orderable:false, searchable:false },
	                    {data: 'pdf',orderable:false, searchable:false },
	                    {data:'delete',orderable:false,searchable:false}
	                ]
	            });
	        } );
	    </script>
	@else
	@endif
@endsection