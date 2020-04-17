<?php
include_once ('../../../connection/connect.php');



$companyid=$_GET['c'];

$sql='SELECT hall.id,`name`, `max_guests`, `function_per_Day`, `noOfPartitions`, `ownParking`, `image`, `hallType`,`company_id`, hall.active,l.country,l.city,l.address,(SELECT c.name FROM company as c WHERE c.id=hall.company_id) FROM `hall` INNER join location as l 
on (hall.location_id=l.id)
WHERE
(ISNULL(l.expire))AND (hall.company_id='.$companyid.')AND(ISNULL(hall.expire))';
$hallInformation=queryReceive($sql);


$sql='SELECT c.name,c.image,c.company_id,cl.country,cl.city,cl.address,cl.longitude,cl.latitude,cl.radius,c.id FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE
(ISNULL(c.expire))AND (ISNULL(cl.expire))AND(c.company_id='.$companyid.')';
$catering=queryReceive($sql);

?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../webdesign/css/CardStyle.css">
    <link rel="stylesheet" href="../../../webdesign/css/Gallery.css">
    <link rel="stylesheet" href="../../../webdesign/css/comment.css">

    <style>
        .checked {
            color: orange;
        }
    </style>
</head>
<body>

<?php
include_once ("../../../webdesign/header/header.php");



?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo $hallInformation[0][13]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Company Service
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

    <h2>Hall Services</h2>
    <hr>




        <?php
        $img='';

        for($i=0;$i<count($hallInformation);$i++)
        {

            $img=$hallInformation[$i][6];
            if(file_exists('../../../images/hall/'.$img)&&($img!=""))
                $img='../../../images/hall/'.$img;
            else
                $img="https://st2.depositphotos.com/3336339/11976/i/950/depositphotos_119763698-stock-photo-abstract-futuristic-hall-background.jpg"
            ?>
            <div class="row  mb-5 container">



            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
            </div>


            <div class="col-md-8  mb-5">
                <h4><?php echo $hallInformation[$i][1];?>


                    <?php
                    //star calculate
                    $sql='SELECT AVG(c.rating) FROM comments as c WHERE (c.hall_id='.$hallInformation[$i][0].') ';
                    echo starCalculation($sql);
                    ?>
                </h4>
                <hr>

                    <div class="row justify-content-start">


                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Hall Parking
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php
                            if($hallInformation[$i][5]==0)
                            {
                                echo "No Own Parking";
                            }
                            else
                            {
                                echo "Yes Own Parking";
                            }
                            ?>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Hall Maximum Guest
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $hallInformation[$i][2];?>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Hall No of Patition
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $hallInformation[$i][5];?>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Hall Type
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php
                            $halltype=array("Marquee","Hall","Deera /Open area");


                            echo $halltype[$hallInformation[$i][7]];?>
                        </div>





                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            City
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $hallInformation[$i][11];?>
                        </div>



                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Country
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $hallInformation[$i][10];?>
                        </div>




                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Address
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $hallInformation[$i][12];?>
                        </div>

                    </div>

                    <a class="btn btn-primary btn-lg mt-5 float-right" href="../Hall/HallClient.php?h=<?php echo $hallInformation[$i][0];?>">Visit Hall &raquo;</a>

                </div>


            </div>

</div>
            <?php
        }
        ?>










    <hr>


</div>






<div class="container">





    <h2>Catering Services</h2>
    <hr>

    <div class="row  mb-5">

        <?php

        for($i=0;$i<count($catering);$i++) {

            $img = $catering[$i][1];
            if (file_exists('../../../images/catering/' . $img) && ($img != ""))
                $img = '../../../images/catering/' . $img;
            else
                $img = "https://st2.depositphotos.com/3336339/11976/i/950/depositphotos_119763698-stock-photo-abstract-futuristic-hall-background.jpg"
            ?>

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4><?php echo $catering[$i][0];?>

                    <?php
                    //star calculate
                    $sql='SELECT AVG(c.rating) FROM comments as c WHERE (c.catering_id='.$catering[$i][9].')';
              echo starCalculation($sql);
                    ?>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Country
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $catering[$i][3];?>
                        </div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            City
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $catering[$i][4];?>
                        </div>


                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Address
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $catering[$i][5];?>
                        </div>


                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            Target Range
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                            <?php echo $catering[$i][8];?> KM
                        </div>


                    </div>
                </div>
                <a class="btn btn-primary btn-lg float-right" href="../Catering/cateringClient.php?c=<?php echo $catering[$i][9];?>">Visit Catering&raquo;</a>
            </div>
            <?php
        }
        ?>







    </div>
    <hr>



</div>






<?php
include_once ("../../../webdesign/footer/footer.php");
?>
</body>
</html>







