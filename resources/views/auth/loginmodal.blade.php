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
                            <div>
                                Email
                                <input type="email" name="email" value="{{ old('email') }}">
                            </div>
                        
                            <div>
                                Password
                                <input type="password" name="password" id="password">
                            </div>
                        
                            <div>
                                <input type="checkbox" name="remember"> Remember Me
                            </div>
                        
                            <div>
                                <button type="submit">Login</button>
                            </div>
                        </form>
                      
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>



