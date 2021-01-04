@extends('layouts.admin')
@section('title','Ventas')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Ventas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Generar</h3>

                <p>Nota de venta</p>
              </div>
              <div class="icon">
               <i class="fas fa-pen-square"></i>
              </div>
              <a href="venta/create" class="small-box-footer">
                Click aquí <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12"> 
            <div class="card">  
                    <div class="card-header">   
                        Seguimiento de ventas
                    </div>
                    <div class="card-header">	    
                    </div>
                    <div class="card-body">	
    					<div class="table-responsive">	 
                            <table class="table"  id="ventas" width="100%">
    						    <thead class="thead-light">
                                    @if(Auth::user()->hasRole('admin'))
                                        <tr>
                                            <th scope="col">Folio</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col" >Eliminar</th>
                                            <th scope="col">Generar PDF</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th scope="col">Folio</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Generar PDF</th>
                                        </tr>
                                    @endif
    			  				</thead>	
    						</table>
                        </div>
                    </div>
            </div>
        </div>   
    </div>
</div>
@endsection
@section('script')
    @if(Auth::user()->hasRole('admin'))
        <script>
            $(document).ready( function () {
                $('#ventas').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "api/ventas",
                    "columns": [
                        {data:'folio'},
                        {data:'fecha'},
                        {data:'eliminar',orderable:false, searchable:false },
                        {data: 'pdf',orderable:false, searchable:false }
                    ]
                });
            } );
        </script>
    @else
        <script>
            $(document).ready( function () {
                $('#ventas').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "api/venta",
                    "columns": [
                        {data:'folio'},
                        {data:'fecha'},
                        {data: 'pdf',orderable:false, searchable:false }
                    ]
                });
            } );
        </script>
    @endif
@endsection