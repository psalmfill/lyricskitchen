<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="lyricsKitchen, lyrics, kitchen, songs, song, song lyrics, artists, albums, song by @yield('artist'),
    @yield('song') by @yield('artist'), @yield('song') lyrics, @yield('artist') lyrics, @yield('artist') song,@yield('album') ">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') - LyricsKitchen</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="{{url('vendors/css/icons/font-awesome/css/fontawesome-all.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Styles -->
    @yield('page_css')
    @if(url()->current() != url('/'))
        <style>
            .landing {
                height:400px;
            }
        </style>
    @endif

</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="main-navigation">
                <div class="menu-bar" role="toggle-bar" id="menu-toggle">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <div class="logo">
                    <a href="{{url('/')}}">LyricsKitchen</a>
                </div>
                
                <nav class="nav" id="navigation">
                    <div id="nav-close-btn">X</div>
                    <ul>
                        <li><a href="{{url('')}}" class="menu-item {{url()->current() == url('/')?'active':''}}">Home</a></li>
                        <li><a href="{{route('albums.home')}}" class="menu-item {{url()->current() == route('albums.home')?'active':''}}">Albums</a></li>
                        <li><a href="{{route('artists.home')}}" class="menu-item {{url()->current() == route('artists.home')?'active':''}}">Artists</a></li>
                        <li><a href="{{route('genre.home')}}" class="menu-item {{url()->current() == route('genre.home')?'active':''}}">Genres</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                </nav> 
                <div class="clear-fix"></div>
            </div>
        </div>
    </header>
    <main>
        <div class="index-nav">
            <div class="container">
                <div class="indexes ">
                    <ul class="indexes-links">
                        @php
                            $chars = range('a','z');
                        @endphp
                        <li><a class="{{(!isset($active_index) and url()->current() == route('artists.home'))? 'active':''}}" href="{{url('/artists')}} ">#</a></li>
                        @foreach($chars as $char)     
                        <li><a class="{{(isset($active_index) and $active_index == $char)? 'active':''}}" href="{{url('/artists/'.$char)}}">{{strtoupper($char)}}</a></li>
                        @endforeach
                    </ul>
                    <div class="submit-lyrics">
                        <a href="#" class="btn"><i class="fa fa-plus"></i> Submit Lyrics</a>
                    </div>
                    <div class="clear-fix"></div>
                </div>
                
            </div>
        </div>
        <div class="landing" style="background-image:url('@yield('banner')') ;">
            
            <div class="cover"></div>
            <div class="container">
                @yield("landing_special")
            </div>
        </div>
        <div class="content">
            <div class="container lk-content-h">
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="bottom-nav container">
            <ul>
               <li><a href="{{url('')}}" class="menu-item {{url()->current() == url('/')?'active':''}}">Home</a></li>
                <li><a href="{{route('albums.home')}}" class="menu-item {{url()->current() == route('albums.home')?'active':''}}">Albums</a></li>
                <li><a href="{{route('artists.home')}}"class="menu-item {{url()->current() == route('artists.home')?'active':''}}">Artists</a></li>
                <li><a href="{{route('genre.home')}}"class="menu-item {{url()->current() == route('genre.home')?'active':''}}">Genres</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </div>
    </footer>




    <script src="{{url('vendors/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    
    <script>
        $(document).ready(function(){
            $('#nav-close-btn').click(function(){
                console.log('clicked')

                $('#navigation').css("display","none");
            })
            $("#menu-toggle").click(function(){
                console.log('clicked')
                $('#navigation').css('display','block');
            });
        })
    </script>
    @yield('page_scripts')
</body>
</html>
