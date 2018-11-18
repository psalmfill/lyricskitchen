@extends('layouts.admin')
@section('page_title')
Songs
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
                            <th class="text-center">Video Url</th>
                            <th class="text-center">Release Date</th>
                            <th class="text-center">Views</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($songs as $song)
                        <tr>
                            <td>{{$song->id}}</td>
                            <td>{{$song->title}}</td>
                            <td>{{$song->artist->name}}</td>
                            <td>{{$song->video_url}}</td>
                            <td>{{$song->release_date}}</td>
                            <td>{{$song->views}}</td>
                            <td class="text-right">
                                <a href="{{route('song.edit', $song->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{route('song.delete', $song->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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