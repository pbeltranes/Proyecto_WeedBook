@extends('app')
@section('title')
New Product
@endsection
@section('content')
<form action="/strain/save-product" method="POST">
{!!csrf_field()!!}
<tr>
	<div class="form-group">

  <div class="form-group">
    Product Name
    <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control"/>
  </div>

  <div class="form-group">
    Use Time
      <input type="text" name="use_time" value="{{ old('use_time') }}" class="form-control" />
  </div>

  <div class="form-group">
    How to use
      <input type="text" name="how_to_use" value="{{ old('how_to_use') }}" class="form-control" />
  </div>


  <div class="form-group">
    Used on strain
      <select name="grow_type" class="form-control">
      <option disabled selected>-- Select one --</option>
        <option value="test">test</option>
        <!-- añadir la lista de strains de la review -->

      </select>
  </div>
<button type="submit" name="submit" value="Other" >Add Other Strain</button>
<button type="submit" name="submit" value="Ok" >Create Strain</button>
</tr>
</form>
@endsection
