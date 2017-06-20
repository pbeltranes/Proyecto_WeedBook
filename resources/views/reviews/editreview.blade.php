@extends('app')
@section('title')
<td><p>Editing Review</p></td>
@endsection

@section('content')
<!--agregar condicion de verificacion de campo vacio-->

<form method="POST" action="/review/edit/save" class="form-control" >
    {!! csrf_field() !!}

<tr>
<div class="form-group">
      Title of your cultive actually is: <b>{{ $title }}</b>
      <input type="text" name="title" value="" class="form-control" />
  </div>
  <div class="form-group">
    <p> Cover Photo actually is: <img src="{{ $background_image_url }}" alt="Background" style="
        border-radius: 50%;
          overflow: hidden;
          width: 150px;
          height: 150px; "  class="w3-hover-opacity">
        </p>
      <input type="input" name="background_image_url" value="{{ $background_image_url }} " class="form-control"/>
  </div>
      <input type="hidden" name="id" value="{{ $id }}">
      <button type="submit" name="submit" value="Finish" >Finish</button>
      <button type="submit" name="submit" value="Edit" >Edit Strain</button>
</tr>
</form>
@endsection
