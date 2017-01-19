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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    {{-- <base href="{{ asset('') }}"> --}}
    
    
    @yield('style')
    <style>
        html,body {
            font-family: "Raleway","HelveticaNeue","Helvetica Neue",sans-serif;
            width: 100%;
        }
        
        body{
            background-color: #D3D3D3!important;
        }
        .fa-btn {
            margin-right: 6px;
        }
        
        .back-to-top {
            cursor: pointer;
            position: fixed;
            bottom: 20px;
            right: 20px;
            display:none;
        }
        #loading {
            z-index: 999;
            display: none;
            position: absolute;
            width: 100%;
            height: 100%;
            background: url({{ asset('image/squares.gif') }}) no-repeat center center;
        }

        .banner {
            margin-top: 40px;
        }

    </style>
</head>
<body id="app-layout">
    <div class="hidden" id="session">{{ session('language') }}</div>
    <div id="loading"></div>

    <div class="page-body">
        @yield('navbar')
        @yield('banner')
        @yield('sidebar-total-top')
        @yield('content-sidebar-total-top')
        @yield('end-sidebar-total-top')

        @yield('content')
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>

    </div>
    @include('includes.footer')
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('script')
    <script type="text/javascript">
        $(document).ready(function() {

            var lang = $("#session").html();
            $('select option[value="' + lang + '"]').attr("selected",true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.lang').click(function(event) {
                /* Act on the event */
                $("#loading").show();

                event.preventDefault();
                var language = $(this).attr('hreflang');
                var url_ = '/z11app/public/language';
                $('.page-body').css('opacity', '0.2');
                $.post(url_, {
                    language: language
                }, function(data, textStatus, xhr) {
                    location.reload();
                    $('#loading').css('display', 'none');
                    $('.page-body').css('opacity', '1');
                });
            });
            
        });
        $(document).ready(function(){
            $(window).scroll(function () {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('#back-to-top').tooltip('hide');
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
            
            $('#back-to-top').tooltip('show');
        });
    </script>
</body>
</html>