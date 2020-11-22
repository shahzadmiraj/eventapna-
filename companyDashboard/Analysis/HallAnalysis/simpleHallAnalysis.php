<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Next 24h Process Order</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <h4>
                                <?php
                                $CurrentDateTime = date('Y-m-d H:i:s');
                                $CurrentDate = date('Y-m-d', strtotime($CurrentDateTime)); // d.m.YYYY
                                $NextDateTime = date('Y-m-d H:i:s', strtotime($CurrentDateTime . ' +1 day'));
                                $NextDate = date('Y-m-d', strtotime($NextDateTime)); // d.m.YYYY
                                $sql="SELECT Count(id) WHERE (hall_id=1) AND (status_hall='Running') AND (destination_date   BETWEEN '" . $CurrentDate . "' AND '" . $NextDate . "' )";

                                ?>



                            </h4>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Online Order Request</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">


                                    <?php
                                    $sql="SELECT Count(id) WHERE (hall_id=1) AND (status_hall='Online')";
                                    ?>



                                </div>
                            </div>
                            <!--<div class="col">
                              <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Today Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <?php
                            $CurrentDateTime = date('Y-m-d H:i:s');
                            $CurrentDate = date('Y-m-d', strtotime($CurrentDateTime)); // d.m.YYYY
                            $NextDateTime = date('Y-m-d H:i:s', strtotime($CurrentDateTime . ' +1 day'));
                            $NextDate = date('Y-m-d', strtotime($NextDateTime)); // d.m.YYYY
                            $sql="SELECT Count(id) WHERE (hall_id=1) AND (status_hall='Running') AND (destination_date ='" . $CurrentDate . "')";
                            ?>


                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Today New Booked Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <?php
                            $sql="SELECT Count(id) WHERE (hall_id=1) AND (status_hall='Running') AND (booking_date ='" . $CurrentDate . "')";
                            ?>


                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Today Earning</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">

                            <?php
                            $sql="SELECT  sum(total_amount + extracharges - discount) WHERE (hall_id=1) AND (status_hall='Running') AND (destination_date ='" . $CurrentDate . "')";

                            ?>


                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>







</div>

