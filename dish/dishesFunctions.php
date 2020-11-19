<?php
function showPriceofAllDishes($image,$dishid,$dishName)
{


    $display='    
   <div id="DishesTypeModel'.$dishid.'" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" >

        <!-- Modal content-->
        <div class="modal-content"  id="AddDishDetail"  style="height: 100vh;overflow: auto">
        
        
        
        <div class="modal-header">
                <h4 class="modal-title "><i class="fas fa-concierge-bell mr-1"></i>'.$dishName.' <br>Dish Type id# '.$dishid.' </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
     
            <div class="modal-body form-inline ">';







    $sql='SELECT dwa.id, dwa.active, dwa.expire, dwa.price, dwa.dish_id FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$dishid.')';
    $dishWithAttribute=queryReceive($sql);


    for($j=0;$j<count($dishWithAttribute);$j++)
    {
        //all dishes with price


        $display.=  '<div class="card" style="width: 18rem;">
                    <div class="card-header ">
                    <ul>
                    <li class="text-center font-weight-bold h5"> Dish Id#'.$dishWithAttribute[$j][0].'</li>
                    
                    <li class="text-danger"> Price: '.$dishWithAttribute[$j][3].'</li>
                    <li class="form-inline row"><input type="number" value="" placeholder="Quantity" id="QuatityDish'.$dishWithAttribute[$j][0].'" class="form-inline"></li>
                    </ul>
 
                    </div>';


        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
        $AttributeDetail=queryReceive($sql);

        if (count($AttributeDetail)>0) {


            $display .= ' <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item name</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>';

        }

        // special dish with attribute and quantity
        for($i=0;$i<count($AttributeDetail);$i++)
        {

            $display.=' 
    <tr>
      <th scope="row">'.($i+1).'</th>
      <td>'.$AttributeDetail[$i][0].'</td>
      <td>'.$AttributeDetail[$i][2].'</td>
   </tr>';
        }




        if (count($AttributeDetail)>0) {
            $display .= '</tbody>
</table>';
        }
        $display.=  ' <div class="card-footer m-auto">
                        <button    data-$image="'.$image.'"  data-price="'.$dishWithAttribute[$j][3].'" data-dishname="'.$dishName.'"  data-dishid="'.$dishWithAttribute[$j][0].'"  class="btn btn-success  DishAddOnform "><i class=" far fa-check-circle"></i>Select</button>
                    </div>
                </div>';

    }




    $display.='</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
     </div>
    </div>
</div>       
            ';

    return $display;


}
function CreateNewDishes($orderid,$userid,$dishId,$each_price,$quantity,$describe,$dishImage,$dishName,$dishTypeId)
{
    global  $timestamp;
   /* $orderid=$_POST['orderid'];
    $userid=$_POST['userid'];
    $dishId=$_POST['dishId'];
    $each_price=chechIsEmpty($_POST['each_price']);
    $quantity=chechIsEmpty($_POST['quantity']);
    $describe=$_POST['describe'];

    $dishImage=$_POST['dishImage'];
    $dishName=$_POST['dishName'];
    $dishTypeId=$_POST['dishTypeId'];*/

    $dishesAmount=(int)$each_price*(int)$quantity;
    $CurrentDateTime=date('Y-m-d H:i:s');
    $token=uniqueToken('dish_detail',"token",'');
    $sql='INSERT INTO `dish_detail`(`id`, `describe`, `expire`, `quantity`, `orderDetail_id`, `user_id`, `dishWithAttribute_id`, `active`, `price`, `expireUser`,`token`,`name`, `image`, `dish_type_id`) VALUES (NULL,"'.$describe.'",NULL,'.$quantity.','.$orderid.','.$userid.','.$dishId.',"'.$timestamp.'",'.$each_price.',NULL,"'.$token.'","'.$dishName.'","'.$dishImage.'",'.$dishTypeId.')';
    querySend($sql);
    $sql='SELECT od.hall_id,od.total_amount FROM orderDetail as od WHERE od.id='.$orderid.'';
    $detailhall=queryReceive($sql);
    if(!isset($detailhall[0][0]))
    {
        $totalamount=$detailhall[0][1]+$dishesAmount;
        $sql='UPDATE `orderDetail` SET `total_amount`='.$totalamount.' WHERE id='.$orderid.'';
        querySend($sql);
    }

}


?>