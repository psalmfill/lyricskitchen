@extends('layouts.app')

@section('page_title')
Albums
@endsection

@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection

@section('landing_special')
<h1 class="page-title">{{$album->title}} <small> - {{$album->artist->name}}</small></h1>
@endsection
@section('content')
                <div class="row">
                    <div class="col-lg-8">
                    <div class="songs">
                            <table class="table table-stripped">
                                <thead>
                                    <th>Song Title</th>
                                    <th>Artist</th>
                                </thead>
                                @foreach($album->songs as $song)
                                 <tr>
                                    <td><h4><a href="{{route('song.single', ['artist_slug'=>$song->artist->slug,'song_slug'=>$song->slug])}}">{{$song->title}}</a> </h4></td>
                                    <td><a href="{{route('artist.page', $song->artist->slug)}}">{{$song->artist->name}}</a></td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- paginate links -->
                        {{--$songs->render('vendor.pagination.default')--}}
                    </div>
                    <div class="col-lg-4">
                        
                    </div>
                </div>  
@endsection