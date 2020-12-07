<?php
function DishesPriceModelShow($image,$dishid,$dishName)
{



    $description='';

    $display='    
   
        <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-concierge-bell mr-1"></i>'.$dishName.'  </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
            
        
        
        
        
        
            <div class="modal-body form-inline ">';











    $sql='SELECT dwa.id, dwa.active, dwa.expire, dwa.price, dwa.dish_id FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$dishid.')';
    $dishWithAttribute=queryReceive($sql);


    for($j=0;$j<count($dishWithAttribute);$j++)
    {
        //all dishes with price


        $display.=  '<div class="card" style="width: 18rem;">
                    <div class="card-header">
                 
                 <ul>
                    <li class="text-center font-weight-bold h5"> Dish price id#'.$dishWithAttribute[$j][0].'</li>
                    
                 
                    </ul>
                 
                    </div>';

        if(count($dishWithAttribute)>0) {


            $display .= ' <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Item Name</th>
                  <th scope="col">Quantity</th>
                </tr>
              </thead>
              <tbody>  ';
        }


        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
        $AttributeDetail=queryReceive($sql);

        // special dish with attribute and quantity
        for($i=0;$i<count($AttributeDetail);$i++)
        {

            $display.=' 
    <tr>
      <th scope="row">'.($i+1).'</th>
      <td>'.$AttributeDetail[$i][0].'</td>
      <td>'.$AttributeDetail[$i][2].'</td>
   </tr>';
            $description.=$AttributeDetail[$i][0].':'.$AttributeDetail[$i][2].'<br>';
        }

        if(count($dishWithAttribute)>0) {


            $display .= ' </tbody>
                </table> ';
        }



        $display.=  '
                    <div class="card-footer text-center">
                    <h5 class="text-danger"><i class="fas fa-money-bill-alt"></i> Price:  '.$dishWithAttribute[$j][3].'</h5>
                    <input  class="form-control" id="InputQuantity'.$dishWithAttribute[$j][0].'" type="number" placeholder="Quantity">
                    <button  data-adddishpriceidbutton="'.$dishWithAttribute[$j][0].'"  data-image="'.$image.'"  data-item="'.$dishName.'" data-type="Dish" data-description="'.$description.'" data-price="'.$dishWithAttribute[$j][3].'"    class="addDishPriceidButton btn btn-success mt-3">Add</button>
                    </div>
                </div>';
        $description="";



    }




    $display.='</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>';

    return $display;


}