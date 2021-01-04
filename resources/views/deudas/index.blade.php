@extends('layouts.admin')
@section('title','Home')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Deudas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Home</a></li>
              <li class="breadcrumb-item active">Deudas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
      <div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap">
           <thead>
              <tr>
                <th>Fecha</th>
                <th>Deudor</th>
                <th>Folio</th>
                <th>Revisar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
             <tbody>
                @foreach($deudas as $d)
                    <tr>
                        <td>{{$d->fecha}}</td>
                        <td>{{$d->nombre}} {{$d->apellidos}}</td>
                        <td>{{$d->folio}}</td>
                        <td>
                            <a href="/venta/{{$d->folio}}"><button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                        </td>
                        <td>
                            <form method="POST" action="/deuda/{{$d->id}}">
                                @method('DELETE')
                                @csrf
                               <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form> 
                        </td>
                    </tr>
                @endforeach
              </tbody>
        </table>
      </div>
    </div>
@endsection