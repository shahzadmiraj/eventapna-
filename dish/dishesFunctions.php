<?php
function showPriceofAllDishes($image,$dishid,$dishName,$imageForDB)
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
                    <li><input type="number" value="" placeholder="Quantity" id="QuatityDish'.$dishWithAttribute[$j][0].'" class="form-inline form-control"></li>
                  
                    <li >
                   
                    <select  id="DishOrDeal'.$dishWithAttribute[$j][0].'" class="form-control mt-2 row form-row">
                    <option value="Dish">Not Include in Deal</option>
                    <option value="Deal">Include in Deal</option>
                    </select>
                    
                    
                    
                    </li>
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
                        <button    data-image="'.$image.'"  data-price="'.$dishWithAttribute[$j][3].'" data-dishname="'.$dishName.'"  data-dishid="'.$dishWithAttribute[$j][0].'" data-dishimagrealfordb="'.$imageForDB.'" class="btn btn-success  DishAddOnform "><i class=" far fa-check-circle"></i>Select</button>
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

   /*
    $orderid=$_POST['orderid'];
    $userid=$_POST['userid'];
    $dishId=$_POST['dishId'];
    $each_price=chechIsEmpty($_POST['each_price']);
    $quantity=chechIsEmpty($_POST['quantity']);
    $describe=$_POST['describe'];

    $dishImage=$_POST['dishImage'];
    $dishName=$_POST['dishName'];
    $dishTypeId=$_POST['dishTypeId'];

   */

    $dishesAmount=(int)$each_price*(int)$quantity;
    $CurrentDateTime=date('Y-m-d H:i:s');
    $token=uniqueToken('dish_detail',"token",'');
    $sql='INSERT INTO `dish_detail`(`id`, `describe`, `expire`, `quantity`, `orderDetail_id`, `user_id`, `dishWithAttribute_id`, `active`, `price`, `expireUser`,`token`,`name`, `image`, `dish_type_id`) VALUES (NULL,"'.$describe.'",NULL,'.$quantity.','.$orderid.','.$userid.','.$dishId.',"'.$timestamp.'",'.$each_price.',NULL,"'.$token.'","'.$dishName.'","'.$dishImage.'",'.$dishTypeId.')';
    querySend($sql);





    $sql='SELECT od.hall_id FROM orderDetail as od WHERE od.id='.$orderid.'';
    $detailhall=queryReceive($sql);
    if(!isset($detailhall[0][0]))
    {
        SetCateringTotalAmount($orderid);
    }

}
function GetTotalAmountOFCateringDealCost($orderid)
{

    $sql='SELECT SUM(`quantity`*`price`) FROM `OrderCateringDealManage` WHERE `orderDetail_id`='.$orderid;
    return queryReceive($sql)[0][0];

}
function GetTotalAmountOFCateringDishCost($orderid)
{

    $sql='SELECT sum(`quantity`*`price`) FROM `dish_detail` WHERE `orderDetail_id`='.$orderid;
     return queryReceive($sql)[0][0];
}
function getTotalCateringCost($orderid)
{
    $totalCost=GetTotalAmountOFCateringDealCost($orderid)+GetTotalAmountOFCateringDishCost($orderid);

    return $totalCost;

}
function SetCateringTotalAmount($orderid)
{
    $sql='UPDATE `orderDetail` SET `total_amount`='.getTotalCateringCost($orderid).' WHERE id='.$orderid.'';
    querySend($sql);
}
function dealCreate($describe,$quantity,$user_id,$price,$name,$image,$orderDetail_id,$cateringPackages_id)
{
    global  $timestamp;
    $token=uniqueToken('OrderCateringDealManage',"token",'');
    $sql='INSERT INTO `OrderCateringDealManage`(`id`, `describe`, `expire`, `quantity`, `user_id`, `active`, `price`, `expireUser`, `token`, `name`, `image`, `orderDetail_id`, `cateringPackages_id`) VALUES (
NULL,"'.$describe.'",NULL,'.$quantity.','.$user_id.',"'.$timestamp.'",'.$price.',NULL,"'.$token.'","'.$name.'","'.$image.'",'.$orderDetail_id.','.$cateringPackages_id.')';
    querySend($sql);
}
function DealExpire($expireUser,$OrderCateringDealManage_id)
{
    global  $timestamp;
    $sql='UPDATE `OrderCateringDealManage` SET `expire`="'.$timestamp.'",`expireUser`='.$expireUser.' WHERE id='.$OrderCateringDealManage_id;
    querySend($sql);
}
function DealManage()
{

}
function GetSelectedDeal($DealId)
{
    $sql='SELECT `id`, `describe`, `expire`, `quantity`, `user_id`, `active`, `price`, `expireUser`, `token`, `name`, `image`, `orderDetail_id`, `cateringPackages_id` FROM `OrderCateringDealManage` WHERE id='.$DealId;
    return queryReceive($sql)[0];
}
function ShowSelectedDeal($DealId)
{
    $DealDetail=GetSelectedDeal($DealId);

    $image='../images/systemImage/imageNotFound.png';
    if(file_exists('../images/users/'.$DealDetail[10])&&($DealDetail[10]!=""))
    {
        $image= '../images/users/'.$DealDetail[10];
    }

    $display=' <div class="card col-md-4" style="width: 18rem;"  id="removeSelectedRowFromTableCard'.$DealDetail[0].'">
                <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>Deal:'.$DealDetail[9].'</h5>
                    <p class="card-text">Detail :'.$DealDetail[1].'</p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">Already Selected</li>
                    <li class="list-group-item">Deal id:'.$DealDetail[0].'</li>
                    <li class="list-group-item"> Per Head Rate: '.$DealDetail[6].' </li>
                    <li class="list-group-item">Quantity: '.$DealDetail[3].'</li>
                    <li class="list-group-item">Total Amount: '.($DealDetail[6]*$DealDetail[3]).'</li>
                   
                </ul>
          
                <input  hidden type="number" name="SelectedDealid[]" value="'.$DealDetail[0].'">
              
                <button  data-buttonid="'.$DealDetail[0].'"  class="removeSelectedRowFromTableCard btn btn-danger form-control mt-5"><i class="far fa-trash-alt"></i> Remove Deal</button>
            </div>';
    return $display;
}
function GetAllDealsInOrder($orderDetail_id)
{
    $sql='SELECT `id` FROM `OrderCateringDealManage` WHERE orderDetail_id='.$orderDetail_id.' AND (ISNULL(expire))';
     return queryReceive($sql);
}

function GetAllShowOfSelectedDeals($orderDetail_id)
{
    $display='';
    $GetSelectedDeals=GetAllDealsInOrder($orderDetail_id);
    for($i=0;$i<count($GetSelectedDeals);$i++)
    {
        $display.=ShowSelectedDeal($GetSelectedDeals[$i][0]);
    }
    return $display;


}

?>