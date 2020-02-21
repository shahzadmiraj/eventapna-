<?php
include_once ("../../connection/connect.php");
$hallid=$_GET['hallid']=2;



?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>
        *{
            margin:0;
            padding:0;
        }
    </style>
</head>
<body class="container" style="width: 100%;">
<h1 align="center">Hall information</h1>
<h3 align="center">Hall Branch Name:</h3>
<h4 align="center">Food+Seating price</h4>




<?php

$daytimearray=array("Morning","Afternoon","Evening");
for ($k=0;$k<count($daytimearray);$k++)
{


    ?>


    <div class="shadow card p-2 mb-4">
        <h2 align="center"><?php echo $daytimearray[$k]; ?></h2>
        <table class="table table-bordered table-striped table-danger " style="width: 200%">
            <thead>
            <tr>
                <th scope="col">
                    Month
                </th>
                <th scope="col">
                    Add New Pakages
                </th>
            </tr>
            </thead>
            <tbody>

            <?php
            $display='';
    $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    for ($m = 0; $m < count($monthsArray); $m++)
    {
        $display.='
            <tr>
                <td>
                    '.$monthsArray[$m].'
                </td>
                <td>
                    <a href="addnewpackage.php?hallid='.$hallid.'&month='.$monthsArray[$m].'&daytime='.$daytimearray[$k].'" class="btn btn-success">Add
                        New Pakages</a>
                </td>';


                $sql='SELECT `id`,`expire`, `package_name` FROM `hallprice` WHERE (hall_id='.$hallid.')
AND (isFood=1) AND (dayTime="'.$daytimearray[$k].'") AND (month="'.$monthsArray[$m].'")';

                $allpackages=queryReceive($sql);
            for ($g = 0; $g < count($allpackages); $g++)
            {
                $display.='<td>
                    <a href="#packageid='.$allpackages[$g][0].'" class="btn btn-primary w-100">'.$allpackages[$g][2].'    ';

                if($allpackages[$g][1]!=NULL)
                {
                    $display.= " Expire";
                }
                $display.='</a>
                </td>';
            }
            $display.='</tr>';
    }
     echo $display;




            ?>



            </tbody>

        </table>

    </div>


    <?php
}
?>



<script>


</script>
</body>
</html>
