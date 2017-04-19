@extends('app')
@section('title')
@endsection
@section('content')

<div>
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="http://cdn.playbuzz.com/cdn/68712582-6158-416e-a169-bb07eadcf0bd/8be9603b-1a82-42f6-804c-face8b7a0f49_560_420.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="http://cdn.playbuzz.com/cdn/68712582-6158-416e-a169-bb07eadcf0bd/8be9603b-1a82-42f6-804c-face8b7a0f49_560_420.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="http://cdn.playbuzz.com/cdn/68712582-6158-416e-a169-bb07eadcf0bd/8be9603b-1a82-42f6-804c-face8b7a0f49_560_420.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="http://cdn.playbuzz.com/cdn/68712582-6158-416e-a169-bb07eadcf0bd/8be9603b-1a82-42f6-804c-face8b7a0f49_560_420.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="98" height="100">
            <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="98" height="100">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>

        <div class="card-info"> <span class="card-title"><h2>{{$review->title}}</h2></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Author info</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs">Grow info</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <div class="hidden-xs">Products</div>
            </button>
        </div>
    </div>

        <div class="well">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="tab1">
              <tr>
                <img class="card-bkimg" alt="" src="https://68.media.tumblr.com/4a03ed0af43c1721d8c3c8e7b3870d14/tumblr_nlabfnp8Ro1tr4gulo1_500.jpg" width="50" height="50">
                <td><h4>Name</h4>{{$author->user_name}}</td>
                <td><h4>Srowing Since</h4>{{$author->growing_since}}</td>
              </tr>
            </div>
            <div class="tab-pane fade in" id="tab2">
              <tr>
                <td><h4>Strain Number</h4>{{$strain_count}}</td>
                <td><h4>Setup:</h4></td>
                @foreach($strains as $strain)
                @if($strain->light_type == 'Sun')
                <td>{{$strain->strain_name}} from {{$strain->bank}} with {{$strain->technique}} under {{$strain->light_type}}</td><br>
                @else
                <td>{{$strain->strain_name}} from {{$strain->bank}} with {{$strain->technique}} under {{$strain->light_type}} with {{$strain->light_power}} Watts</td><br>
                @endif
                @endforeach
                <td><h4>Date init</h4>{{$review->created_at}}</td>
              </tr>
            </div>
            <div class="tab-pane fade in" id="tab3">
              <h3>This is tab 3</h3>
            </div>
          </div>
        </div>
      <div >
        <h3>Comentarios</h3>
        <ul class="comments-list">
          @foreach($comments as $comment)
            <tr class="comment">
                <a class="pull-left" href="#">
                    <img class="avatar" src="http://www.31minutos.cl/wp-content/uploads/2014/02/thumb-bodoque-300x300.jpg" alt="avatar" width="50" height="50">
                </a>
                <div class="comment-body">
                    <div class="comment-heading">
                        <h4 class="user">{{$author->user_name}}</h4>
                        <h6 class="time">{{$comment->created_at}}</h5>
                    </div>
                    <p>{{$comment->body}}</p>
                </div>
            </tr>
          @endforeach
        </ul>
      </div>

    </div>



@endsection
