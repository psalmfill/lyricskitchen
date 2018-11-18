@extends('layouts.app')

@section('page_title')
Songs
@endsection
@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection
@section('landing_special')
<div class="page-title"> 
    <h3></h3>
    <h1>Songs</h1>
</div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="songs">
                        @if(($songs->count()> 0))
                            <table class="table table-stripped">
                                <thead>
                                    <th>Song Title</th>
                                    <th>Artist</th>
                                </thead>
                                @foreach($songs as $song)
                                 <tr>
                                    <td><h5><a href="{{route('song.single', ['artist_slug'=>$song->artist->slug,'song_slug'=>$song->slug])}}">{{$song->title}}</a> </h5></td>
                                    <td><a href="{{route('artist.page', $song->artist->slug)}}">{{$song->artist->name}}</a></td>
                                </tr>
                                @endforeach
                            </table>
                        @else
                        <h3 class="text-center nf-notice">No Songs  available for this artist yet</h3>
                        @endif
                        </div>
                        <!-- paginate links -->
                    </div>
                    <div class="col-lg-4">


                    </div>
                </div>               
@endsection