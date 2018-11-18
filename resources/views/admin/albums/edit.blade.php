@extends('layouts.admin')
@section('title')
Add Album
@endsection
@section('page_styles')

    <link href="{{url('vendors/plugins/bower_components/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endsection

@section('content')
<div class="white-box">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div> <h3 class="box-title m-b-0 text-primary text-center">Add Album</h3><br></div>
        <form action="{{route('admin.album.update', $album->id)}}" class="form-horizontal " method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Album Name</label>
                    <input type="text" name="title" class="form-control " value ="{{$album->title}}"/>
                </div>
                <div class="form-group">
                    <label for="artist">Artist</label>
                    <select name="artist_id" id="" class="form-control">
                    @foreach($artists as $artist)
                        
                        <option value="{{$artist->id}}" 
                        @if($artist->id == $album->artist->id)
                            selected
                        @endif
                        >{{$artist->name}}</option>
                    @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" name="year" class="form-control" value="{{$album->year}}" />
                </div>
            
            
                <div class="form-group">
                    <label for="image">Album Art</label>
                    <input type="file" id="input-file-now" name="image" class="dropify" value="{{$album->image}}"/> 
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
    
</div>
@endsection
@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@include('sweet::alert')
<script>
   
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
@endsection