@extends('layouts.admin')
@section('page_styles')
       

<link href="{{url('vendors/plugins/bower_components/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Data Table</h3>
            <p class="text-muted m-b-30">Data table example</p>
            <div class="table-responsive">
                <table class="table  table-striped " id="artisttable">
                    <thead>
                        <tr class="filters">
                            <th >#</th>
                            <th>Name</th>
                            <th >email</th>
                            <th >created_at</th>
                            <th>updated_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr >
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
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
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> -->
    <script>
  $(function() {
   var table = $('#artisttable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
    table.on( 'draw', function () {
                $('.livicon').each(function(){
                    $(this).updateLivicon();
                });
            } );
} );
 </script>
@endsection