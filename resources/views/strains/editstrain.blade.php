@extends('app')
@section('title')
<td><p>Editing Strains</p></td>
@endsection

@section('content')
<!--agregar condicion de verificacion de campo vacio-->

<form method="POST" action="/strain/edit/save">
    {!! csrf_field() !!}

<tr>
  <?php $actually = ''; $cont = 0;  ?>

    @foreach( $strain as $post )
    <tr>
      @if( $post->strain_name != $actually)
      <?php $actually = $post->strain_name ?>
      <div class="form-group">
        Name of your crop is: <b> {{ $actually = $post->strain_name }} </b>
          <input type="text" name="strain_name[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Bank of your crop is: <b>{{ $post->bank}}</b>
        <input type="text" name="bank[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Time of germination is: <b>{{ $post->germ_start}}</b>
        <input type="date" name="germ_start[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Time of vegetation start is: <b>{{ $post->veg_start}}</b>
        <input type="date" name="veg_start[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Type of technique actually is: <b>{{ $post->technique }}</b>
      <select name="technique[{{$cont}}]" class="form-control">
        <option disabled selected>-- Select an Option --</option>
        <option value="Apical">Apical</option>
        <option value="FIM">F.I.M.</option>
        <option value="Lollypop">Lollypop</option>
        <option value="LST">Lst</option>
        <option value="Other">Other</option>
        <option value="None">Neither</option>
      </select>
      </div>

      <div class = "form-group">
        Time of flow start is: <b>{{ $post->flow_start}}</b>
        <input type="date" name="flow_start[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Harvest date is: <b>{{ $post->harvest_date}}</b>
        <input type="date" name="harvest_date[{{$cont}}]" value="" class="form-control" />
      </div>

      <div class = "form-group">
        Grow type actually is: <b>{{ $post->grow_type}}</b>
        <select name="grow_type[{{$cont}}]" class="form-control">
        <option disabled selected>-- {{$post->grow_type}} --</option>
          <option value="Hidroponic">Hidroponic</option>
          <option value="Indoor">Indoor</option>
          <option value="Outdoor">Outdoor</option>
          <option value="Other">Other</option>
        </select>
      </div>

      <div class = "form-group">
        Seed type actually is: <b>{{ $post->seed_type}}</b>
        <select name="seed_type[{{$cont}}]" class="form-control">
          <option disabled selected>-- {{ $post->seed_type }} --</option>
          <option value="Fem">Feminized</option>
          <option value="Auto">Autoflowering</option>
          <option value="Regular">Regular</option>
        </select>
      </div>

      <div class = "form-group">
        Light type actually is: <b>{{ $post->light_type}}</b>
        <select name="light_type[{{$cont}}]" class="form-control">
          <option disabled selected>-- Select an Option --</option>
          <option value="LED">LED Pannel</option>
          <option value="HPS/HM">HPS/HM Lamps</option>
          <option value="Sun">Sunlight</option>
        </select>
      </div>

      <div class = "form-group">
        Light power actually is: <b>{{ $post->light_power}}</b>
        <input type="number" name="light_power[{{$cont}}]" value="" class="form-control" />
      </div>
      <div class = "form-group">
        Crop: <b>{{ $cantidad[$cont]->counter }}</b>

        <input type="number" name="nro_strains_changes[{{$cont}}]" value="" class="form-control" />
      </div>
    <div class = "form-group">
      Amount of crop this type changes: {{ $cantidad[$cont]->counter }}
      <br>
      <input type="radio" name="quanty_[{{$cont}}]" value="All" checked>All<br>
      <input type="radio" name="quanty_[{{$cont}}]" value="Any">Any<br>
      <input type="radio" name="quanty_[{{$cont}}]" value="Other"> Other<br>
    </div>
      <?php $cont = $cont +1 ?>
        <input type="hidden" name="total_strains[{{$cont}}]" value="">
      @endif
          </tr>
  @endforeach
      <input type="hidden" name="id" value="{{ $id_review }}">
      <button type="submit" name="submit" value="Finish" >Finish</button>
</tr>
</form>
@endsection
