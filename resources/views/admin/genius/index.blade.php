@extends('layouts.admin')
@section('title')
Genius Api
@endsection

@section('content')
<div class="">
    <div class="form">
        <form action="">
            <div class="input-group">
               <input  class="form-control" type="text" placeholder="search for artist" name="query" />
               <span class="input-group-btn">
                   <button class="btn btn-success " type="submit" >Search</button> 
               </span>
               
            </div>
            
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>artist</th>
                <th>url</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
        @isset($songs)
                @foreach ($songs->songs as $song)
                            <tr>
                                <td>{{ $song->id }}</td>
                                <td>{{ $song->title }}</td>
                                <td>{{ $song->primary_artist->name }}</td>
                                <td>{{ $song->url}}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.genius.add',$song->id)}}">Add</a>
                                </td>
                            </tr>
                        @endforeach
        @endisset
        </tbody>
       
    </table>
    <div class="pull-right">
        <ul class="pagination">
        @if(isset($songs))
            @if($songs->next_page !=null && $songs->next_page >1)
            <li class="page-item"><a href=" {{Request::fullurl()}}&page={{$songs->next_page - 1}}" class="page_link">Prev </a> </li>
            <li class="page-item"><a href=" {{Request::fullurl()}}&page={{$songs->next_page}}" class="page_link"> Next</a></li>
                            
            @endif
            @endif
            </ul>
            </div>
</div>
@endsection