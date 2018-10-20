@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <form action="{{route('create_artist')}}" class="form-horizontal " method="post">
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
                    <label for="bio">Artist Name</label>
                    <textarea name="bio" id="" cols="30" rows="10" class="form-control">Bio</textarea>
                </div>
                <div class="form-group">
                    <label for="name">Upload avatar</label>
                    <input type="file" class="form-control" />
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
    </div>
    
</div>
@endsection