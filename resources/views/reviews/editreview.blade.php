@extends('app')
@section('title')
<td><p>Editing Review</p></td>
@endsection

@section('content')
<!--agregar condicion de verificacion de campo vacio-->

  <div class="container-fluid">
          <div class="container-fluid">
            <form method="POST" action="/review/edit/save" enctype="multipart/form-data" >
              {!! csrf_field() !!}
          </div>
          <div class="form-group">
            <h4>Actual tittle:</h4>
            <input type="text" name="title" value="{{ $title }}" class="form-control">
          <div class=row>
              <div class="container-fluid">
                <h4> Cover Photo actually
                    <img src="/images/{{ $background_image_url }}" alt="Background" style="width: 150px;height: 150px; "  class="img block-center thumbnail img-circle">
                </h4>
                  <input type="file" id="selectedFile" style="display: none;" name="background_image_url" class="form-control"/>
                  <input type="button" class="btn btn-default" value="Browse..." onclick="document.getElementById('selectedFile').click();" />
              </div>
          </div>
          <br>
          <div class="row">
            <div class="container-fluid">
              <input type="hidden" name="id" value="{{ $id }}">
              <button class="btn btn-default" type="submit" name="submit" value="Finish" >Finish</button>
              <button class="btn btn-default" type="submit" name="submit" value="Edit" >Edit Strain</button>
            </div>
          </div>
        </div>
      </form>
  </div>
@endsection
