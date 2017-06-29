<!-- resources/views/editprofile.blade.php -->
@extends('app')
@section('title')
Edit Profile
@endsection
@section('content')

<form method="POST" action="/user/edit/save" enctype="multipart/form-data" >
    {!! csrf_field() !!}

    Bio
    <div class="form-group">
        <textarea type="text" name="bio">{{ $bio }}</textarea>
    </div>

    Birthdate
    <div class="form-group">
        <input type="date" name="birthdate" value="{{ $birthdate }}">
    </div>

    Avatar
    <div class="form-group">

        <input type="file" id="selectedFile" style="display: none;" class="form-control" name="avatar_url"/>
        <input type="button" class="btn btn-default" value="Browse..." onclick="document.getElementById('selectedFile').click();" />
    </div>

    <input type="hidden" name="id" value="{{ $user_id }}">

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Save Changes</button>
    </div>
</form>
@endsection
