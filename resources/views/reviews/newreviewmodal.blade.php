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
                        <form  action= "/new-review" method= "POST"  enctype="multipart/form-data">
                        {!! csrf_field() !!}
                          <tr>
                            <div class="form-group">
                              Title of your cultive
                              <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                            </div>
                            <div class="form-group">
                              Cover Photo
                              <input type="file" name="background_image_url" >
                            </div>
                          </tr>

                      </div>
                      <div class="modal-footer">
                          <button class="btn btn-lg btn-default btn-block" type="submit">Create</button>
                          </form>
                      </div>
                       </div>
                      </div>
                    </div>
