
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
                                  <i class="fa fa-moon-o" aria-hidden="true">Darkness time: {{$update->darkness_time}} hrs</i><br>
                                  <i class="fa fa-sun-o" aria-hidden="true">Light time: {{$update->light_time}} hrs</i><br>
                                  <i class="fa fa-arrows-v" aria-hidden="true">Height: {{$update->height}} m</i><br>
                                  <i class="fa fa-hourglass-end" aria-hidden="true">Stage: {{$update->stage}}</i><br>
                                  <i class="fa fa-flask" aria-hidden="true">Vegetation stage product: {{$update->veg_prod_quantity}} ml/L</i><br>
                                  <i class="fa fa-flask" aria-hidden="true">Flowering stage product: {{$update->flow_prod_quantity}} ml/L</i><br>
                                  <i class="fa fa-flask" aria-hidden="true">Other product: {{$update->other_prod_quantity}} ml/L</i><br>


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
