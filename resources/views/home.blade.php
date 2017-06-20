@extends('app')
@section('title')
<center>
  {{$title}}
</center>
@endsection
@section('content')
@if ( !$reviews->count() )
There is no reviews till now. Login and write a new post now!!!
@else

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
  $aux = 0;
?>

<div class="w3-row-padding">
  @foreach( $reviews as $review )
  <?php
  $back = $url.$review->background_image_url;

  ?>
    <div class="w3-third w3-container w3-margin-bottom">

      <center>
        <a href='{{url("/review/".$review->id )}}'>
          <img src="{{ $back }}" class="img-circle img-thumbnail center-block w3-hover-opacity" > </a>
      </center>
      <div class="w3-container w3-white">
        <p>  </p>
        <p><b>{{$review->title}}</b></p>
        <p>Grower <b><a href="{{ url('user/' . $review->user_id . '')}}">
         {{$review->user_name }}</a></b></p>
         <p>Reputation: {{$review->C ? $review->C : 0}}</p>
        <p align="justify" >News: Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
      </div>
    </div>

    <?php
      $aux++;
      if($aux == 3){
        echo "</div>";
        echo '<div class="w3-row-padding">';
        $aux = 0;
      }
    ?>
  @endforeach
</div>
@endif
@endsection
