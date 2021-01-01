<h3>
    <div class="media">
        <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
        <div class="media-body">
            <div class="bd-wizard-step-title">Package Preview</div>
            <div class="bd-wizard-step-subtitle">Step 2</div>
        </div>
    </div>
</h3>
<section>
    <div class="content-wrapper">

        <p class="mb-4">
            Package id# <?php echo $PackageDateid;?><br>
            Package Name:   <?php echo $PackageDetail[0][6];?><br>
            Package Date :  <?php echo $PackageDate[0][1];?><br>
            Package Time: <?php echo $PackageDetail[0][4];?><br>
            Package Type:       <?php

            if($PackageDetail[0][1]==0)
            {
                echo "Seating only";
            }
            else
            {
                echo "Food and Seating";
            }
            ?> <br>
            Package Price per head:        <?php echo $PackageDetail[0][2];?><br>
            Remaining Arrangement of Seating:2323<br>
            Remaining Patition: <?php echo $MaxGuestMaxPartition[3];?><br>
            Package Descripe : <?php echo $PackageDetail[0][3]; ?><br>
            hall Name:  <?php echo $hallInformation[0][1];?><br>
        </p>
        <h4 class="section-heading"></h4>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="describe" class="sr-only">Description</label>
                <textarea name="describe" id="describe" class="form-control" placeholder="Description (optional)"></textarea>
            </div>
        </div>
        <!--<div class="row">
            <div class="form-group col-md-12 form-inline">
                <input type="text"  id="CouponCode" class="form-control col-md-6" placeholder="Coupon Code">
                <button  type="button" class="btn-primary col-md-6 form-control">Check Coupon </button>
            </div>
        </div>-->
        <br>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="describe" class="sr-only">Coupon Code</label>
                <div class="input-group mb-3 input-group-lg">
                    <input type="text" class="form-control" name="CoponCode" id="CoponCode" placeholder="Coupon Code">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-success" id="CoponCodeBtn"><i class="far fa-id-card"></i></button>
                        <input hidden readonly type="text" class="form-control" name="CoponCodeReal" id="CoponCodeReal" >
                         <input hidden readonly type="text" name="wizardCouponCodePercentageORAmount" value="" id="wizardCouponCodePercentageORAmount">
                        <input hidden  readonly type="number" name="CouponCodeDiscount" value="" id="CouponCodeDiscount">
                        <input hidden readonly type="number" name="companyid" value="<?php echo $hallInformation[0][8];?>" id="companyid">
                    </div>
                </div>
            </div>
        </div>


        <h6 class="section-heading mb-5">Amount <input readonly type="number" name="wizardTotalAmountPackage" id="wizardTotalAmountPackage" class="float-right text-danger" style="border: none" value="0"> </h6>

        <h6 class="section-heading mb-5">Discount <input name="Discount" readonly type="number" id="wizardDiscountAmountPackage" class="float-right text-danger" style="border: none" value="0"> </h6>

        <h6 class="section-heading mb-5">Remaining <input readonly type="number" id="wizardRemiangAmountPackage" class="float-right text-danger" style="border: none" value="0"> </h6>

    </div>
</section>



