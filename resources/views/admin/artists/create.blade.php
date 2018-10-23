@extends('layouts.admin')
@section('title')
Add Artist
@endsection
@section('page_styles')

    <link href="{{url('vendors/plugins/bower_components/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/dropify/dist/css/dropify.min.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" />
    
@endsection

@section('content')
<div class="white-box">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div> <h3 class="box-title m-b-0 text-primary text-center">Add Artist</h3><br></div>
        <form action="{{route('create_artist')}}" class="form-horizontal " method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="name">Artist Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" name="year" class="form-control" />
                </div>
            
                <div class="form-group">
                    <label for="bio">Biography</label>
                    <textarea name="bio" id="" cols="30" rows="10" class="form-control summernote"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Avatar</label>
                    <input type="file" id="input-file-now" name="image" class="dropify" /> 
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
    
</div>
@endsection
@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/summernote/dist/summernote.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/dropify/dist/js/dropify.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js')}}"></script>
@include('sweet::alert')
<script>
    $(function() {
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });
        $('.inline-editor').summernote({
            airMode: true
        });
    });
    window.edit = function() {
        $(".click2edit").summernote()
    }, window.save = function() {
        $(".click2edit").summernote('destroy');
    }

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