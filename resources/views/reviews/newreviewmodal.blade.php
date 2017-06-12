<!-- Modal -->
                <div id="newReviewModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add a new Review</h4>
                      </div>
                      <div class="modal-body">
                        <form  action= "/new-review" method= "POST" >
                        {!! csrf_field() !!}
                          <tr>
                            <div class="form-group">
                              Title of your cultive
                              <input type="text" name="title" value="{{ old('title') }}" class="form-control"/>
                            </div>
                            <div class="form-group">
                              Cover Photo
                              <input type="text" name="background_image_url" value="{{ old('background_image_url') }}" class="form-control"/>
                            </div>
                          <button type="submit">Save Changes</button>
                          </tr>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                       </div>
                      </div>
                    </div>