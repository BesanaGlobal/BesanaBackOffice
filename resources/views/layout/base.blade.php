<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('img/logonew.png') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Company Besana ">
    <meta name="keywords" content="products, health, affiliate, salud, Besanaglobal.com">
    <meta name="author" content="BESANA">
    
   
<script src="https://js.stripe.com/v3/"></script>


    <link  rel="stylesheet" href="{{ asset('sweetalerts2/sweetalerts2.css') }}">
    
    <script  src="{{ asset('assets/balkan/orgchart.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles

    @yield('head')

    <!-- BEGIN: CSS Assets-->
  
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body >
@yield('body')
    
 @stack('javas')

@livewireScripts

<script src="{{ asset('sweetalerts2/sweetalerts2.min.js') }}"></script>

</body>
</html>
