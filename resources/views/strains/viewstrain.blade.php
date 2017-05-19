@extends('app')
@section('title')
@endsection
@section('content')

<?php $week = 1; ?>

<div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="..." >

	<div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-default " href="#tab0" data-toggle="tab"><span class="fa fa-user-circle" aria-hidden="true"></span>
                <div class="hidden-xs">General Info </div>
            </button>
 	</div>
 	@for($i = 0; $i < $update_count; $i++)
	<div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-default " href="#tab{{$week}}" data-toggle="tab"><span class="fa fa-user-circle" aria-hidden="true"></span>
                <div class="hidden-xs">Week{{$week}} </div>
            </button>
            {{$week++}}
 	</div>
 	@endfor
</div>



        <div class="well">
          	<div class="tab-content">
            	<div class="tab-pane fade in" id="tab0">
              <tr>
              		<p><i class="fa fa-lightbulb-o"> Light Type: {{$strain->light_type}}</i></p>   
                    <p><i class="fa fa-bolt"> Watts: {{$strain->light_power}}</i></p>
                    <p><i class="fa fa-envira"> Bank: {{$strain->bank}}</i></p>
              </tr>
             	</div>
			</div>
			@foreach ($strain_updates as $update)
          	<div class="tab-content">
            	<div class="tab-pane fade in" id="tab{{$week}}">
              <tr>
                <td><h4>Name</h4>test</td>
                <td><h4>Srowing Since</h4>test</td>
              </tr>
             	</div>
			</div>
			@endforeach
		</div>

@endsection