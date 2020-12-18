<?php

include_once ("../connection/connect.php");
 if($_POST['option']=="AddDishOnForm")
{
    $image=$_POST['image'];
    $price=$_POST['price'];
    $dishid=$_POST['dishid'];
    $dishName=$_POST['dishName'];
    $countofdish=$_POST['countofdish'];
    $quantity=$_POST['quantity'];
    $DishOrDeal=$_POST['DishOrDeal'];
    $DishImageRealForDB=$_POST['dishimagrealfordb'];


    $DishOrDealText="";
    if($DishOrDeal=="Dish")
        $DishOrDealText="Not Include in Deal";
    else
        $DishOrDealText="Include in Deal";




    $sql='SELECT d.id FROM dish as d   INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
Where  (dwa.id='.$dishid.')';
    $DishDetail=queryReceive($sql);
    $display='';



    $display.=  '<div id="remove'.$countofdish.'" class="card col-md-4" >
                 <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
                   <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>Dish : '.$dishName.'</h5>
                  
                     </div>
                 
                ';


    



    $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishid.')';
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
    $display .= '

           <ul class="list-group list-group-flush">
                   
                     <li class="list-group-item"> Dish  id : '.$DishDetail[0][0].'</li>
                     
                     <li class="list-group-item"> '.$DishOrDealText.'</li>
                    <li class="list-group-item"> Price : '.$price.'</i></li>
                    <li class="list-group-item"> Quantity : '.$quantity.'</i></li>
                     <li class="list-group-item"> Total : '.($price*$quantity).'</i></li>
                    </ul>
                                <input type="text" hidden  name="dishesName[]" value="'.$dishName.'"> 
                              <input type="number" hidden  name="dishesid[]" value="'.$dishid.'"> 
                               <input type="number" hidden  name="prices[]" value="'.$price.'">
                               <input type="number" hidden  name="quantity[]" value="'.$quantity.'">
                                 <input type="text" hidden  name="DishOrDeal[]" value="'.$DishOrDeal.'">
                                    <input type="text" hidden  name="images[]" value="'.$DishImageRealForDB.'">
                          
                          <button type="button"  data-dishid="'.$countofdish.'" class="btn btn-danger remove form-control "><i class="far fa-trash-alt"></i> Delete</button>
                    
                </div>';
    echo $display;
}


include_once("../webdesign/footer/EndOfPage.php");
