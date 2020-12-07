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
        <h4 class="section-heading mb-5">Package</h4>
        <h6 class="font-weight-bold">Package Detail</h6>
        <label class="mb-5 form-inline"> No.of Guest  <input id="numberOfGuest" type="number" name="numberOfGuest" class="form-control ml-2" placeholder="Maximum Guest "></label>
        <hr>

        <h4 class="section-heading mb-5">Order Detail<button type="button" class="btn btn-outline-primary float-right"  data-toggle="modal" data-target="#ExtraitemModel">+ Add</button> </h4>
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
        <h6 class="section-heading mb-5">Amount <input readonly type="number" id="wizardAmountPackage" class="float-right text-danger" style="border: none" value="0"> </h6>

    </div>



</section>



