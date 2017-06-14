                
                <link href="{{ URL::to('/') }}/css/showstrain.css" rel="stylesheet">
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
                        <p><i class="fa fa fa-leaf"> Crops of this type: {{ $cantidad[$cont]->counter}}</i></p>
                        <p><i class="fa fa-lightbulb-o"> Light Type: {{$strain->light_type}}</i></p>
                        <p><i class="fa fa-bolt"> Watts: {{$strain->light_power}}</i></p>
                        <p><i class="fa fa-envira"> Bank: {{$strain->bank}}</i></p>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$strain->id}}">Detailed Info</a>
                        
                        <div id="collapse{{$strain->id}}" class="panel-collapse collapse">
                          <div class="panel-body">
                            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="..." >
                              @if(sizeof($strain_updates) < 1)
                                No new updates :(
                              @else
                              <?php $week_count = 1 ?>
                              <ul class="nav nav-tabs">
                              @foreach($strain_updates as $update)
                              @if($update->id == $strain->id)
                                <li><a data-toggle="tab" href="#{{$update->id}}week{{$week_count}}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Week {{$week_count}}</a></li>
                                <?php $week_count++; ?>
                                @endif
                                @endforeach
                              </ul>

                                <?php $week_count = 1 ?>
                              <div class="tab-content">
                                @foreach($strain_updates as $update)
                                @if($update->id == $strain->id)
                                <div id="{{$update->id}}week{{$week_count}}" class="tab-pane fade">
                                <p>This week {{$strain->strain_name}}'s had</p>
<!-- 
                                  <button type="button" class="btn btn-default btn-circle btn-xl"><i class="fa fa-moon-o"><br>{{$update->darkness_time}} hrs</i></button>
                                  <button type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-sun-o"></i><br>{{$update->light_time}} hrs</button>
                                  <button type="button" class="btn btn-success btn-circle btn-xl"><i class="fa fa-arrows-v"></i><br>{{$update->height}} m</button>
                                  <button type="button" class="btn btn-info btn-circle btn-xl"><i class="fa fa-hourglass-end"></i><br>{{$update->stage}}</button>
                                  <button type="button" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-flask"></i><br>{{$update->veg_prod_quantity}} ml/L</button>
                                  <button type="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-flask"></i><br>{{$update->flow_prod_quantity}} ml/L</button>
                                  <button type="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-flask"></i><br>{{$update->other_prod_quantity}} ml/L</button>
                                   -->
                                  <div class="container">
                                    <div class="row">    
                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-moon-o"></i></div>
                                          <div class="update-text">{{$update->darkness_time}} Hours of darkness</div>
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-sun-o"></i></div>
                                          <div class="update-text">{{$update->light_time}} Hours of light</div>
                                        </div>
                                      </div>
                                      
                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-arrows-v"></i></div>
                                          <div class="update-text">{{$update->height}} m long</div>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-hourglass-end"></i></div>
                                          <div class="update-text">{{$update->stage}} period</div>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-flask"></i></div>
                                          <div class="update-text">{{$update->veg_prod_quantity}} ml/L of vegetation product</div>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-flask"></i></div>
                                          <div class="update-text">{{$update->flow_prod_quantity}} ml/L of flowering product</div>
                                        </div>
                                      </div>

                                      <div class="col-md-12">
                                        <div class="update-nag">
                                          <div class="update-split"><i class="fa fa-flask"></i></div>
                                          <div class="update-text">{{$update->other_prod_quantity}} ml/L of other products</div>
                                        </div>
                                      </div>


                                    </div>
                                  </div>
                                </div>
                                <?php $week_count++; ?>
                                @endif
                                @endforeach
                              </div>
                            </div>
                              @endif
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
