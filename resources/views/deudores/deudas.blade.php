@extends('layouts.admin')
@section('title','Deudas')
@section('content')
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Deudas de: {{$deudor->nombre}} {{$deudor->apellidos}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
              <li class="breadcrumb-item"><a href="/deudores">Lista de deudores</a></li>
              <li class="breadcrumb-item active">Deudas de: {{$deudor->nombre}} {{$deudor->apellidos}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->
  <div class="container-fluid">
    <div class="table-responsive">
      <table class="table table-bordered">
         <thead class="thead-dark">
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Folio</th>
            <th scope="col">Monto</th>
            <th scope="col">Revisar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>
        <tbody> 
            @foreach($deudas as $d)
                <tr>  
                    <td>{{$d->fecha}}</td>
                    <td>{{$d->folio}}</td>
                    <td>{{$d->monto}}</td>
                    <td> <a href="/venta/{{$d->folio}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
                    <td><form method="POST" action="/deuda/{{$d->id_deudor}}">
                                @method('DELETE')
                                @csrf
                               <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form> </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

