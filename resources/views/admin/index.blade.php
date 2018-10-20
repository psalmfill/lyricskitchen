@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            @foreach ($artist as $art)
            {{$art->name}} <br>
            @endforeach
        </div>
    </div>
    
</div>
@endsection