<?php

include_once ("../connection/connect.php");
if($_POST['option']=="showPriceofAllDishes")
{
    $dishid=$_POST['dishid'];
    $dishName=$_POST['dishName'];

    $display='    
   
        <div class="modal-header">
                <h4 class="modal-title">'.$dishName.'  </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body form-inline ">';







    /*<div class="card" style="width: 18rem;">
           <div class="card-header text-danger">
               <i class="fas fa-money-bill-alt"></i>  Price
           </div>
           <ul class="list-group list-group-flush">
               <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i> AttributeName : Quantity</li>
           </ul>
           <div class="card-footer m-auto">
               <button  type="button" data-dishid="1"  class="btn btn-success  adddish "><i class=" far fa-check-circle"></i>Select</button>
           </div>
       </div>-->





       <div   id="dishid_1" class="card" style="width: 18rem;">
           <div class="card-header ">
               <h5>Dishname</h5>
               <i class="fas fa-money-bill-alt text-danger float-right"> Price</i>
           </div>
           <ul class="list-group list-group-flush">
               <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i> AttributeName:quantity</li>
           </ul>
           <div class="card-footer  m-auto">

               <button  data-dishid="1" class="btn btn-danger remove "><i class="far fa-trash-alt"></i>Delete</button>
           </div>
       </div>*/




    $sql='SELECT dwa.id, dwa.active, dwa.expire, dwa.price, dwa.dish_id FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$dishid.')';
    $dishWithAttribute=queryReceive($sql);


    for($j=0;$j<count($dishWithAttribute);$j++)
    {
        //all dishes with price


        $display.=  '<div class="card" style="width: 18rem;">
                    <div class="card-header text-danger">
                        <i class="fas fa-money-bill-alt"></i>  '.$dishWithAttribute[$j][3].'
                    </div>
                    <ul class="list-group list-group-flush">';


        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
        $AttributeDetail=queryReceive($sql);

        // special dish with attribute and quantity
        for($i=0;$i<count($AttributeDetail);$i++)
        {
            $display.=' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$i][0].' :  '.$AttributeDetail[$i][1].'</li>';
        }




        $display.=  '</ul>
                    <div class="card-footer m-auto">
                        <button    data-price="'.$dishWithAttribute[$j][3].'" data-dishname="'.$dishName.'"  data-dishid="'.$dishWithAttribute[$j][0].'"  class="btn btn-success  DishAddOnform "><i class=" far fa-check-circle"></i>Select</button>
                    </div>
                </div>';



    }




    $display.='</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>';

    echo $display;


}
else if($_POST['option']=="AddDishOnForm")
{
    $price=$_POST['price'];
    $dishid=$_POST['dishid'];
    $dishName=$_POST['dishName'];
    $countofdish=$_POST['countofdish'];
    $display='';

    $display.=  '<div id="remove'.$countofdish.'" class="card" style="width: 18rem;">
                          <h5>'.$dishName.'</h5>
               <i class="fas fa-money-bill-alt text-danger float-right"> '.$price.'</i>
                    <ul class="list-group list-group-flush">';


    $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishid.')';
    $AttributeDetail=queryReceive($sql);

    // special dish with attribute and quantity
    for($i=0;$i<count($AttributeDetail);$i++)
    {
        $display.=' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$i][0].' :  '.$AttributeDetail[$i][1].'</li>';
    }




    $display.=  '</ul>
                    <div class="card-footer m-auto">
                                <input type="text" hidden  name="dishesName[]" value="'.$dishName.'"> 
                              <input type="number" hidden  name="dishesid[]" value="'.$dishid.'"> 
                               <input type="number" hidden  name="prices[]" value="'.$price.'">
                          <button type="button"  data-dishid="'.$countofdish.'" class="btn btn-danger remove "><i class="far fa-trash-alt"></i>Delete</button>
                    </div>
                </div>';
    echo $display;



}