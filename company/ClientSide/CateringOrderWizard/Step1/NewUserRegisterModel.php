
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body container">
                <form id="RegisteredNewUser">
                    <input type="hidden" name="option" value="localUser">
                    <div class="form-group row">
                        <label for="Newusername" class="col-form-label">User Name</label>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="Newusername" type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>


                    <div class="form-group row ">
                        <label class="col-form-label">Email</label>
                        <div for="NewEmail" class="input-group mb-3 input-group-lg ">
                            <div class="input-group-prepend ">
                                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                            </div>
                            <input id="NewEmail" type="text" class="form-control" name="Email" placeholder="Email ">
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label for="newpassword" class="col-form-label">Password</label>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="newpassword" type="password" class="form-control" name="password" placeholder="Password">

                        </div>
                    </div>

                    <p class="form-group">
                        <input type="checkbox" name="checkbox" value="check" id="agree" class="form-check-inline" /> I have read and agree to the <a href="#">Terms and Conditions and Privacy Policy</a>
                    </p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="NewUserRegisterbutton" type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>