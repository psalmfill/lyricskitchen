@extends('layouts.app')



@section('page_title')
{{$song->title}} Lyrics
@endsection

@section('description'){{$song->tile}} by {{$song->artist->name}} lyrics @endsection

@section('song'){{$song->title}} @endsection

@section('artist'){{$song->artist->name}}@endsection


@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection
@section('landing_special')

<div class="page-title text-left">
<h4 class="text-orange">{{$song->artist->name}}</h4>
<h1>{{$song->title}}</h1>
</div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-lg-8">
                        <button class="pull-right btn btn-default" onclick="printLyrics()"><i class="fa fa-print"></i> Print</button>
                        <div class="clear-fix"></div>
                        <div class="song-lyrics text-left" id="lyrics">
                            {!!$song->lyrics!!}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('uploads/artists/'.$song->artist->avatar)}}" alt="" class="img-responsive">
                        <div class="lyrics">
                            <h5>More Songs by {{$song->artist->name}}</h5>
                            @foreach($songs as $sg)
                            @if($sg->id ==$song->id)
                            @continue
                            @endif
                            <div class="lyrics-item">
                                <p><a href="{{route('song.single',['artist_slug'=>$sg->artist->slug,'song_slug'=>$sg->slug])}}">{{$sg->title}}</a>
                            @if($sg->album_id !=null)
                                - <a class="album" href="{{route('album.page', ['artist_slug'=>$sg->album->artist->slug,'album_slug'=>$sg->album->slug])}}">{{$sg->album->title}}</a>
                            @endif
                            </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>  
@endsection
@section("page_scripts")
<script>


function printLyrics(){
            //Get the HTML of div
            var divElements = document.getElementById('lyrics').innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" +
              "<h1>{{$song->title}} by {{$song->artist->name}}</h1>"+ 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
</script>
@endsection