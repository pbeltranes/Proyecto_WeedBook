@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')
@if ( !count($reviews) )
There is no reviews till now. Login and write a new post now!!!
@else


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
  $aux = 0;
?>

<div class="row">
    @foreach( $reviews as $review )
    <?php $back = $review->background_image_url ? $review->background_image_url : 'http://www.acnur.org/fileadmin/Images/ACNUR/noticias/2016/Octubre_2016/5809ae163.jpg';  ?>

      <div class="col-lg-4">
        <div class="row-lg-4">
          <div class="container-fluid">
            <a href='{{url("/review/".$review->id)}}'>
               <img src="{{$url.$back}}"class="img-circle img-responsive img-thumbnail center-block w3-hover-opacity">
            </a>
          </div>
        </div>
          <div class="row-lg-4">
            <div class="container-fluid">
                <div class="row">
                  <div class="col-xs-7">
                    <h4>{{$review->title}}</h4>
                  </div>
                  <div class="col-xs-5">
                    <h6>Edited: {{Carbon\Carbon::parse($review->updated_at)->format('Y-m-d') }}</h6>
                  </div>
                </div>
                <div class="row">
                  <div class="btn-group btn-group-justified">
                    <div class="btn-group" role="group">
                      <a class="btn btn-xs btn-info pull-left" role="button" href="{{ url( '/review/' .$review->id. '/edit') }}">
                        Edit Post
                      </a>
                    </div>
                    <div class="btn-group" role="group">
                      <a  class="btn btn-xs btn-info pull-left" role="button" href="{{ url( '/review/' .$review->id. '/edit') }}">
                        Update History
                      </a>
                    </div>
                    <div class="btn-group" role="group">
                      <a  class="btn btn-xs btn-info pull-left" role="button" href="{{ route('showreview',['$id' => $review->id]) }}">
                        View Review
                      </a>
                    </div>
                  </div>
                </div>

            </div>
        </div>
      </div>

    <?php
      $aux++;
      if($aux == 3){
        echo "</div>";
        echo '<div class="row">';
        $aux = 0;
      }
    ?>
  @endforeach
</div>
@endif
@endsection
