<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LyricsKitchen | @yield('page_title')</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="{{url('vendors/css/icons/font-awesome/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <style>
        body {
            /* background-image:url("{{asset('imgs/homepage.jpg')}}"); */
            background:#f5f5f5;
            background-repeat:no-repeat;
        }
        .container .card .card-header {
            font-size:2.5em;
            color:#fff;
            text-align:center;
        }
        .container .card {
            position:absolute;
            width:300px;
            height:400px;
            left:50%;
            top:50%;
            margin-left:-150px;
            margin-top:-250px; 
            background:#1F1B20;
            opacity:0.9;
            padding:1%;
            border-radius:5px;
            
        }
        label {
            color:#ffffff;
        }
        button {
            background:#E4422E !important; 
            border:none !important;
        }
    </style>
  

</head>
<body>
    
    @yield('content')


    <script src="{{url('vendors/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
   
</body>
</html>
