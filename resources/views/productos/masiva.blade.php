@extends('layouts.admin')
@section('title','Alta masiva de productos')
@section('content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Alta masiva de productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/producto">Productos</a></li>
              <li class="breadcrumb-item active">Alta masiva de productos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <a download="plantilla_productos.xlsx" href="/layoutsexcel/plantilla_productos.xlsx">
            <div class="col-lg-3 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>Alta masiva</h3>

                    <p>Descarga la plantilla</p>
                  </div>
                  <div class="icon">
                   <i class="fa fa-download" aria-hidden="true"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                   Haciendo click aquí <i class="fas fa-arrow-circle-right"></i>
                  </a>
                </div>
            </div>
        </a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"> 
                    <center>Cargar productos desde Excel</center>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                      Recuerde subir un archivo con registros
                    </div>
                    <form method="POST" action="/altamasiva" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Archivo .xls</label>
                            <div class="col-md-6">
                                <input type="file" name="productos"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   <i class="fa fa-upload" aria-hidden="true"></i> Cargar productos
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
                         