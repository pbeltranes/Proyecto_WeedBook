@extends('app')
@section('$T')
<td><p>New review</p></td>
@endsection

@section('content')
<!--agregar condicion de verificacion de campo vacio-->

<form method="POST" action="/review/edit/save">
    {!! csrf_field() !!}

<tr>
<div class="form-group">
      Title of your cultive actually is: <b>{{ $title }}</b>
      <input type="text" name="title" value=" " class="form-control" />
  </div>
  <div class="form-group">
    <p> Cover Photo actually is: <img src="{{ $background_image_url }}" alt="Background" style="
        border-radius: 50%;
          overflow: hidden;
          width: 150px;
          height: 150px; "  class="w3-hover-opacity">
        </p>
      <input type="text" name="background_image_url" value="" class="form-control"/>
  </div>
      <input type="hidden" name="id" value="{{ $id }}">
  <button type="submit">Save Changes</button>
</tr>
</form>
@endsection
