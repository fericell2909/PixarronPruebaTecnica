<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="https://www.pixarron.com/wp-content/uploads/2020/06/cropped-icono-pixa-32x32.png" sizes="32x32" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:image" content="{{ config('global.site_logo') }}">
    <title>{{ config('global.site_name','DashBoard - Tienda') }}</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('custom') }}/css/custom.css" rel="stylesheet">
    <!-- Select2 -->
    <!--<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />-->
    <link type="text/css" href="{{ asset('custom') }}/css/select2.min.css" rel="stylesheet">
    <!-- Jasny File Upload -->
  <!--<link type="text/css" href="{{ asset('fileupload') }}/fileupload.css" rel="stylesheet">-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
    <!-- Flatpickr datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
    .my-float{
        margin-top:16px;
    }
    </style>
    @yield('head')
  </head>
  <body class="{{ $class ?? '' }}">
    <a href="https://api.whatsapp.com/send?phone=51920200067&text=Hola+Tengo+una+Consulta" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
        </a>
    @include('layouts.navbars.navbar')
    <div class="main-content">

            @yield('content')
        </div>
    </div>

    @stack('js')
    <!-- Nouslider -->
    <script src="{{ asset('argon') }}/vendor/nouislider/distribute/nouislider.min.js" type="text/javascript"></script>

    <!-- Argon JS -->
    <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('custom') }}/js/orders.js"></script>
    <!-- Custom js -->
    <script src="{{ asset('custom') }}/js/mresto.js"></script>
    <!-- AJAX -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>-->


    @yield('js')
  </body>
</html>
