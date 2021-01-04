@extends('layouts.admin')
@section('title','Realizar una venta')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Realizar una venta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/venta">Ventas</a></li>
              <li class="breadcrumb-item active">Realizar una nota</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">   
                    <form class="form-inline" action="/venta" method="POST">
                        @method('POST')
                         @csrf
                        <div class="form-group mb-2">
                            <label for="staticEmail2">FOLIO&nbsp;</label>
                            <input type="text" readonly  id="staticEmail2" name="folio" class="form-control" value="{{$siguientefolio}}">
                        </div>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                         <div class="form-group mb-2">
                            <label for="fecha">Fecha&nbsp;</label>
                            <input type="date"  readonly value="{{$fechaactual}}" class="form-control" name="fecha">
                        </div>
                        &nbsp;
                        &nbsp;
                        &nbsp;
                        <button type="submit" class="btn btn-primary mb-2">Agregar productos</button>
                    </form>
                </div>
                <div class="card-body">
                        <form action="  " method="POST">
                                
                        </form>      
                </div>
                <div class="card-body">
                       <div class="row">
                           <div class="col justify-content-center">
                               <center><img src="/img/Spinner-1s-200px.gif" alt="" style="width: 100px"></center> 
                           </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
@endsection

