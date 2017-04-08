<!-- resources/views/editprofile.blade.php -->
@extends('app')
@section('title')
@endsection
@section('content')
<form name="com" method="POST" action="/comment/save" onsubmit="check()">
    {!! csrf_field() !!}
<tr>
  <td><p>Nombre: {{ $name }} </p></td>

  <!-agregar condicion de verificacion de campo vacio->
  <!-agregar opcion de editar el comentario->
  <textarea class="form-control" rows="3" cols="3" name="comment"></textarea>
  <td>Comment:</td>
  <td><button type="submit" class="btn btn-default btn-md">Submit</button></td>
</tr>

</form>

@endsection
