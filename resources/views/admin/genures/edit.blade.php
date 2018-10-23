@extends('layouts.admin')
@section('page_title')
Genures
@endsection
@section('page_styles')
<link href="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endsection
@section('content')
<div class="white-box">
<div class="row align-items-center">
 
    <div class="col-md-6 col-md-offset-3 white-box">
         <h3 class="box-title m-b-0 text-primary text-center">Add New Genures</h3>
         <br>
        <form class="form" method="post" action="{{route('genure.update',$genure->id)}}">
        {{csrf_field()}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter genure name" 
                    value="{{$genure->name}}"
                >
            </div>
            <input type="hidden" name="id" value= "{{$genure->id}}">
            <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
            <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
        </form>

    </div>
</div>
    
    
</div>
                                    
@endsection
@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@include('sweet::alert')
@endsection