@extends('layouts.admin')
@section('page_title')
Artists
@endsection
@section('page_styles')
       

<link href="{{url('vendors/plugins/bower_components/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Songs</h3>
            <p class="text-muted m-b-30">List of all songs</p>
            <div class="table-responsive">
                <table class="table  table-striped " id="artisttable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Artist</th>
                            <th class="text-center">Songs</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($albums as $album)
                        <tr>
                            <td>{{$album->id}}</td>
                            <td>{{$album->title}}</td>
                            <td>{{$album->artist->name}}</td>
                            <td>{{$album->songs->count()}}</td>
                            <td>{{$album->year}}</td>
                            <td class="text-right">
                                <a href="{{route('admin.album.edit', $album->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{$album->songs->count() > 0?'':route('admin.album.delete', $album->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>

@endsection

@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/datatables/datatables.min.js')}}"></script>
    <script>
 $(document).ready(function() {
            $('#artisttable').DataTable();
        });
 </script>
@endsection
@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@include('sweet::alert')
@endsection