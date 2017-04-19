<!-- resources/views/editprofile.blade.php -->
@extends('app')
@section('title')
@endsection
@section('content')
<!--agregar condicion de verificacion de campo vacio-->
<!--agregar opcion de editar el comentario -->
<form  method="POST" action="/comment/save" >
    {!! csrf_field() !!}
<tr>
  <td><p>Nombre: {{ $name }} </p></td>


  <textarea class="form-control" rows="3" cols="3" name="comment"></textarea>
  <td>Comment:</td>
  <td><button type="submit" class="btn btn-default btn-lg">Submit</button></td>
</tr>
</form>

@endsection
