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
    <div class="w3-third w3-container w3-margin-bottom">
      <img src="/w3images/mountains.jpg" alt="IMG1" style="width:20%" class="w3-hover-opacity">
      <div class="w3-container w3-white">
        <p><b>{{$post->title}}</b></p>
        <p>{!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Read More</a>') !!}</p>
          @if(!Auth::guest() && ($post->author_id == Auth::user()->id ))
            @if($post->active == '1')
            <button class="btn"><a href="{{ url('edit/'.$post->slug)}}">Edit Post</a></button>
            @else
            <button class="btn"><a href="{{ url('edit/'.$post->slug)}}">Edit Draft</a></button>
            @endif
          @endif
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