<?php

include_once ("../connection/connect.php");
if($_POST['option']=="showPriceofAllDishes")
{
    $image=$_POST['image'];
    $dishid=$_POST['dishid'];
    $dishName=$_POST['dishName'];

    $display='    
   
        <div class="modal-header">
                <h4 class="modal-title "><i class="fas fa-concierge-bell mr-1"></i>'.$dishName.' <br>dish id# '.$dishid.' </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <h4 class="mr-auto">Dish Selected</h4>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                hello,you have successfully selected dish
            </div>
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
                    <li class="text-center font-weight-bold h5"> Dish price id#'.$dishWithAttribute[$j][0].'</li>
                    
                    <li class="text-danger"> Price: '.$dishWithAttribute[$j][3].'</li>
                    </ul>
 
                    </div>
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Attribute</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>';


        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
        $AttributeDetail=queryReceive($sql);

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




        $display.=  '</tbody>
</table>
                    <div class="card-footer m-auto">
                        <button    data-$image="'.$image.'"  data-price="'.$dishWithAttribute[$j][3].'" data-dishname="'.$dishName.'"  data-dishid="'.$dishWithAttribute[$j][0].'"  class="btn btn-success  DishAddOnform "><i class=" far fa-check-circle"></i>Select</button>
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
    $image=$_POST['image'];
    $price=$_POST['price'];
    $dishid=$_POST['dishid'];
    $dishName=$_POST['dishName'];
    $countofdish=$_POST['countofdish'];

    $sql='SELECT d.id FROM dish as d   INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
Where  (dwa.id='.$dishid.')';
    $DishDetail=queryReceive($sql);
    $display='';



    $display.=  '<div id="remove'.$countofdish.'" class="card col-md-4" >

                    <ul>
                    <li class="text-center h4 font-weight-bold"> <i class="fas fa-concierge-bell mr-1"></i>'.$dishName.'</li>
                   
                    <li> Dish Price Id : '.$dishid.'</li>
                     <li> Dish  id : '.$DishDetail[0][0].'</li>
                    <li> <i class="fas fa-money-bill-alt text-danger float-right">Price : '.$price.'</i></li>
                    </ul>

             
                    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Attribute Name</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>
    
  ';


    $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishid.')';
    $AttributeDetail=queryReceive($sql);

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




    $display.=  '</tbody>
</table>
                    <div class="card-footer m-auto">
                                <input type="text" hidden  name="dishesName[]" value="'.$dishName.'"> 
                              <input type="number" hidden  name="dishesid[]" value="'.$dishid.'"> 
                               <input type="number" hidden  name="prices[]" value="'.$price.'">
                               <input type="text" hidden  name="images[]" value="'.$image.'">
                          <button type="button"  data-dishid="'.$countofdish.'" class="btn btn-danger remove "><i class="far fa-trash-alt"></i>Delete</button>
                    </div>
                </div>';
    echo $display;
}

