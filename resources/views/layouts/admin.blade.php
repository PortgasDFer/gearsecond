<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>StrawHat - @yield('title')</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js" defer></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/home" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary bg-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
      <img src="/img/logoshw.png" class="brand-image img-circle elevation-3" alt="Responsive image" style="opacity: .8"> 
      <span class="brand-text font-weight-light">StrawHat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-close">
            @if(Auth::user()->hasRole('admin'))
            <a href="#" class="nav-link active">
               <i class="fa fa-product-hunt" aria-hidden="true"></i> 
              <p>
                PRODUCTOS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ">     
                <li class="nav-item">
                  <a href="/producto" class="nav-link active bg-dark">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Lista de productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/producto/create" class="nav-link active bg-dark">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <p>Registrar productos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/masiva" class="nav-link active bg-dark">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                    <p>Alta masiva de productos</p>
                  </a>
                </li>

            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
               <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <p>
                VENTAS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/venta/create" class="nav-link active bg-dark">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <p>Generar nota de venta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/venta" class="nav-link active bg-dark">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Listado de notas de venta</p>
                  </a>
                </li>
                  @if(Auth::user()->hasRole('admin'))
                <li class="nav-item">
                  <a href="/reportes" class="nav-link active bg-dark">
                    <i class="fa fa-file" aria-hidden="true"></i>
                    <p>Reportes</p>
                  </a>
                </li>
                @endif
            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
               <i class="fa fa-list-ul" aria-hidden="true"></i>
              <p>
                INVENTARIO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/inventario" class="nav-link active bg-dark" >
                    <i class="fa fa-list-alt" aria-hidden="true"></i> 
                    <p>Listado de existencias</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/producto/create" class="nav-link active bg-dark">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <p>Entrada de mercancía</p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
               <i class="fa fa-users" aria-hidden="true"></i>
              <p>
                DEUDORES
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">     
                <li class="nav-item">
                  <a href="/deudores" class="nav-link active bg-dark">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Lista de deudores</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/deudores/create" class="nav-link active bg-dark">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <p>Registrar deudor</p>
                  </a>
                </li>
            </ul>
          </li>
          @else
          <li class="nav-item has-treeview menu-close">
            <a href="#" class="nav-link active">
               <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              <p>
                VENTAS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/venta/create" class="nav-link active bg-dark">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <p>Generar nota de venta</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/venta" class="nav-link active bg-dark">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Listado de notas de venta</p>
                  </a>
                </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Sesión activa</h5>
      <h5>{{ Auth::user()->name }}</h5>
      <p>¿Desea cerrar sesión?</p>
      <ul class="nav nav-pills nav-sidebar flex-column">
        <li class="nav-item">
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
              </form>
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            <p>Cerrar sesión</p>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer mt-3">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
     ® No es el año en que lo programe, es el año en que lo sigues utilizando.
    </div>
    <!-- Default to the left -->
  
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("adminlte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("adminlte/js/adminlte.min.js")}}"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')
    @yield('datatable')
    @yield('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</body>
</html>
