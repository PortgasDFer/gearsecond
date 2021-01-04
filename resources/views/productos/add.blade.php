@extends('layouts.admin')
@section('title','Entrada de productos')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Entrada de productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/inventario">Inventario</a></li>
              <li class="breadcrumb-item active">Entrada de productos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                	<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Código de barras</label>
                            <div class="col-md-6">
                                <input id="b1" type="text" class="form-control" value="{{$producto->codebar}}" required autofocus disabled="">
                            </div>
                        </div>
                    <div class="form-group row">
                    	<label for="name" class="col-md-4 col-form-label text-md-right">Descripción del producto</label>
                    		<div class="col-md-6">
                                <input id="b1" type="text" class="form-control" value="{{$producto->desc}}" required autofocus disabled="">
                            </div>
                    </div>
                    <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Foto del producto</label>
                            <div class="col-md-6">
                                    <img src="/productosimg/{{$producto->foto}}" style="height: 350px; width: 350px;"/>
                            </div>
                        </div>
                    <form method="post" action="/productoAdd/{{$producto->codebar}}">
                    @csrf
                    @method('PUT')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Cantidad que ingresa</label>
                            <div class="col-md-6">
                                <input id="b1" type="text" class="form-control" name="cantidad" required autofocus>
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

@endsection