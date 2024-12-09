<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> {{ !empty($header_title) ? $header_title : '' }} - Ecommerce </title>
        @if (!@empty($meta_keywords))
            <meta name="keywords" content="{{ $meta_keywords }}">
        @endif

        @if (!@empty($meta_description))
            <meta name="description" content="{{ $meta_description }}">
        @endif
        

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ url('public/assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- IonIcons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('public/assets/dist/css/adminlte.min.css') }}">
        <style>
            /* .content-header {
                padding: 0 0 15px 0;
            } */
        </style>
        @yield('style')
    </head>

    <body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            @include("admin.layout.header")
            
            @include("admin.layout.sidebar")

            @yield('content')

            @include("admin.layout.footer")
        </div>

        <script src="{{ url('public/assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE -->
        <script src="{{ url('public/assets/dist/js/adminlte.js') }}"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="{{ url('public/assets/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ url('public/assets/dist/js/demo.js') }}"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        
        @yield('script')
    </body>
</html>