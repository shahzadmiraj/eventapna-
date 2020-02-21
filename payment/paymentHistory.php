<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");



$userId=$_COOKIE['userid'];
$orderDetail_id=$_SESSION['order'];

$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderDetail_id.'';
$orderDetailPerson= queryReceive($sql);
$customerID=$orderDetailPerson[0][1];

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://primerevenue.com/wp-content/uploads/2016/08/News_New-Blogs_005blog-understanding-early-payment-discount-terms.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: #fdfdff;">
        <h3 ><i class="fas fa-history fa-2x mr-2"></i> Payment  History </h3>
        <h5>All history of transfer payments</h5>
    </div>

</div>
<div class="row justify-content-center col-12" style="margin-top: -60px">

    <div class="card text-center card-header">
        <img src="<?php


        if(file_exists('../images/customerimage/'.$orderDetailPerson[0][2])&&($orderDetailPerson[0][2]!=""))
        {
            echo '../images/customerimage/'.$orderDetailPerson[0][2];

        }
        else
        {
            echo 'https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
        }

        ?> " style="height: 20vh;" class="figure-img rounded-circle" alt="image is not set">
        <h5 ><?php
            echo  $orderDetailPerson[0][0];
            ?></h5>
        <label >Order ID:<?php
            echo  $orderDetail_id;
            ?></label>
    </div>
</div>


<div class="container">
    <div class="col-12  shadow border card" style="background-color: #80bdff">
        <?php
        $sql='SELECT py.id,(SELECT u.username FROM user as u where u.id=py.user_id) as sender,
(SELECT u.username FROM user as u where u.id=t.user_id) as receiver,py.amount,
t.senderTimeDate,t.Isconfirm,py.receive,py.nameCustomer,py.IsReturn,t.Isget
FROM orderDetail as ot INNER JOIN payment as py
on ot.id=py.orderDetail_id
INNER join transfer as t
on py.id=t.payment_id
WHERE (ot.id='.$orderDetail_id.')';
        $historyPayment=queryReceive($sql);
        $display='';

for($k=0;$k<count($historyPayment);$k++)
{

   $display.=' <div class="col-12  shadow border card-body mt-3" >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Payment Id </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][0].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Sender User </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][1].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receive User </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][2].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Amount</label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][3].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Sending Date </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][4].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receiving Date </label >
            <label class="col-8 col-form-label" > ';

            if($historyPayment[$k][5]=="")
            {
                $display.= "request has delivered for confirm to user";
            }
            else
            {
                $display.= $historyPayment[$k][5];
            }
         $display.= ' </label >
        </div >

        <div class="form-group row" >
            <label class="col-4 col-form-label" > Geting payment Date </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][6].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Customer Name </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][7].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > payment status </label >
            <label class="col-8 col-form-label" > ';
             if($historyPayment[$k][8]==0)
             {
                 $display.='get payment from customer';
             }
             else
             {

                 $display.='return payment to customer';
             }


             $display.='</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > transfer Status </label >
            <label class="col-8 col-form-label" > ';

                 if($historyPayment[$k][9]==0)
                 {
                     $display.="not confirm";
                 }
                 else
                 {
                     $display.="yes,I get the amount from user";
                 }
                $display.= '
            </label >
        </div >
    </div >';
   echo $display;

}

?>

    </div>



    <h1 align = "center" >Your received Payment </h1 >
    <div class="col-12">

        <?php

        $sql='SELECT py.id,(SELECT u.username FROM user as u where u.id=py.user_id), py.amount,py.receive,py.nameCustomer,py.IsReturn FROM orderDetail as ot INNER JOIN payment as py on ot.id=py.orderDetail_id WHERE (ot.id='.$orderDetail_id.') AND (py.sendingStatus=0)';
        $WhyPayment=queryReceive($sql);
$display='';
        for($t=0;$t<count($WhyPayment);$t++)
        {

    $display.='<div class="col-12  shadow border card-body mb-3" >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Payment Id </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][0].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > User Name </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][1].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Amount</label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][2].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receiving Date </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][3].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Customer Name </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][4].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > payment status </label >
            <label class="col-8 col-form-label" > ';
        if($WhyPayment[$t][5]==0)
        {
            $display.='get payment from customer';
        }
        else
        {

            $display.='return payment to customer';
        }
            $display.='</label >
        </div >
    </div >';

        }
        echo $display;

?>




    </div>
</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>


</script>
</body>
</html>
