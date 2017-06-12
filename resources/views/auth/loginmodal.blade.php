                <!-- Modal -->
                <div id="loginModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Login</h4>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/auth/login">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="glyphicon glyphicon-user"></i>
                              </span> 
                              <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" autofocus>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="glyphicon glyphicon-lock"></i>
                              </span>
                                <input class="form-control" placeholder="Password" name="password" type="password" value="" id="password">
                            </div>
                          </div>
                            <div>
                                <input type="checkbox" name="remember"> Remember Me
                            </div>
                        
                          <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
                          </div>
                        </form>
                      
                      </div>
                      <div class="modal-footer">
                      </div>
                    </div>

                  </div>
                </div>



