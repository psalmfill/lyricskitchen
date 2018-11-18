@extends('layouts.app')
@section('page_title')
Genres
@endsection
@section('banner'){{asset('imgs/artistbanner.jpg')}}@endsection
@section('landing_special')
 
<h1 class="page-title">Genres</h1>
@endsection
@section('content')
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="genre">
                               <ul>
                               @foreach($genres as $genre)
                                   <li><a href="{{url('/genre/'.$genre->slug)}}">{{$genre->name}}</a></li>
                                   <div class="divider"></div>
                                @endforeach
                                   
                               </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">

                        </div>
                    </div>           
@endsection