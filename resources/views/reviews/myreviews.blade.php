@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')
@if ( !count($reviews) )
There is no reviews till now. Login and write a new post now!!!
@else
<div class="">
  @foreach( $reviews as $post )
  <div class="list-group">
    <div class="list-group-item">
      <h3><a href="{{ url('/review/'.$post->id) }}">{{ $post->title }}</a>
          <!--<button class="btn" style="float: right"><a href="{{ url('review/edit/'.$post->title)}}">Delete Post</a></button>-->
          <button class="btn" style="float: right"><a href="{{ url('review/edit/'.$post->title)}}">Edit Post</a></button>
      </h3>
  </div>
    <div class="list-group-item">
      <article>
      Edit:  {!! str_limit($post->updated_at, $limit = 1500, $end = '....... <a href='.url("/".$post->title).'>Read More</a>') !!}
      </article>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
