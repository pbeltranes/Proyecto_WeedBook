@extends('app')
@section('title')
Add a new strain to your grow
@endsection
@section('content')
<form action="/strain/{{$strain_id}}/save-product" method="POST">
{!!csrf_field()!!}
<tr>
	<div class="form-group">

  <div class="form-group">
    Product to Add
      <select name="prod_id" class="form-control">
      <option disabled selected>-- Select an Option --</option>
      @foreach($products as $product)
      <option value="{{$product->id}}">{{$product->name}}</option>
      @endforeach
      </select>
  </div>
  <div class="form-group">
    Strarted at
    <input type="date" name="date_start">
  </div>
  <div class="form-group">
    End date
    <input type="date" name="date_end">
  </div>
	<input type="hidden" name="strain_id" value="{{$strain_id}}">
  
  </div>

<button type="submit" name="submit" value="Ok" >Add Product</button>
</tr>
</form>

@endsection