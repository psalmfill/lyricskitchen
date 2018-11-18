@extends('layouts.app')
@section('page_title')
Home
@endsection
@section('page_css')
<link rel="stylesheet" href="{{asset('vendors/plugins/bower_components/owl.carousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('vendors/plugins/bower_components/owl.carousel/owl.theme.default.min.css')}}">
@endsection
@section('banner'){{asset('imgs/homepage.jpg')}}@endsection
@section('landing_special')
                <div class="search-holder clear-fix">
                    <h1 class="text-white">Search over {{$songs_count}} Song Lyrics</h1>
                    <form action="{{route('search')}}">
                        <div class="search">
                            <div>
                            <p>Enter name keyword and hit enter</p>
                            <input type="search" name="q" id="search-box"/> 
                            </div>
                           
                            <button class="pull-right text-orange" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                        <div class="search-choice" id="search-opt">
                            <ul>
                                <li><input type="radio" name="type" id="" checked="checked" value="lyrics">Lyrics</li>
                                <li><input type="radio" name="type" id="" value="album">Album</li>
                                <li><input type="radio" name="type" id="" value="artist">Artist</li>
                            </ul>
                            
                        </div>
                    </form>
                </div>
@endsection
@section('content')
                <div class="pop-lyrics">
                    <h3 class="heading"><i class="fa fa-star text-orange"></i> popular lyrics</h3>
                    <!-- slides -->
                    <div class="slides owl-carousel">
                        @foreach($popular_songs as $ps)
                                <a href="{{route('song.single',['artist_slug'=>$ps->artist->slug,'song_slug'=>$ps->slug])}}">
                                    <div class="plyrics">
                                        <div class="cover"></div>
                                        <img class="ps-img" src="{{asset('uploads/artists/'.$ps->artist->avatar)}}" alt="">
                                        <div class="details">
                                            <h4><a href="{{route('song.single',['artist_slug'=>$ps->artist->slug,'song_slug'=>$ps->slug])}}">{{$ps->title}}</a></h4>
                                            
                                            <p><a href="{{route('artist.page',$ps->artist->slug)}}">{{$ps->artist->name}}</a></p>
                                        </div>
                                    </div>
                                </a>
                        @endforeach
                        

                    </div>
                    <!-- end slide -->
                </div>
                
                <!-- latest-lyrics -->
                <div class="latest-lyrics">
                    <h3 class="heading"><i class="fa fa-music text-orange"></i> Recently Added lyrics</h3>
                    <div class="llyrics ">
                        <?php $count =0 ?>
                        @foreach($songs as $key=>$song)
                        <div class="lyrics-item {{$count %2==0?'odd':'even'}}">
                            <p class="lyrics-link"> <a href="{{route('song.single',['artist_slug'=>$song->artist->slug,'song_slug'=>$song->slug])}}"><i class="fa fa-music"></i> {{$song->title}}</a></p>
                            <p class="lyrics-artist"><a href="{{route('artist.page',$song->artist->slug)}}">{{$song->artist->name}}</a></p>
                           
                        </div>
                        <?php $count++?>
                        @endforeach
                    </div>
                </div>

                <!-- latest-lyrics ends4 -->
                <div class="clear-fix"></div>

@endsection
@section('page_scripts')
<script src="{{asset('vendors/plugins/bower_components/owl.carousel/owl.carousel.min.js')}}"></script>
<script>
    $('#search-box').click(function(){
        
        $('#search-opt').css('display','block');
    });
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            autoWidth:true,
            items:10,
            loop:true,
            nav:true,
        });
    })
</script>
@endsection