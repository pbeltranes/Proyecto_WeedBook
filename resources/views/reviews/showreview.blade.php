
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
              <img src="{{$review->background_image_url}}" class="center-block" alt="...">
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

          <div class="card-info">
            <span class="card-title"><h2>{{$review->title}}</h2></span>
          </div>
          @if($owns_review)
          @include('update/update', array([
                                      'strains' => $strains,
                                      'review' => $review,
                                    ]))
            @if($strain_count > 0)
              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateModal">Update Review</button>
            @endif
          @endif
    </div>

    </h2></span></div>
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
                <img class="img-circle" src="{{$author->avatar_url}}"  width="100" height="100">
                <td><h4>Name</h4>{{$author->user_name}}</td>
                <td><h4>Growing Since</h4>{{$author->growing_since}}</td>

            </div>
            <div class="collapse" id="tab2">
                <h3>Crops</h3>
                @if($owns_review)
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addStrainModal">Add new Crop</button>
                @endif
                @include('strains/addstrainmodal', array('review_id' => $review->id,
                                                          'api_banks' => $api_banks,
                                                          'api_strains' => $api_strains,
                                                          ))
                <tr>
                <h4>Total of Crops: {{$strain_count}}</h4>
                <td><h4>Setup:</h4></td>
                <?php $actually = ''; $cont = -1; $s = 0; $u = 0?>
                @foreach($strains as $strain)
                  @if( $strain->strain_name != $actually)
                  <?php $actually = $strain->strain_name;  $cont++;?>
                <h4>-{{$strain->strain_name}}</h4>

                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$strain->id}}">Information</button>
                @include('strains/viewstrain', array(['strain' => $strain,
                                                      'updates' => $strain_updates,
                                                      ]))

                @endif
                @endforeach
                <td><h4>Date init</h4>{{$review->created_at}}</td>
              </tr>
            </div>
            <div class="collapse" id="tab3">
              <h3>Products </h3>
              @foreach($strains as $strain)
                <h4>{{$strain->strain_name}}
                @if($owns_review)
                <a href="{{url('strain/' . $strain->id . '/add-product')}}"><button type="button" class="btn btn-default"> Add Product</button></a>:
                </h4>
                @endif
                @foreach($products_on_strain as $prod)
                  @if($prod->id == $strain->id)
                <h5>- {{$prod->name}}</h5>
                  @endif
                @endforeach
              @endforeach
            </div>
          </div>
      </div>



        <h3 class="box-content bottom">Comments</h3>
        <ul class="media-list">
          @if(Auth::guest())
          <h5 class="bg-info">Login! if you want comment or publish a review</h5>
          @endif

          @foreach($comments as $comment)
            <hr></hr>
            <div class = "row pull-left">
            @if(Auth::guest())
                  <div class="col-md-3">
                    <form class="form-group " role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                      {!! csrf_field() !!}
                      <div class="form-group">
                        <button class="btn btn-primary btn-xs fa fa-thumbs-o-up" style="float: right">{{$comment->upvotes}}like </button>
                      </div>
                    </form>
                  </div>
            @elseif(Auth::user())
            <div class = "row pull-left">
                <div class="col-md-3">
                  <form class="form-group" role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                      <button class="btn btn-primary btn-xs fa fa-thumbs-o-up" style="float: right">'{{$comment->upvotes}}' like </button>
                    </div>
                  </form>
                </div>
                @if($comment->from_user == Auth::user()->id)
                <div class="col-md-3 ">
                  <div class="center-block pull-right" style="margin-top: 0px; padding-top: 14px;">
                    <button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#Modal{{$comment->id}}">Edit</button>
                  </div>
                </div>
                <div class="col-md-3">
                  <form class="form-group"  role="form"  method="GET" action="/comment/delete/{{$comment->id}}/{{$review->id}}">
                    <div class="form-group" style=" margin-top: 14px;">
                      <button class="btn btn-danger btn-xs" style="float: right " >Delete</button>
                    </div>
                  </form>
                </div>

                <!--inicio Modal editar -->
                <div id="Modal{{$comment->id}}" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content-->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit Comment</h4>
                      </div>
                      <div class="modal-body">
                        <div class="container">
                          <form class="form-group-lg col-xs-6 " role="form" method="POST" action="/comment/update/{{$review->id}}/{{$comment->id}}">
                            {!! csrf_field() !!}
                            <div class="form-group">
                              <textarea class="form-control" rows="4" cols="12" style ="font-size:13px;" name ="commentedit">{{$comment->body}}</textarea>
                            </div>
                            <button class="btn btn-success" >Save</button>
                          </form>
                        </div>
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- fin Modal editar -->

                @endif
            @endif
                </div>
<<<<<<< HEAD

            <div class="row">
              <div class="col-sm-1">
                <a>
                  <img class=" img-circle" src="{{$comment->avatar_url}}" width="70" height="70">
                </a><!-- /thumbnail -->
              </div><!-- /col-sm-1 -->

              <div class="col-sm-5">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <strong>{{$comment->user_name}}</strong> <span class="text-muted"><small> commented {{$comment->created_at->format('Y-m-d')}}</small></span>
                  </div>
                  <div class="panel-body">
                    {{$comment->body}}
                    <div class="footer">
                      Aqui deberia ir los botones
=======
                <li class="media">


                    <div class="media-left media-middle">
                      <a>
                        <img class=" img-circle" src="{{$comment->avatar_url}}" alt="avatar" width="65" height="65">
                      </a>
                    </div>
                    <div class="media-body">


                      <h5 class="media-heading">{{$comment->user_name}}<h6 class="date" style="color:#aaa; font-family:verdana; font-size:10px;">commented on {{$comment->created_at}}</h6></h5>
                    </div>
                    <div class="media-middle">
                      <h4>{{$comment->body}}</h4>
>>>>>>> 7355b4fe42304bb612d4852d521e73caac09fc83
                    </div>
                  </div><!-- /panel-body -->
                </div><!-- /panel panel-default -->
              </div><!-- /col-sm-5 -->
            </div>

                <!-- fin comentario prueba -->
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
