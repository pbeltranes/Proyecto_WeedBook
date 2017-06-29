<!-- resources/views/auth/login.blade.php -->
@extends('app')
@section('title')
{{'Login'}}
@endsection
@section('content')
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class = "form-group">
        Email
        <input class = "form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Password
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class = "form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-default btn-block">Login</button>
    </div>
</form>
@endsection
