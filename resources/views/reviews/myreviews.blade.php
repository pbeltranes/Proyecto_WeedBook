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
      <p>
        <h3><a href="{{url('/review/'.$post->id) }}">    {{$post->title }}
</p>
        <?php $back = $post->background_image_url ? $post->background_image_url : 'http://www.acnur.org/fileadmin/Images/ACNUR/noticias/2016/Octubre_2016/5809ae163.jpg';  ?>
          <!--<button class="btn" style="float: right"><a href="{{ url('review/edit/'.$post->title)}}">Delete Post</a></button>-->

            <img src="{{ $back }}" alt="Background" style="
              border-radius: 50%;
                overflow: hidden;
                width: 150px;
                height: 150px; "  class="w3-hover-opacity">
              </a>
             <button class="btn" style="float: right"><a href="{{ url( '/review/' .$post->id. '/edit') }}">Edit Profile</a></button>
          <button class="btn" style="float: right"><a href="{{ route('showreview',['$id' => $post->id]) }}">View Post</a></button>
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
