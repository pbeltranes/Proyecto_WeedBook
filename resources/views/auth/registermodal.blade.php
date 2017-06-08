<!-- Modal -->
                <div id="registerModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Register now for free =D</h4>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="/auth/register">
                        {!! csrf_field() !!}

                            User Name
                           <div>
                               <input type="text" name="name" value="{{ old('name') }}">
                           </div>
                           Email
                           <div>
                               <input type="email" name="email" value="{{ old('email') }}">
                           </div>

                            Bio
                           <div>
                               <textarea type="text" name="bio" value="{{ old('bio') }}">Short description of yourself
                               </textarea>
                           </div>
                           You're Growing Since?
                           <div>
                               <input type="date" name="growing_since" value="{{ old ('growing_since') }}">    
                           </div>

                            Birthday
                           <div>
                               <input type="date" name="birthdate" value="{{ old ('birthdate') }}">    
                           </div>
                           Password
                           <div>
                               <input type="password" name="password">
                           </div>
                           Confirm Password
                           <div>
                               <input type="password" name="password_confirmation">
                           </div>


                            <div>
                               <button type="submit">Register</button>
                           </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>







