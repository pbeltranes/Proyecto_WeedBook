<link href="{{ URL::to('/') }}/css/update.css" rel="stylesheet">
                <!-- Modal -->
                <div id="updateModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Weekly entry wizard</h4>
                      </div>
                      <div class="modal-body">
                        <div class="stepwizard">
                          <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                              <a href="#wtsnew" type="button" class="btn btn-primary btn-circle">?</a>
                              <p>What's new this week?</p>
                            </div>
                          <?php $c=1; ?>
                            @foreach($strains as $strain)
                            <div class="stepwizard-step">
                              <a href="#strain{{$strain->id}}" type="button" class="btn btn-default btn-circle" disabled="disabled">{{$c}}</a>
                              <p>{{$strain->strain_name}}</p>
                            </div>
                            <?php $c++; ?>
                            @endforeach
                          </div>
                        </div>
                          <form role="form" action="/review/{{$review->id}}/add-update" method="POST">
                          {!! csrf_field() !!}
                          <div class="row setup-content" id="wtsnew">
                            <div class="col-md-12">
                              <div class="col-md-12">
                                <textarea required="required" name="update_text" class="form-control" placeholder="Tell the world!" ></textarea>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                              </div>
                            </div>
                          </div>
                          @foreach($strains as $strain)
                          @if($strain !== $strains->last())
                          <div class="row setup-content" id="strain{{$strain->id}}">
                            <div class="col-md-12">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Height</label>
                                  <input name="height{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in centimeters"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Humidity</label>
                                  <input name="humidity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in %"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Temperature</label>
                                  <input name="temp{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ºC"  />
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Darkness Time</label>
                                  <input name="darkness_time{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in hours"/>
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Light Time</label>
                                  <input name="light_time{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in hours"  />
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Stage</label>
                                  <select name="stage{{$strain->id}}" class="form-control">
                                    <option value="vegetation">Vegetation</option>
                                    <option value="flowering">Flowering</option>
                                    <option value="harvest">Maduration</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Vegetation product quantity</label>
                                  <input name="veg_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Flowering product quantity</label>
                                  <input name="flow_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Other product quantity</label>
                                  <input name="other_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Update Image</label>
                                  <input name="update_image_url{{$strain->id}}" type="file" class="form-control"  />
                                </div>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                              </div>
                            </div>
                          </div>
                          @else
                          <div class="row setup-content" id="strain{{$strain->id}}">
                            <div class="col-md-12">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Height</label>
                                  <input name="height{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in centimeters"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Humidity</label>
                                  <input name="humidity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in %"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Temperature</label>
                                  <input name="temp{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ºC"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Darkness Time</label>
                                  <input name="darkness_time{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in hours"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Light Time</label>
                                  <input name="light_time{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in hours"  />
                                </div>

                                <div class="form-group">
                                  <label class="control-label">Stage</label>
                                  <select name="stage{{$strain->id}}" class="form-control">
                                    <option value="vegetation">Vegetation</option>
                                    <option value="flowering">Flowering</option>
                                    <option value="harvest">Maduration</option>
                                  </select>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Vegetation product quantity</label>
                                  <input name="veg_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Flowering product quantity</label>
                                  <input name="flow_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Other product quantity</label>
                                  <input name="other_prod_quantity{{$strain->id}}" maxlength="100" type="number" required="required" class="form-control" placeholder="in ml/L"  />
                                </div>
                                <div class="form-group">
                                  <label class="control-label">Update Image</label>
                                  <input name="update_image_url{{$strain->id}}" type="file" class="form-control" />
                                </div>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="submit">Update</button>
                              </div>
                            </div>
                          </div>
                          </form>
                          @endif
                          @endforeach
                      </div>
                      <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div> -->
                    </div>

                  </div>
                </div>
