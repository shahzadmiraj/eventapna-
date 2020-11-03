<h3>
    <div class="media">
        <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
        <div class="media-body">
            <div class="bd-wizard-step-title">Personal Details</div>
            <div class="bd-wizard-step-subtitle">Step 1</div>
        </div>
    </div>
</h3>
<section>
    <div class="content-wrapper">
        <h4 class="section-heading">Enter your Personal details </h4>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="CustomerName" class="sr-only">Your Name</label>
                <input type="text" name="CustomerName" id="CustomerName" class="form-control" placeholder="Your Name">
            </div>
            <div class="form-group col-md-6">
                <label for="Phoneno" class="sr-only">Phone no</label>
                <input type="number" name="Phoneno" id="Phoneno" class="form-control" placeholder="Phone No">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="CNICNumber" class="sr-only">CNIC Number (Optional)</label>
                <input type="number" name="CNICNumber" id="CNICNumber" class="form-control" placeholder="CNIC Number optional">
            </div>
            <div class="form-group col-md-6">
                <label for="customerAddress" class="sr-only">Your Address</label>
                <input type="text" name="customerAddress" id="customerAddress" class="form-control" placeholder="Your Address">
            </div>
        </div>
    </div>




    <div  class="content-wrapper" id="LoginDetailwrap" <?php
    if(isset($_COOKIE['userid']))
        echo 'style="display: none "' ;
        ?>>
        <input  type="text" id="isdownuserValid" hidden value="<?php
        if(isset($_COOKIE['userid']))
            echo 'Yes"' ;
        else
            echo "No";
        ?>">
        <h4 class="section-heading">Enter Login </h4>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="OldUsername" class="sr-only">Username</label>
                <input type="text" name="OldUsername" id="OldUsername" class="form-control" placeholder="Username">
            </div>
            <div class="form-group col-md-6">
                <label for="LoginPassword" class="sr-only">Password</label>
                <input type="password" name="LoginPassword" id="LoginPassword" class="form-control" placeholder="Password">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <button id="checklogin" class="col-12 btn btn-outline-info">Login</button>
            </div>
            <div class="form-group col-md-6">
                <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Register</button><br>
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter"  class="btn btn-light">Forgot Password?</button>
            </div>
        </div>
    </div>
</section>

