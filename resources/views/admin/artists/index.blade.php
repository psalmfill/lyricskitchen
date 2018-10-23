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
            <h3 class="box-title m-b-0">Artists</h3>
            <p class="text-muted m-b-30">List of all artist</p>
            <div class="table-responsive">
                <table class="table  table-striped " id="artisttable">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Artist Name</th>
                            <th class="text-center">Year</th>
                            <th class="text-center">Songs</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($artists as $artist)
                        <tr>
                            <td>{{$artist->id}}</td>
                            <td>{{$artist->name}}</td>
                            <td>{{$artist->year}}</td>
                            <td>{{$artist->albums()->count()}}</td>
                            <td class="text-right">
                                <a href="{{route('artist.delete', $artist->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{$artist->albums()->count()==0?route('artist.delete', $artist->id):''}}" class="btn btn-danger"
                                @if($artist->albums()->count() > 0)
                                disabled
                                @endif
                                ><i class="fas fa-trash-alt"></i></a>
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