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

    $sql='SELECT d.id FROM dish as d   INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
Where  (dwa.id='.$dishid.')';
    $DishDetail=queryReceive($sql);
    $display='';



    $display.=  '<div id="remove'.$countofdish.'" class="card col-md-4" >

                    <ul>
                    <li class="text-center h4 font-weight-bold"> <i class="fas fa-concierge-bell mr-1"></i>'.$dishName.'</li>
                   
                    <li> Dish Type Id : '.$dishid.'</li>
                     <li> Dish  id : '.$DishDetail[0][0].'</li>
                    <li> <i class="fas fa-money-bill-alt text-danger float-right">Price : '.$price.'</i></li>
                    <li> <i class="fas fa-money-bill-alt text-danger float-right">Quantity : '.$quantity.'</i></li>
                     <li> <i class="fas fa-money-bill-alt text-danger float-right">Total : '.($price*$quantity).'</i></li>
                    </ul>';


    



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
      <td>'.$AttributeDetail[$i][1].'</td>
   </tr>';

    }




    if (count($AttributeDetail)>0) {
        $display .= '</tbody>
</table>';
    }
    $display .= '<div class="card-footer m-auto">
                                <input type="text" hidden  name="dishesName[]" value="'.$dishName.'"> 
                              <input type="number" hidden  name="dishesid[]" value="'.$dishid.'"> 
                               <input type="number" hidden  name="prices[]" value="'.$price.'">
                               <input type="number" hidden  name="quantity[]" value="'.$quantity.'">
                               <input type="text" hidden  name="images[]" value="'.$image.'">
                          <button type="button"  data-dishid="'.$countofdish.'" class="btn btn-danger remove "><i class="far fa-trash-alt"></i>Delete</button>
                    </div>
                </div>';
    echo $display;
}


include_once("../webdesign/footer/EndOfPage.php");
