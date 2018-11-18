@extends('layouts.app')
@section('page_title')
Artists
@endsection
@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection
@section('landing_special')
<div class="active-index">
    @isset($active_index)
        <h1>{{$active_index}}</h1>
    @endisset
</div>
<h1 class="page-title"><i class="fa fa-users"></i> Artists</h1>
@endsection
@section('content')
    <div class="artist">
    @if($artists->count() > 0)
         @foreach($artists as $artist)
                    <!-- artist card begins -->
                    <div class="artist-card">
                        <img src="{{asset('uploads/artists/'.$artist->avatar)}}" alt="{{$artist->name}}" class="img-cover"/>
                        <div class="artist-name">
                           <h4> <a href="{{route('artist.page',$artist->slug)}}">{{$artist->name}}</a></h4>
                        </div>
                    </div>
                    <!-- end artist-card -->
        @endforeach
    @else
                <h2 class="text-center nf-notice" >No artist avaible for this index</h2>
    @endif
                    
                </div>
                {{$artists->render('vendor.pagination.default')}}
                
@endsection