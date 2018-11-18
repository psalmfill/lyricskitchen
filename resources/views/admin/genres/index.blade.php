@extends('layouts.admin')
@section('page_title')
Genre
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Genres</h3>
            <p class="text-muted m-b-30">List of all genres</p>
            <div class="table-responsive">
                <table class="table  table-striped " id="artisttable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($genres as $genre)
                        <tr>
                            <td>{{$genre->id}}</td>
                            <td>{{$genre->name}}</td>
                            <td class="text-right">
                                <a href="{{route('genre.edit', $genre->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{route('genre.delete', $genre->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection

