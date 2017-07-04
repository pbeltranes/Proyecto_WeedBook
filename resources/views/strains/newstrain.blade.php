@extends('app')
@section('title')
Add a new strain to your grow
@endsection
@section('content')
<form action="/review/save-strain" method="POST">
{!!csrf_field()!!}
<tr>
	<div class="form-group">
		<div class="form-group">
			Strain name
			<!-- <input type="text" name="strain_name" value="{{ old('strain_name') }}" class="form-control"/> -->
			<select class="chosen-select chosen-rtl" name="strain_name">
			@foreach($api_strains as $strain)
				<option value = "{{$strain->name}}">{{$strain->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			Bank
				<!-- <input type="text" name="bank" value="{{ old('bank') }}" class="form-control" /> -->

			<select class="chosen" name="bank">
			@foreach($api_banks as $bank)
				<option value = "{{$bank->name}}">{{$bank->name}}</option>
				@endforeach
			</select>
		</div>

  <div class="form-group">
    Seed type
      <select name="seed_type" class="form-control">
        <option disabled selected>-- Select an Option --</option>
        <option value="Fem">Feminized</option>
        <option value="Auto">Autoflowering</option>
        <option value="Regular">Regular</option>
      </select>
  </div>


  <div class="form-group">
    Grow type
      <select name="grow_type" class="form-control">
      <option disabled selected>-- Select an Option --</option>
        <option value="Hidroponic">Hidroponic</option>
        <option value="Indoor">Indoor</option>
        <option value="Outdoor">Outdoor</option>
        <option value="Other">Other</option>
      </select>
  </div>
  <div class="form-group">
      Type of technique
    <select name="technique" class="form-control">
      <option disabled selected>-- Select an Option --</option>
      <option value="Apical">Apical</option>
      <option value="FIM">F.I.M.</option>
      <option value="Lollypop">Lollypop</option>
      <option value="LST">Lst</option>
      <option value="Other">Other</option>
      <option value="None">Neither</option>
    </select>
  </div>

    <div class="form-group">
      Light Setup
    <select name="light_type" class="form-control" id="lightSetup">
      <option disabled selected>-- Select an Option --</option>
      <option value="LED">LED Pannel</option>
      <option value="HPS/HM">HPS/HM Lamps</option>
      <option value="Sun">Sunlight</option>
    </select>
  </div>

    <div class="form-group" id="lightPower">
      Light Power in Watts
      <input type="number" name="light_power" value="{{old('light_power')}}">
  </div>


	<div class="form-group">
		Plants of this type
		<input type="number" name="nro_strains" value="{{old('light_power')}}">
	</div>
	<input type="hidden" name="review_id" value="{{$review_id}}">

</div>
<button type="submit" name="submit" value="Other" >Add Other Strain</button>
<button type="submit" name="submit" value="Ok" >Create Strain</button>
</tr>
</form>

@endsection
