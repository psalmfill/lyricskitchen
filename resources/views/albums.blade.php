@extends('layouts.app')

@section('page_title')
Albums
@endsection
@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection

@section('landing_special')
 
<h1 class="page-title">Albums</h1>
@endsection
@section('content')
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="albums">
                                @if($albums->count() >0)  
                                    @foreach($albums as  $album)
                                    {{--dd(\Image::make(asset('uploads/albums/'.$album->image))->resize(50,50))--}}
                                    <div class="album-card">
                                        <!-- <img class="albums-art" src="{{asset('uploads/albums/'.$album->image)}}" alt=""> -->
                                        <img class="albums-art" src="{{ Imgfly::imgPublic('albums/'.$album->image .'?w=80','uploads') }}" alt="{{$album->title}}">
                                        <div class="album-details">
                                            <h4 class="title"><a href="{{route('album.page', ['artist_slug'=>$album->artist->slug,'album_slug'=>$album->slug])}}">{{$album->title}}</a></h4>
                                            <p class="album-artist"><a href="{{route('artist.page',$album->artist->slug)}}">{{$album->artist->name}}</a></p>
                                        </div>
                                        <div class="clear-fix"></div>
                                    </div>
                                    
                                    @endforeach
                                @else
                                    @if(url()->current() == route('search'))
                                        <h3>No album was found for this search</h3>
                                    @else
                                    <h3>No Album was found</h3>
                                    @endif
                                @endif
                            </div>
                            {{$albums->render('vendor.pagination.default')}}
                        </div>
                        <div class="col-lg-3">

                        </div>
                    </div>
                    
@endsection