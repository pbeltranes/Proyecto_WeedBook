@extends('app')
@section('title')
New Product
@endsection
@section('content')
<form action="/admin/save-product" method="POST">
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

<button type="submit" name="submit" value="Ok" >Create Product</button>
</tr>
</form>
@endsection
