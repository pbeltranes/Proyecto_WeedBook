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

<div class="w3-row-padding">
    @foreach( $reviews as $review )
    <?php $back = $review->background_image_url ? $review->background_image_url : 'http://www.acnur.org/fileadmin/Images/ACNUR/noticias/2016/Octubre_2016/5809ae163.jpg';  ?>

      <div class="w3-third w3-container w3-margin-bottom">
        <a href='{{url("/review/".$review->id)}}'>  <img src="{{$back}}" alt="Norway" style="border-radius: 50%;
          overflow: hidden;
          width: 150px;
          height: 150px;" class="w3-hover-opacity"> </a>
          <div class="w3-container w3-white">
            <p>  </p>
            <p><b>{{$review->title}}</b></p>

            <div class="w3-row-padding">
          <div class="w3-third w3-container w3-margin-bottom">

               <button class="btn" style="float: right"><a href="{{ url( '/review/' .$review->id. '/edit') }}">Edit Post</a></button>
            </div>
            
              <div class="w3-third w3-container w3-margin-bottom">
                <button class="btn" style="float: right"><a href="{{ url( '/review/' .$review->id. '/edit') }}">Update History</a></button>
              </div>


            <div class="w3-third w3-container w3-margin-bottom">
              <button class="btn" style="float: right"><a href="{{ route('showreview',['$id' => $review->id]) }}">View Review</a></button>


              </div>
          </div>
        Edit:  {!! str_limit($review->updated_at, $limit = 1500, $end = '....... <a href='.url("/".$review->title).'>Read More</a>') !!}
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
