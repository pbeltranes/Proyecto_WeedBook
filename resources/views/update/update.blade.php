
                <!-- Modal -->
                <div id="updateModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New week entry</h4>
                      </div>
                      <div class="modal-body">
                      <div class="container" id="myWizard">
                        <div class="navbar">
                          <div class="navbar-inner">
                            <ul class="nav nav-pills">
                              <li class="active"><a href="#reviewUpdate" data-toggle="tab">What's new</a></li>
                              @foreach($strains as $strain)
                              <li><a href="#strain{{$strain->id}}" data-toggle="tab">{{$strain->strain_name}}</a></li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                          
                        <div class="tab-content">
                          <div class="tab-pane active" id="reviewUpdate">
                            <form action="/review/{{$review->id}}/add-update" method="POST">
                            {!!csrf_field()!!}
                              <div>
                                What's new?
                                <input type="text" name="update_text">
                              </div>
                          </div>
                          
                          @foreach($strains as $strain)
                          <div class="tab-pane" id="strain{{$strain->id}}">
                              Height
                            <input type="text" name="height{{$strain->id}}"><br>
                              Darkness time
                            <input type="text" name="darkness_time{{$strain->id}}"><br>
                              Light time
                            <input type="text" name="light_time{{$strain->id}}"><br>
                              Stage
                            <input type="text" name="stage{{$strain->id}}"><br>
                              Vegetation product quantity
                            <input type="text" name="veg_prod_quantity{{$strain->id}}"><br>
                              Flowering product quantity
                            <input type="text" name="flow_prod_quantity{{$strain->id}}"><br>
                              Other product quantity
                            <input type="text" name="other_prod_quantity{{$strain->id}}"><br>
                              Actual photo
                            <input type="text" name="update_image_url{{$strain->id}}"><br>
                          </div>
                          @endforeach
                          <button type="submit" name="submit">Update review</button>
                          </form>
                        </div>

                      </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>