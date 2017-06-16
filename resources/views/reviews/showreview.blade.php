
@extends('app')
@section('title')
@endsection
@section('content')
@include('reviews/reviewgallery')

<div>
    <div class="card hovercard">
      <div class="container-fluid">
          <a class="row"  data-toggle="modal" data-target="#gallerymodal" href="#">
            <img class="img-responsive thumbnail center-block" src="{{$review->background_image_url}}"  alt="{{$review->updated_at->format('Y-m-d')}}" width="700" height="500">
          </a>
        <hr>
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
                    <img class="img-circle" src="{{$author->avatar_url}}"  width="100" height="100">
                    <td><h4>Name</h4>{{$author->user_name}}</td>
                    <td><h4>Growing Since</h4>{{$author->growing_since}}</td>

                </div>
                <div class="collapse" id="tab2">
                    <h3>Crops</h3>
                    @if($owns_review)
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addStrainModal">Add new Crop</button>
                    @endif
                    @include('strains/addstrainmodal', array('review_id' => $review->id))
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
