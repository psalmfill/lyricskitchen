@extends('layouts.admin')
@section('page_title')
Genure
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Genures</h3>
            <p class="text-muted m-b-30">List of all genures</p>
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
                        @foreach($genures as $genure)
                        <tr>
                            <td>{{$genure->id}}</td>
                            <td>{{$genure->name}}</td>
                            <td class="text-right">
                                <a href="{{route('genure.edit', $genure->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{route('genure.delete', $genure->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection

