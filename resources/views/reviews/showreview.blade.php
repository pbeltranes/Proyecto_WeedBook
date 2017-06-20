
@extends('app')
@section('title')
@endsection
@section('content')

    <div>
      <div class="card hovercard">
            <div class="container-fluid ">
                <img src="{{$url.$review->background_image_url}}"  class="img-responsive thumbnail center-circle" style="height:auto; display:block;" alt="{{$review->updated_at->format('Y-m-d')}}">
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
                <div class="row">
                    <div class="row-xs-1">
                      <div class="container-fluid">
                        <h3>Author</h3>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="container-fluid">
                        <img class="img-circle img-responsive center-block img-thumbnail" width="120" src="{{$url.$author->avatar_url}}">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="container-fluid">
                        <td><h4>Name</h4>{{$author->user_name}}</td>
                      </div>
                      <div class="container-fluid">
                        <td><h4>Growing Since</h4>{{$author->growing_since}}</td>
                      </div>
                    </div>
                </div>
                <hr></hr>
            </div>
            <div class="collapse" id="tab2">
              <div class="row">
                <div class="container-fluid">
                    <h3>Crops</h3>
                </div>
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-xs-5">
                        <h4>Total of Crops: {{$strain_count}}</h4>
                      </div>
                      <div class="col-xs-3">
                        @if($owns_review)
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addStrainModal">Add new Crop</button>
                        @endif
                        @include('strains/addstrainmodal', array('review_id' => $review->id,
                        'api_banks' => $api_banks,
                        'api_strains' => $api_strains,
                        ))
                      </div>
                    </div>
                    <div  class="row">
                      <div class="col-xs-5">
                          <h4>Date init</h4>
                      </div>
                      <div class="col-xs-5">
                        <div class="container-fluid">
                          <h5>{{$review->created_at->format('Y-m-d')}}</h5>
                        </div>
                      </div>
                    </div>
                </div>
                  <div class="container-fluid">
                    <h3>Setup:</h3>
                  </div>
                  <div class="container-fluid">
                    <div class="row">
                      <?php $actually = ''; $cont = -1; $s = 0; $u = 0?>
                      @foreach($strains as $strain)
                      @if( $strain->strain_name != $actually)
                      <?php $actually = $strain->strain_name;  $cont++;?>
                      <div class="col-xs-5">
                          <h4>- {{$strain->strain_name}}</h4>
                        </div>
                        <div class="col-xs-3">
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal{{$strain->id}}">Information</button>
                          @include('strains/viewstrain', array(['strain' => $strain,
                          'updates' => $strain_updates,
                          ]))
                          @endif
                          @endforeach
                      </div>
                    </div>
                  </div>
              </div>
              <hr></hr>
            </div>
            <div class="collapse" id="tab3">
              <div class="row">
                <div class="container-fluid">
                  <h3>Products </h3>
                </div>
                <div class="container-fluid">
                  @foreach($strains as $strain)
                  <div class="row">
                    <div class="col-xs-5">
                      <h4>{{$strain->strain_name}}:</h4>
                    </div>
                    @if($owns_review)
                    <div class="col-xs-5">
                      <a href="{{url('strain/' . $strain->id . '/add-product')}}"><button type="button" class="btn btn-sm btn-info"> Add Product</button></a>
                    </div>
                    @endif
                    @foreach($products_on_strain as $prod)
                      @if($prod->id == $strain->id)
                    <h5>- {{$prod->name}}</h5>
                      @endif
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </div>
              <hr></hr>
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
            <div class="row">
              <div class="col-sm-1">
                <a>
                  <img class=" img-circle" src="{{$comment->avatar_url}}" width="75" height="75">
                </a>
              </div><!-- /col-sm-1 -->

              <div class="col-sm-8">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="row">
                      <div class="col-sx-2 col-sm-2">
                        <strong>{{$comment->user_name}}</strong>
                      </div>
                      <div class="col-xs-2 col-sm-4">
                        <span class="text-muted">
                          <small>commented {{$comment->created_at->format('Y-m-d')}}</small>
                        </span>
                      </div>

                      @if(Auth::guest())
                           <div class="col-xs-3 col-lg-2 pull-right">
                             <form class="form-group " role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                               {!! csrf_field() !!}
                               <div class="form-group">
                                 <button class="btn btn-primary btn-xs fa fa-thumbs-o-up">
                                   <span>{{$comment->upvotes}}like</span>
                                 </button>
                               </div>
                             </form>
                           </div>
                     @elseif(Auth::user())
                         <div class="col-xs-3 col-lg-2 pull-right">
                           <form class="form-group" role="form" method="POST"   action="/comment/vote/{{$comment->id}}/{{$review->id}}">
                             {!! csrf_field() !!}
                             <div class="form-group">
                                <button class="btn btn-primary btn-xs fa fa-thumbs-o-up" >
                                  <span>{{$comment->upvotes}}</span> like
                                </button>
                             </div>
                           </form>
                         </div>
                         @if($comment->from_user == Auth::user()->id)
                         <div class="col-xs-1 col-xs-2 pull-right">
                             <a type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#Modal{{$comment->id}}">Edit</a>
                         </div>
                         <div class="col-xs-2 col-lg-1 pull-right">
                           <form class="form-group"  role="form"  method="GET" action="/comment/delete/{{$comment->id}}/{{$review->id}}">
                             <div class="form-group">
                               <button class="btn btn-danger btn-xs" >Delete</button>
                             </div>
                           </form>
                         </div>

                         <!-- inicio Modal editar -->
                         <div id="Modal{{$comment->id}}" class="modal fade" role="dialog">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <!-- Modal content-->
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Edit Comment</h4>
                               </div>
                               <div class="modal-body">
                                 <div class="container-fluid">
                                   <div class="row">
                                     <form class="form-group-lg " role="form" method="POST" action="/comment/update/{{$review->id}}/{{$comment->id}}">
                                       {!! csrf_field() !!}
                                       <div class="form-group">
                                          <div class="col-xs-10">
                                             <textarea class="form-control"  style ="font-size:13px;" name ="commentedit">{{$comment->body}}</textarea>
                                          </div>
                                        </div>
                                        <div class="col-xs-2">
                                          <button class="btn btn-lg btn-success" >Save</button>
                                        </div>
                                   </form>
                                  </div>
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
                  </div>
                  <div class="panel-body">
                    {{$comment->body}}

                  </div><!-- /panel-body -->
                </div><!-- /panel panel-default -->
              </div><!-- /col-sm-5 -->
            </div>

            <br>
          @endforeach
          <br>
          <div class="row">
            <div class="container-fluid">
              <form class="form-group-lg col-md-9 " role="form" method="POST" action="/comment/save/{{$review->id}}">
                {!! csrf_field() !!}
                <div class="form-group">
                  <textarea class="form-control" rows="3" cols="2" style = "font-size:13px;" name="comment"></textarea>
                </div>
                <div class="form-group">
                  <button class="btn btn-success" >Submit</button>
                </div>
              </form>
            </div>
          </div>
        </ul>
@endsection
