@extends('layouts.admin')
@section('content')
@section('title','Registrar producto')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registrar producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/producto">Productos</a></li>
              <li class="breadcrumb-item active">Registrar producto</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center>Registrar producto</center></div>
                <div class="card-body">
                    <form method="post" action="/producto" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Código de barras</label>
                            <div class="col-md-6">
                                <input id="codebar" type="text" class="form-control" name="codebar" required autofocus>
                            </div>
                        </div>
                    	<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control" name="desc" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Unidad de medida</label>
                            <div class="col-md-6">
                                <select class="form-control"  id="medida" name="unidad">
                                    <option value=""> Seleccione una unidad de medida </option>
                                    <option value="Pza">Pieza</option>
                                    <option value="Gr">Gramos</option>
                                    <option value="Kg">Kilogramos</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Existencia</label>
                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control" name="total" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Precio de compra</label>
                            <div class="col-md-6">
                                <input id="pcompra" type="text" class="form-control" name="pcompra" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Precio de venta</label>
                            <div class="col-md-6">
                                <input id="ml" type="text" class="form-control" name="pventa" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Filtro Inventario</label>
                            <div class="col-md-6">
                                <input id="filtro" type="text" class="form-control" name="filtro" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Foto del producto</label>
                            <div class="col-md-6">
                                <input type="file" name="foto"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
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