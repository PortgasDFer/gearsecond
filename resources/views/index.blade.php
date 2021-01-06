<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SysInventario</title>

    <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/the-big-picture.css" rel="stylesheet')}}">

</head>

<body>
  <style>
  body {
    background: url('/bg.jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
  }
  </style>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-bottom">
    <div class="container">
      <a class="navbar-brand" href="#">StrawHat Systems</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        @if(Route::has('login'))
        <ul class="navbar-nav ml-auto">
              
                   @auth
                        <a href="{{ url('/home') }}" class="btn btn-outline-light mr-2">Inicio</a>
                        <a class="btn btn-outline-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
            <li class="nav-item">
              <a class="btn btn-outline-light mr-2" href="{{ route('login') }}">Identificarse</a>
            </li>
              
              @endauth
        </ul>
        @endif
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <p><h1 class="mt-5 display-4" style="color:white" >GEAR SECOND </h1><span class="badge badge-primary">V 2.1</span></p>
          <p style="color:white">Inventario y control del negocio al alcance de tu mano.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
