
@extends('app')
@section('title')
@endsection
@section('content')

<div>
    <div class="card hovercard">
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            <li data-target="#carousel-example-generic" data-slide-to="4"></li>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="https://static.pexels.com/photos/27714/pexels-photo-27714.jpg" class="center-block" alt="...">
              <div class="carousel-caption">
                  <h5>Primer mes</h5>
              </div>
            </div>

            <div class="item">
              <img src="https://s-media-cache-ak0.pinimg.com/originals/d3/cf/13/d3cf133e1c5a4dc6b6e5bed8ce318cdc.jpg" class="center-block" alt="...">
              <div class="carousel-caption">
                <h5>segundo mes</h5>
              </div>
            </div>

            <div class="item">
              <img src="http://www.mrwallpaper.com/wallpapers/little-purple-flowers.jpg" class="center-block" alt="...">
              <div class="carousel-caption">
                <h5>tercer mes</h5>
              </div>
            </div>

            <div class="item">
              <img src="http://images5.aplus.com/uc-up/72406b0e-9ba9-40ab-9a76-7c700929f98d/72406b0e-9ba9-40ab-9a76-7c700929f98d.inline_yes" class="center-block" alt="...">
              <div class="carousel-caption">
                <h5>cuarto mes</h5>
              </div>
            </div>

            <div class="item bg-inverse">
              <img src="{{$review->background_image_url}}" class="center-block" alt="...">>
              <div class="carousel-caption">
                <h5>{{$review->updated_at->format('Y-m-d')}}</h5>
              </div>
            </div>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
      </div>
          <div class="card-info"> <span class="card-title"><h2>{{$review->title}}</h2></span></div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="..." >
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#tab1" aria-expanded="false" aria-controls="#collapseExample"><span class="fa fa-user-circle" aria-hidden="true"></span>
                <div class="hidden-xs">Author info</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#tab2" aria-expanded="false" aria-controls="#collapseExample"><span class="fa fa-envira" aria-hidden="true"></span>
                <div class="hidden-xs">Grow info</div>
            </button>
        </div>
        <div class="btn-group" role="group">

            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#tab3" aria-expanded="false" aria-controls="#collapseExample"><span class="fa fa-flask" aria-hidden="true"></span>

              <div class="hidden-xs">Products</div>
            </button>
        </div>

    </div>
      <div class="well">
          <div class="tab-content">
            <div class="collapse" id="tab1">
                <h3>Author</h3>
                <img class="img-circle" alt="" src="{{$author->avatar_url}}" width="100" height="100">
                <td><h4>Name</h4>{{$author->user_name}}</td>
                <td><h4>Srowing Since</h4>{{$author->growing_since}}</td>

            </div>
            <div class="collapse" id="tab2">
                <h3>Strain</h3>
              <tr>
                <h4>Number of strains: {{$strain_count}}</h4>
                <td><h4>Setup:</h4></td>
                @foreach($strains as $strain)

                <h4>-{{$strain->strain_name}}</h4>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$strain->id}}">Information</button>

                <!-- Modal -->
                <div id="myModal{{$strain->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{$strain->strain_name}}'s Information</h4>
                      </div>
                      <div class="modal-body">
                        <p><i class="fa fa-lightbulb-o"> Light Type: {{$strain->light_type}}</i></p>
                        <p><i class="fa fa-bolt"> Watts: {{$strain->light_power}}</i></p>
                        <p><i class="fa fa-envira"> Bank: {{$strain->bank}}</i></p>
                        <a href="{{url('review/strain/' . $strain->id)}}">Detailed Info</a>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>
                @endforeach
                <td><h4>Date init</h4>{{$review->created_at}}</td>
              </tr>
            </div>
            <div class="collapse" id="tab3">
              <h3>Products </h3>
            </div>
          </div>
      </div>
    </div>


        <h3 class="bg-primary">Comments</h3>
        <ul class="media-list">
          @foreach($comments as $comment)
            @if(Auth::guest())
                <h5 class="bg-info">Login! if you want comment or publish a review</h5>
                <div class = "row pull-right">
                  <div class="col-md-3">
                    <form class="form-group " role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                      {!! csrf_field() !!}
                      <div class="form-group">
                        <button class="btn btn-primary btn-xs fa fa-thumbs-o-up" style="float: right">'{{$comments_upvotes[$comment->id - 1]}}' like </button>
                      </div>
                    </form>
                  </div>
            @elseif(Auth::user())
            <div class = "row pull-right">
                <div class="col-md-3">
                  <form class="form-group " role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                      <button class="btn btn-primary btn-xs fa fa-thumbs-o-up" style="float: right">'{{$comments_upvotes[$comment->id - 1]}}' like </button>
                    </div>
                  </form>
                </div>
                @if($comment->from_user == Auth::user()->id)
                  <div class="col-md-3">
                    <form class="form-group " role="form" method="GET"   action="{{ route('edit',['review_id' =>$review->id, 'comment_id'=> $comment->id, 'author_id'=> $comment->from_user]) }}">
                      <div class="form-group">
                        <button class="btn btn-success btn-xs" style="float: right" >Edit</button>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-3">
                    <form class="form-group " role="form" method="GET"   action="/comment/delete/{{$comment->id}}/{{$review->id}}">
                      <div class="form-group">
                        <button class="btn btn-danger btn-xs" style="float: right" >Delete</button>
                      </div>
                    </form>
                  </div>
                @endif
            @endif
                </div>
                <li class="media">


                    <div class="media-left media-middle">
                      <a>
                        <img class="img-circle media-object" src="{{$comment->avatar_url}}" alt="avatar" width="65" height="65">
                      </a>
                    </div>
                    <div class="media-body">


                      <h5 class="media-heading">{{$comments_authors[$comment->id - 1]->user_name}}<h6 class="date" style="color:#aaa; font-family:verdana; font-size:10px;">commented on {{$comment->created_at}}</h6></h5>
                    </div>
                    <div class="media-middle">
                      <h4>{{$comment->body}}</h4>
                    </div>
                </li>
            <br>
          @endforeach
          <br>
            <form class="form-group-lg col-xs-6 " role="form" method="POST" action="/comment/save/{{$review->id}}">
              {!! csrf_field() !!}
              <div class="form-group">
                <textarea class="form-control" rows="3" cols="2" style = "font-size:13px;" name="comment"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-success" >Submit</button>
              </div>
            </form>
        </ul>
      </div>
    </div>


@endsection
