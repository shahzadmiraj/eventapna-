

<!------ Include the above in your HEAD tag ---------->


<div class="container">

    <?php


    if(isset($processInformation))
    {

        $sql='SELECT  `orderDetail_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
        $processInformationForWizard=queryReceive($sql);
        $orderIdForWizard=$processInformationForWizard[0][0];

        $sql='SELECT  `total_amount`, `discount`, `extracharges` FROM `orderDetail` WHERE id='.$orderIdForWizard.'';
        $orderForWizard=queryReceive($sql);
        $sql='SELECT sum(amount) FROM `payment` WHERE IsReturn=0 AND orderDetail_id='.$orderIdForWizard;
        $PaidAmountForWizard=queryReceive($sql);


    if($processInformation[0][4]==0)
    {


    ?>


        <?php
    }
        ?>



    <div class="row">
        <div class="container">

            <div class="card " >
                <div class="row no-gutters">
                    <div class="col-4 m-auto">
                        <?php
                        $sql='SELECT `name`,`id`, `image` FROM `person` WHERE id='.$processInformation[0][7].'';
                        $CustomerInfo=queryReceive($sql);


                        if(($CustomerInfo[0][2]!="")&&(file_exists($imageCustomer.$CustomerInfo[0][2])))
                        {
                            echo '<img src="'.$imageCustomer.$CustomerInfo[0][2].'" class="card-img rounded" alt="..." style="height: 20vh">';
                        }
                        else
                        {
                            echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRcYhl53h5jYneDJZBHrAJkQin91O6DYR2Gj-Ijaxt6mY39V2NN&usqp=CAU" class="card-img rounded" alt="..." style="height: 20vh">';
                        }

                        ?>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <ul class="">
                                <li class="list-group-item d-inline-block active">Name:<?php echo $CustomerInfo[0][0];?></li>

                                <?php
                                echo "<li class='list-group-item d-inline-block'>Customer id:".$CustomerInfo[0][1]."</li>";
                                if($processInformation[0][5]!="")
                                    echo "<li class='list-group-item d-inline-block'>Order id: ".$processInformation[0][5]."</li>";
                                if($processInformation[0][2]!="")
                                {
                                    $sql='SELECT name FROM catering WHERE id='.$processInformation[0][2].'';
                                    $cateringName=queryReceive($sql);

                                    echo "<li class='list-group-item d-inline-block'>catering: ".$cateringName[0][0]."</li>";
                                }
                                else if ($processInformation[0][3]!="")
                                {
                                    $sql='SELECT name FROM hall WHERE id='.$processInformation[0][3].'';
                                    $hallName=queryReceive($sql);
                                    echo "<li class='list-group-item d-inline-block'>hall : ".$hallName[0][0]."</li>";
                                }
                                $ToalAmountForWizard=(int)($orderForWizard[0][0]-$orderForWizard[0][1]+$orderForWizard[0][2]);
                                echo "<li class='list-group-item d-inline-block'>Total amount : ".$ToalAmountForWizard."</li>";
                                echo "<li class='list-group-item d-inline-block'> Paid: ".(int)$PaidAmountForWizard[0][0]."</li>";
                                echo "<li class='list-group-item d-inline-block'>Remaining : ".(int) ($ToalAmountForWizard-$PaidAmountForWizard[0][0])."</li>";
                                ?>

                            </ul>





                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <?php
    }
    ?>



    <?php


    $show="NoDisplay";
    $DisplayExtraItems="No";
    $DisplayDishIcon="Yes";
    if(isset($processInformation))
    {
        if($processInformation[0][4]==0)
            $show="YesDisplay";
        if($processInformation[0][3]!="")
        {
            //came from hall
            $DisplayExtraItems="Yes";
            if(isset($processInformation[0][5])) {


                $sql = 'SELECT catering_id,status_catering FROM orderDetail WHERE id=' . $processInformation[0][5] . '';
                $StatusOrder = queryReceive($sql);
                if ($StatusOrder[0][1] != "Running")
                    $DisplayDishIcon = "No";
            }

        }
    }
    else
        {
        $show = "YesDisplayButNotExist";
        if(isset($_GET['h']))
        {
            //came for hall
            $DisplayExtraItems="Yes";
            $DisplayDishIcon="No";
        }
    }

    if($show!="NoDisplay")
    {
    ?>

    <div class="row container">

            <nav class="m-auto">
                <ul class="pagination  ">



                    <li class="page-item <?php

                    if($whichActive==1)
                        echo "active";
                    else
                        echo "disabled";

                    ?> ">
                        <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-user-edit "></i>
                        </a>
                    </li>


                    <li class="page-item <?php

                    if($whichActive==2)
                        echo "active";
                    else
                        echo "disabled";

                    ?> "><a class="page-link" href="#">
                            <i class="fas fa-cart-arrow-down "></i>
                        </a></li>



                    <?php

                    if($DisplayExtraItems=="Yes")
                    {
                    ?>

                    <li class="page-item <?php

                    if($whichActive==3)
                        echo "active";
                    else
                        echo "disabled";

                    ?>"><a class="page-link" href="#">
                            <i class="fab fa-accusoft"></i>
                        </a>
                    </li>
                    <?php
                    }

                    if($DisplayDishIcon=="Yes")
                    {
                    ?>


                    <li class="page-item <?php

                    if($whichActive==4)
                        echo "active";
                    else
                        echo "disabled";

                    ?>"><a class="page-link" href="#">
                            <i class="fas fa-concierge-bell "></i>
                        </a>
                    </li>


                    <?php
                    }
                    ?>

                    <li class="page-item <?php

                    if($whichActive==5)
                        echo "active";
                    else
                        echo "disabled";

                    ?>"><a class="page-link" href="#">
                            <i class="fab fa-amazon-pay"></i>
                        </a>
                    </li>

                </ul>
            </nav>


    </div>

    <?php
    }

    ?>



</div>

<div class="container">
    <hr>
    <h3 align="center"><?php echo $PageName; ?></h3>

</div>



<script>

    $("#CloseWizard").click(function (e)
    {
        e.preventDefault();
        window.history.back();
    });

</script>

