<!-- resources/views/editprofile.blade.php -->
@extends('app')
@section('title')

@endsection
@section('content')
<form method="POST" action="/comment/save">
    {!! csrf_field() !!}

<tr>
  <td><p>Nombre: {{ $name2 }}   </p></td>
  <td><textarea type='text' name='comment'></textarea></td>
  <td>Comment:</td>
  <td><input type='submit' value='Submit' /></td>
</tr>
</form>

</form>
@endsection
