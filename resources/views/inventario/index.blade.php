@extends('layouts.admin')
@section('title','Inventario')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Inventario</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Inventario</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
	<div class="row justify-content-center">
		<div class="col-md-6"> 
            <div class="card">  
                    <div class="card-header bg-success">   
                        Todos los productos
                    </div>
                    <div class="card-body">	
    					<div class="table-responsive">
		                    <table class="table" id="productos" width="100%">
		                        <thead>
		                            <tr>
		                                <th>Código de barras</th>
		                                <th>descripción</th>
		                                <th>Total</th>
                                        <th></th>
		                                <th>Registrar</th>
		                            </tr>
		                        </thead>
		                    </table>
		                </div> 
                    </div>
            </div>
        </div>
        <div class="col-md-6">	
			<div class="card">	
				<div class="card-header bg-warning">
						Productos urgentes	
				</div>
				<div class="card-body">
					<div class="table-responsive">
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
		                    </table>
		                </div> 
				</div>
			</div>
        </div>
	</div>
@endsection
@section('datatable')
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
                        {data:'total'},
                        {data:'unidad',orderable:false, searchable:false},
                        {data: 'btnadd',orderable:false, searchable:false }
                    ]
                });
            } );
    </script>
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
