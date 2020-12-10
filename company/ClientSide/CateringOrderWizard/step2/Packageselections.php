<h3>
    <div class="media">
        <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
        <div class="media-body">
            <div class="bd-wizard-step-title">Package Detail </div>
            <div class="bd-wizard-step-subtitle">Step 1</div>
        </div>
    </div>
</h3>
<section>
    <div class="content-wrapper">
        <h4 class="section-heading mb-5">Order Detail </h4>

        <div class="row">

            <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                <lable for="Book_Date" class="col-form-label sr-only">Date</lable>
                <input id="Book_Date" type="date" name="Book_Date" class="form-control " placeholder="Date" min="<?php
                echo date('Y-m-d');
                ?>">
            </div>

            <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                <lable for="Book_Time" class="col-form-label sr-only">Time</lable>
                <input id="Book_Time" type="time" name="Book_Time" class="form-control " placeholder="Time">
            </div>
            <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                <lable for="numberOfGuest" class="col-form-label sr-only">Maximum Guest</lable>
                <input id="numberOfGuest" type="number" name="numberOfGuest" class="form-control " placeholder="Maximum Guest ">
            </div>
            <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                <lable for="BookingAddress" class="col-form-label sr-only">Booking Address</lable>
                <input id="BookingAddress" type="text" name="BookingAddress" class="form-control " placeholder="Booking Address ">
            </div>
        </div>


        <div class="row" style="overflow: auto">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">id#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Item</th>
                    <th scope="col">Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody id="TableOFBodyMenu">


                </tbody>
            </table>

        </div>

        <br>
        <hr>
        <h3 class="section-heading mb-5">Amount <input readonly type="number" name="wizardAmountPackage" id="wizardAmountPackage" class="float-right text-danger text-center" style="border: none;" value="0"> </h3>

    </div>



</section>



