<!-- resources/views/editprofile.blade.php -->
@extends('app')
@section('title')
Edit Profile
@endsection
@section('content')

<form method="POST" action="/user/edit/save">
    {!! csrf_field() !!}

    Bio
    <div>
        <input type="textarea" name="bio" value="{{ $bio }}">
    </div>

    Birthdate
    <div>
        <input type="date" name="birthdate" value="{{ $birthdate }}">
    </div>

    Avatar
    <div>
        <input type="text" name="avatar_url" value="{{ $avatar_url }}">
    </div>

    <input type="hidden" name="id" value="{{ $user_id }}">

    <div>
        <button type="submit">Save Changes</button>
    </div>
</form>
@endsection
