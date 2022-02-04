<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LEGOPS</title>

    <meta name="description"
        content="LEGOPS">
    <meta name="keywords"
        content="LEGOPS">
      
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    
    <style>
        *{
            font-size: 12px;
        }
    </style>
    
</head>
<body>    
    <div id="app">    
        <div class="d-flex justify-content-center mt-4">
            <h3>
                CRUD Responsive de usuarios
            </h3>
        </div>
        <main class="py-4">        
            @yield('content')
        </main>
    </div>
    <div class="footer">{{'@'.date('Y')}} - Todos los derechos reservados - LEGOPS</div>
    
</body>
</html>
