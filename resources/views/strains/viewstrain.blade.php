                
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
                      <a href="#" data-toggle="popover" title="Crops of this type:" data-content="{{$cantidad[$cont]->counter}}"><button type="button" class="btn btn-success btn-circle btn-lg"><i class="fa fa fa-leaf" aria-hidden="true"></i></button></a>
                      <a href="#" data-toggle="popover" title="Light setup:" data-content="{{$strain->light_type}}"><button type="button" class="btn btn-info btn-circle btn-lg"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></button></a>
                      <a href="#" data-toggle="popover" title="Light power:" data-content="{{$strain->light_power}} Watts"><button type="button" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-bolt" aria-hidden="true"></i></button></a>
                      <a href="#" data-toggle="popover" title="Bank:" data-content="{{$strain->bank}}"><button type="button" class="btn btn-default btn-circle btn-lg"><i class="fa fa-envira" aria-hidden="true"></i></button></a>
                        <!-- <p><i class="fa fa fa-leaf"> Crops of this type: {{ $cantidad[$cont]->counter}}</i></p>
                        <p><i class="fa fa-lightbulb-o"> Light Type: {{$strain->light_type}}</i></p>
                        <p><i class="fa fa-bolt"> Watts: {{$strain->light_power}}</i></p>
                        <p><i class="fa fa-envira"> Bank: {{$strain->bank}}</i></p> -->
                        <script>
                          $(document).ready(function(){
                            $('[data-toggle="popover"]').popover();   
                          });
                        </script>
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
                                  <div class="col-md-8  col-xs-12 update-strain-img">
                                    <img src="{{$update->update_image_url}}" class="img-thumbnail picture hidden-xs" />
                                  </div>
                                     <div class="col-md-8 update-amb">
                                          <!-- <h1>Lorem Ipsum</h1> -->
                                          <h4>Crop Variables</h4>
                                          <span><i class="fa fa-arrows-v" aria-hidden="true">-{{$update->height}}</i>m of height</span><br>
                                          <span><i class="fa fa-hourglass-end" aria-hidden="true">-{{$update->stage}}</i> Stage</span><br>
                                          <span><i class="fa fa-thermometer-half" aria-hidden="true">-20</i>ºC</span><br>
                                          <span><i class="fa fa-tint" aria-hidden="true">-55</i>% Air humidity</span>
                                     </div>
                                     <div class="col-md-8 update-schedule">
                                          <!-- <h1>Lorem Ipsum</h1> -->
                                          <h4>Schedule</h4>
                                          <span><i class="fa fa-sun-o" aria-hidden="true">-{{$update->light_time}}</i>Hrs of light</span><br>
                                          <span><i class="fa fa-moon-o" aria-hidden="true">-{{$update->darkness_time}}</i>Hrs of darkness</span><br>
                                          <span><i class="fa fa-flask" aria-hidden="true">-{{$update->veg_prod_quantity}}</i>ml/L of vegetation product</span><br>
                                          <span><i class="fa fa-flask" aria-hidden="true">-{{$update->flow_prod_quantity}}</i>ml/L of flowering product</span><br>
                                          <span><i class="fa fa-flask" aria-hidden="true">-{{$update->other_prod_quantity}}</i>ml/L of other product</span>
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
