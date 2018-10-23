@extends('layouts.admin')
@section('page_title')
Add Song
@endsection
@section('page_styles')

    <link href="{{url('vendors/plugins/bower_components/summernote/dist/summernote.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/custom-select/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{url('vendors/plugins/bower_components/sweetalert/sweetalert.css')}}" rel="stylesheet" />

@endsection

@section('content')
<div class="white-box">
    <div class="row align-items-center">
        <div class="col-md-9 col-md-offset-1">
            <h3 class="box-title m-b-0 text-primary text-center">Edit Song</h3>
            <br>
            <form class="form"  action="{{route('song.update',$song->id)}}" method="post">
            {{csrf_field()}}
                <div class="form-group">
                    <label for="title">Song Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter song title " value ="{{$song->title}}">
                </div>
                <div class="form-group">
                    <label for="artist_id">Artist</label>
                    <select name="artist_id" id="artists" class="form-control" style="width:100%;height:38px">
                        <option value="">Select Artist</option>
                        @foreach($artists as $artist)
                        <option value="{{$artist->id}}" 
                        @if($song->artist->id == $artist->id)
                            selected
                        @endif
                        >{{$artist->name}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <label for="album_id">Album</label>
                    <select name="album_id" id="albums" class="form-control" style="width:100%;height:38px">
                        @if($song->album)
                            <option value="{{$song->album->id}}">{{$song->album->title}}</option>
                        @endif
                    </select> 
                </div>
                <div class="form-group">
                    <label for="genure_id">Genre</label>
                    <select name="genure_id" id="genre" class="form-control ">
                        @foreach($genures as $genure)
                        <option value="{{$genure->id}}" 
                        @if($song->genure->id == $genure->id)
                            selected
                        @endif
                        >{{$genure->name}}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" name="year" placeholder="Year" value="{{$song->year}}">
                </div>

                <div class="form-group">
                    <label for="lyrics">Lyrics</label>
                <textarea name="lyrics" id="" cols="30" rows="10" class="form-control summernote">{!!$song->lyrics!!}</textarea>
                </div>
                <div class="form-group">
                    <label for="video_url">Video Url</label>
                    <input type="text" class="form-control" name="video_url" placeholder="Video url" value="{{$song->video_url}}">
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <div class="tags-default">
                    <input type="text"  data-role="tagsinput" placeholder="add tags"  name="tags" class="form-control lg-large" value="{{$song->tags}}" /> 
                    </div>
                </div>
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
                                   
@endsection

@section('page_scripts')
<script src="{{url('vendors/plugins/bower_components/summernote/dist/summernote.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{url('vendors/plugins/bower_components/custom-select/dist/js/select2.full.min.js')}}"></script>
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
    $('#artists').select2({
        width:'resolve'
    });
    $('#albums').select2();

    $('#artists').change(function(){ 
        var artist = document.querySelector('#artists').value;
            $.ajax({
                url:"{{route('albums.get')}}",
                data:{'id':artist},
                success: function (data) {
                    console.log(data);
                $.each(data,function(id,title){
                    $('#albums').empty();
                    $('#albums').append('<option>Select Album</option>');
                    $('#albums').append('<option values="'+id+'">'+title+'</option>');
                });
            }
        })
    })
    </script>
@endsection