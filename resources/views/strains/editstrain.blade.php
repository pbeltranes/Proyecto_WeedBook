@extends('app')
@section('title')
Add a new strain to your grow
@endsection
@section('content')
{!!csrf_field()!!}


@foreach ($strains as $strain)
<?php
echo $strain->strain_name;
?>
@endforeach


@endsection
