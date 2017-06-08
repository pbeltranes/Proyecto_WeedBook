@extends('app')
@section('title')
<td><p>New review</p></td>
@endsection

@section('content')
<!--agregar condicion de verificacion de campo vacio-->

<form  action= "/new-review" method= "POST" >
    {!! csrf_field() !!}

<tr>

<div class="form-group">
      Title of your cultive
      <input type="text" name="title" value="{{ old('title') }}" class="form-control" />
  </div>
  <div class="form-group">
      Cover Photo
  <input type="text" name="background_image_url" value="{{ old('background_image_url') }}" class="form-control"/>
  </div>
  <button type="submit">Save Changes</button>
</tr>
</form>
@endsection
