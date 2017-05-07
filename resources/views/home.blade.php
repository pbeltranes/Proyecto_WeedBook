@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')
@if ( !$reviews->count() )
There is no reviews till now. Login and write a new post now!!!
@else
<?php
  $aux = 1;
?>
<div class="w3-row-padding">
  @foreach( $reviews as $post )
  <?php $back = $post->background_image_url ? $post->background_image_url : 'http://www.acnur.org/fileadmin/Images/ACNUR/noticias/2016/Octubre_2016/5809ae163.jpg';  ?>
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="{{$back}}" alt="Background" style="border-radius: 50%;
        overflow: hidden;
        width: 150px;
        height: 150px;" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b><h4>{{$post->title}}</h4></b></p>
        <p><a href='{{url("/review/".$post->id)}}'>Read More</a></p>
      </div>
    </div>

    <?php
      $aux = $aux + 1;
      if($aux == 3){
        echo "</div>";
        echo '<div class="w3-row-padding">';
      }
    ?>
  @endforeach
</div>
@endif
@endsection
