<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content='{{ csrf_token() }}'>

    <title>
        @yield('title')
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/navbar.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href=" {{ asset('css/sidebar.css') }} ">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    
    <style type="text/css" media="screen">
        .navbar-brand { 
            padding-top: 5px;
        }
    </style>
    @yield('style')
    <style>
        html,body {
            font-family: 'Lato';
            width: 100%;
        }
        
        body{
            background-color: #D3D3D3!important;
        }
        .fa-btn {
            margin-right: 6px;
        }
        .lgg {
            margin-top: 8px;
            background: #3BE5FA;
        }
        .lgg select {
            background: #3BE5FA;
        }
    </style>
</head>
<body id="app-layout">

    @yield('navbar')
    

    @include('includes.sidebar')

    @yield('content')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#language').change(function(event) {
                /* Act on the event */
                event.preventDefault();
                var language = $(this).val();
                var url = '/z11app/public/language';
                $.post(url, {language: language}, function(data, textStatus, xhr) {
                    
                });
            });
        });
    </script>
</body>
</html>