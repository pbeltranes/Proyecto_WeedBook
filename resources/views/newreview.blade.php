@extends('app')
@section('title')
<td><p>Review </p></td>
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
      Type of cutlive
        <select name="state" class="form-control">
          <option value="{{ old('state') }}">Hidroponico</option>
          <option value="{{ old('state') }}">Interior</option>
          <option value="{{ old('state') }}">Exterior</option>
          <option value="{{ old('state') }}">Otro</option>
      </select>
  </div>
<div class="form-group">
  Plant

  <div class="form-group">
    Strain name
    <input type="text" name="strain_name" value="{{ old('strain_name') }}" class="form-control"/>
  </div>

  <div class="form-group">
    Bank
      <input type="text" name="bank" value="{{ old('bank') }}" class="form-control" />
  </div>

  <div class="form-group">
    Seed type
      <select name="seed_type" class="form-control">
        <option value="{{ old('seed_type') }}">Sativa</option>
        <option value="{{ old('seed_type') }}">Indica</option>
        <option value="{{ old('seed_type') }}">Otra</option>
      </select>
  </div>


  <div class="form-group">
    Grow type
      <select name="grow_type" class="form-control">
        <option value="{{ old('grow_type') }}">Feminizada</option>
        <option value="{{ old('grow_type') }}">Automatica</option>
        <option value="{{ old('grow_type') }}">Regular</option>
      </select>
  </div>
  <div class="form-group">
      Type of technique
    <select name="technique" class="form-control">
      <option value="{{ old('technique') }}">Apical</option>
      <option value="{{ old('technique') }}">F.I.M.</option>
      <option value="{{ old('technique') }}">Lollypop</option>
      <option value="{{ old('technique') }}">Lst</option>
      <option value="{{ old('technique') }}">Otra</option>
      <option value="{{ old('technique') }}">Ninguna</option>
    </select>
  </div>

  <div class="form-group">
    Germination date (ej: xx-xx-xxxx)
    <input type="date" name="germ_date" value="{{ old('germ_date') }}" class="form-control">
  </div>
  <div class="form-group">
    Vegetation date (ej: xx-xx-xxxx)
    <input type="date" name="veg_start" value="{{ old('veg_start') }}"class="form-control">
  </div>
  <div class="form-group">
    Floration date (ej: xx-xx-xxxx)
    <input type="date" name="flow_start" value="{{ old('flow_start') }}" class="form-control">
  </div>
  <div class="form-group">
    Harvest date (ej: xx-xx-xxxx)
    <input type="date" name="harvest_date" value="{{ old('harvest_date') }}" class="form-control">
  </div>
</div>
  <button type="submit">Save Changes</button>
</tr>
</form>
@endsection
