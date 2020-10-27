<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-11
 * Time: 16:25
 */
include_once ("../../../connection/connect.php");

function checkAndUpdateDishControlInCaterings($post)
{
            global $timestamp;
            $companyid=$post['companyid'];
            $userid=$post['userid'];
            $packageid=$post['dishid'];
            $sql='SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=dishControl.catering_id) FROM `dishControl` WHERE (ISNULL(expire))AND(dish_id='.$packageid.')';
            $Selective=queryReceive($sql); //previous selections
            $Selectived= array_column($Selective, 1);
            $selectedPrevious=array();
            if(isset($post['selected']))
            {
                $selectedPrevious=$post['selected'];//current selections packageControl ids
            }

            $clean1 = array_diff($Selectived, $selectedPrevious);
            $clean2 = array_diff($selectedPrevious, $Selectived);
            $final_output = array_merge($clean1, $clean2);

            for($i=0;$i<count($final_output);$i++)//disactive different packageControl ids
            {
                $sql = 'UPDATE `dishControl` SET `expire`="' . $timestamp . '",`expireUserid`=' . $userid . ' WHERE id=' . $final_output[$i] . '';
                querySend($sql);
            }
            if(isset($post['active']))
            {
                //create new
                $createActive=$post['active'];
                for($i=0;$i<count($createActive);$i++)
                {
                    $sql='INSERT INTO `dishControl`(`id`, `dish_id`, `catering_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$packageid.','.$createActive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
                    querySend($sql);
                }

            }




}
function checkAndUpdateDishesPrices($post)
{
    global $timestamp,$connect;
    $companyid=$post['companyid'];
    $userid=$post['userid'];
    $packageid=$post['dishid'];

  //  $sql='SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=dishControl.catering_id) FROM `dishControl` WHERE (ISNULL(expire))AND(dish_id='.$packageid.')';
    $sql='SELECT dwa.id FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$packageid.')';
    $Selective=queryReceive($sql); //previous selections
    $Selectived= array_column($Selective, 0);
    $selectedPrevious=array();
    if(isset($post['dishidswithpricesAlreadySelected']))
    {
        $selectedPrevious=$post['dishidswithpricesAlreadySelected'];//current selections packageControl ids
    }

     //different packageControl ids
    $clean1 = array_diff($Selectived, $selectedPrevious);
    $clean2 = array_diff($selectedPrevious, $Selectived);
    $final_output = array_merge($clean1, $clean2);

    for($i=0;$i<count($final_output);$i++)//disactive different packageControl ids
    {

        $sql='UPDATE dishWithAttribute SET expire="'.$timestamp.'" WHERE id='.$final_output[$i].'';
        querySend($sql);
    }


}
function checkAndInsertNewPrices($post)
{
    global $timestamp,$connect;
    $countofAttributeSequence=0;
    $userid=$post['userid'];
    if(isset($post['NonDishprice']))
    {
        //create new
        $createActive=$post['NonDishid'];
        $NonDishprice=$post['NonDishprice'];
        $NonDishAttributeName=array();
        $NonDishAttributeQuantity=array();
        if(isset($post['NonDishAttributeName']))
        {
            $NonDishAttributeName=$post['NonDishAttributeName'];
            $NonDishAttributeQuantity=$post['NonDishAttributeQuantity'];
        }
        $countofAttribute=array_unique($NonDishAttributeName);
        for($i=0;$i<count($createActive);$i++)
        {

            $token=uniqueToken("dishWithAttribute","token",'');
            $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`,`token`) VALUES (NULL,"'.$timestamp.'",NULL,'.$NonDishprice[$i].','.$createActive[$i].','.$userid.',"'.$token.'")';
            querySend($sql);
            $dishWithAttributeid=mysqli_insert_id($connect);
            //
            for($j=0;$j<count($countofAttribute);$j++)
            {
                $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.trim($NonDishAttributeName[$countofAttributeSequence]).'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($NonDishAttributeQuantity[$countofAttributeSequence]).','.$dishWithAttributeid.','.$userid.')';
                querySend($sql);
                $countofAttributeSequence++;
            }

        }
    }
}
function checkDishEdit($post)
{
    global $timestamp,$connect,$_FILES;
    $dishid=$post['dishid'];
    $sql='SELECT `name`, `dish_type_id`,`image`  FROM `dish` WHERE (ISNULL(expire))AND(id='.$dishid.')';
    $dishDetailOnly=queryReceive($sql);
    $userid=$post['userid'];
    $Dishname=$post['Dishname'];
    $dishtype=$post['dishtype'];
    $otherdishType=$post['otherdishType'];
    $dishimage=$dishDetailOnly[0][2];

    if(!empty($_FILES['image']["name"]))
    {
        $passbyreference=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($passbyreference));
        $tokenimages=uniqueToken("dish","image",'.'.$file_ext);
        $dishimage = "../../../images/dishImages/".$tokenimages;
        //$dishimage = "../../../images/dishImages/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
        if ($resultimage != "") {
            print_r($resultimage);
            exit();
        }
        $dishimage=$tokenimages;
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`, `primaryKeyInTable`) VALUES (NULL,"dish","image","'.$dishDetailOnly[0][2].'",'.$userid.',"'.$timestamp.'",'.$dishid.')';
        querySend($sql);
    }
    if($_POST["dishtype"]=="others")
    {
        $dishtypename=$_POST['otherdishType'];

        $sql='INSERT INTO `dish_type`(`id`, `name`, `expire`, `active`, `user_id`) VALUES (NULL,"'.$dishtypename.'",NULL,"'.$timestamp.'",'.$userid.')';
        querySend($sql);
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`, `primaryKeyInTable`) VALUES (NULL,"dish","dish_type",'.$dishDetailOnly[0][1].','.$userid.',"'.$timestamp.'",'.$dishid.')';
        querySend($sql);
        $dishtype=mysqli_insert_id($connect);
    }
    else if($dishDetailOnly[0][1]!=$dishtype)
    {
        //change type
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`, `primaryKeyInTable`) VALUES (NULL,"dish","dish_type",'.$dishDetailOnly[0][1].','.$userid.',"'.$timestamp.'",'.$dishid.')';
        querySend($sql);
    }
    if($dishDetailOnly[0][0]!=trim($Dishname))
    {
        //change New Name
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`, `primaryKeyInTable`) VALUES (NULL,"dish","name","'.$dishDetailOnly[0][0].'",'.$userid.',"'.$timestamp.'",'.$dishid.')';
        querySend($sql);
    }
    $sql='UPDATE `dish` SET `name`="'.trim($Dishname).'",`image`="'.trim($dishimage).'",`dish_type_id`='.$dishtype.' WHERE (ISNULL(expire))AND(id='.$dishid.')';
    querySend($sql);

}
if(isset($_POST['option']))
{

    if($_POST["option"]=="addDishsystem")
    {
        $companyid=$_POST['companyid'];
        $dishname=chechIsEmpty($_POST['dishname']);
        $userid=$_POST['userid'];
        $dishimage='';
        if(!empty($_FILES['image']["name"]))
        {
            $passbyreference=explode('.',$_FILES['image']['name']);
            $file_ext=strtolower(end($passbyreference));
            $tokenimages=uniqueToken("dish","image",'.'.$file_ext);
            $dishimage = "../../../images/dishImages/".$tokenimages;
            //$dishimage = "../../../images/dishImages/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $dishimage =$tokenimages;
        }
        $dishtype='';
        if($_POST["dishtype"]=="others")
        {
            $dishtypename=$_POST['otherdishType'];

            $sql='INSERT INTO `dish_type`(`id`, `name`, `expire`, `active`, `user_id`) VALUES (NULL,"'.$dishtypename.'",NULL,"'.$timestamp.'",'.$userid.')';
            //$sql='INSERT INTO `dish_type`(`id`, `name`, `isExpire`,`catering_id`) VALUES (NULL,"'.$dishtypename.'",NULL,'.$cateringid.')';
            querySend($sql);
            $dishtype=mysqli_insert_id($connect);
        }
        else
        {
            $dishtype=$_POST["dishtype"];
        }

        $token=uniqueToken("dish","token",'');
        $sql='INSERT INTO `dish`(`name`, `id`, `image`, `dish_type_id`, `expire`, `active`, `user_id`,`token`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",'.$dishtype.',NULL,"'.$timestamp.'",'.$userid.',"'.$token.'")';
        querySend($sql);
        $dishid=mysqli_insert_id($connect);
        $countAttribute=0;
            if(isset($_POST['attribute']))
            {
                $addAttributes = $_POST['attribute'];
                $countAttribute=count($addAttributes);
                $CountQuantity=0;

                $prices=$_POST['price'];
                $quantity=$_POST['quantity'];
                for($i=0;$i<count($prices);$i++)
                {
                    $token=uniqueToken("dishWithAttribute","token",'');
                    $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`,`token`) VALUES (NULL,"'.$timestamp.'",NULL,'.$prices[$i].','.$dishid.','.$userid.',"'.$token.'")';
                    querySend($sql);
                    $dishWithAttributeid=mysqli_insert_id($connect);
                    for($j=0;$j<$countAttribute;$j++)
                    {
                        $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.trim($addAttributes[$j]).'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($quantity[$CountQuantity]).','.$dishWithAttributeid.','.$userid.')';
                        querySend($sql);
                        $CountQuantity++;
                    }

                }
            }
            else
            {
                $token=uniqueToken("dishWithAttribute","token",'');
                $dishprice=$_POST['dishprice'];
                $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`,`token`) VALUES (NULL,"'.$timestamp.'",NULL,'.$dishprice.','.$dishid.','.$userid.',"'.$token.'")';
                querySend($sql);
            }
                        if(isset($_POST['branchactive']))
                        {
                            $branchactive=$_POST['branchactive'];
                            for($i=0;$i<count($branchactive);$i++)
                            {
                                $sql='INSERT INTO `dishControl`(`id`, `dish_id`, `catering_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$dishid.','.$branchactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
                                querySend($sql);
                            }
                        }

    }
    else if($_POST['option']=="attributesCreate")
    {
        $dishid=$_POST["dishid"];
        if(!isset($_POST['attribute']))
        {
            exit();
        }
        $addAttributes=$_POST['attribute'];
        for($i=0;$i<count($addAttributes);$i++)
        {
            $sql='INSERT INTO `attribute`(`name`, `id`, `dish_id`, `isExpire`) VALUES ("'.$addAttributes[$i].'",NULL,'.$dishid.',NULL)';
            querySend($sql);
        }
    }
    else if($_POST['option']=="dishchanges")
    {
        //change dish
        $dishid=$_POST['dishid'];
        $column=$_POST['column'];
        $text=chechIsEmpty($_POST['text']);
        $sql='UPDATE `dish` SET '.$column.'="'.$text.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=='changeAttributes')
    {
        ///change
        $attributeid=$_POST['attributeid'];
        $text=chechIsEmpty($_POST['text']);
        $sql='UPDATE `attribute` SET `name`="'.$text.'" WHERE id='.$attributeid.'';
        querySend($sql);
    }
    else if($_POST['option']=="RemoveAttribute")
    {
        $attributeid=$_POST['attributeid'];
        $timestamp = date('Y-m-d H:i:s');
        $sql='UPDATE attribute as a SET a.isExpire="'.$timestamp.'" WHERE a.id='.$attributeid.'';
        querySend($sql);
    }
    else if($_POST['option']=="ExpireDish")
    {
        $dishid=$_POST['dishid'];
        $sql='UPDATE dish SET expire="'.$timestamp.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=="ExpireDishPrice")
    {
        $timestamp = date('Y-m-d H:i:s');
        $dishid=$_POST['dishid'];
        $sql='UPDATE dishWithAttribute SET expire="'.$timestamp.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=="addnewDishprice")
    {

        $addAttributes=array();
        $quantity=array();
        $countAttribute=0;
        if(isset($_POST['attributeNamesInModel']))
        {
            $addAttributes = $_POST['attributeNamesInModel'];
            $countAttribute=count($addAttributes);
            $quantity=$_POST['quantityInModel'];
        }

        $dishid=$_POST['dishid'];

        $price=checknumberOtherNull($_POST['price']);
        $NonselectivedishesCount=$_POST['NonselectivedishesCount'];




        $display='';



            $display.='<div class="card m-2" id="NonselectivedishesCount'.$NonselectivedishesCount.'">
                <div class="card-header text-danger">
                   <i class="fas fa-money-bill-alt"></i>Total price: '.$price.'
                </div>
                <ul class="list-group">
             
                ';


            if (count($addAttributes) > 0) {


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
            for($k=0;$k<count($addAttributes);$k++)
            {
                $display .= ' 
    <tr>
      <th scope="row">'.($k+1).'</th>
      <td>'.$addAttributes[$k].'</td>
      <td>'.$quantity[$k].'</td>
      <input hidden type="text" name="NonDishAttributeName[]" value="'.$addAttributes[$k].'">
      <input hidden type="number" name="NonDishAttributeQuantity[]" value="'.$quantity[$k].'">
   </tr>';

            }
            if (count($addAttributes) > 0) {
                $display .= '</tbody>
</table>';
            }


            $display.='  
                  <li class="list-group-item">New include</li>
                </ul>
                <input hidden type="number" name="NonDishid[]" value="'.$dishid.'">
                <input hidden type="number" name="NonDishprice[]" value="'.$price.'">
                
             
                <div class="card-footer  m-auto">
                    <button data-dishtypealredy="NonselectivedishesCount"  data-deleteid="'.$NonselectivedishesCount.'" class="btn btn-danger deleteprice "><i class="far fa-trash-alt"></i>Delete Price </button>
                </div>
            </div>';







        echo $display;








        exit();




    }
    else if($_POST['option']=="changeDishType")
    {
        $id=$_POST['id'];
        $value=chechIsEmpty($_POST['value']);
        $sql='UPDATE dish_type as dt SET dt.name="'.$value.'" WHERE dt.id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="Delele_Dish_Type")
    {
        $id=$_POST['id'];
        $value=chechIsEmpty($_POST['value']);
        if($value=="Disable")
        {
            $timestamp = date('Y-m-d H:i:s');
            $sql = 'UPDATE dish_type as dt SET dt.expire="' . $timestamp . '" WHERE dt.id=' . $id . '';
        }
        else
        {

            $sql = 'UPDATE dish_type as dt SET dt.expire=NULL WHERE dt.id=' . $id . '';
        }
        querySend($sql);
    }
    else if ($_POST['option']=="changeImage")
    {
        //change image
        if(empty($_FILES['image']["name"]))
        {
            exit();

        }
        $dishId=$_POST['dishId'];

        $passbyreference=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($passbyreference));
        $tokenimages=uniqueToken("dish","image",'.'.$file_ext);
        $dishimage = "../../../images/dishImages/".$tokenimages;

        //$dishimage="../../../images/dishImages/".$_FILES['image']['name'];
        $resultimage=ImageUploaded($_FILES,$dishimage);//$dishimage is destination file location;
        if($resultimage!="")
        {
            print_r($resultimage);
            exit();
        }

        $dishimage=$tokenimages;
        $sql='UPDATE `dish` SET image="'.$dishimage.'" WHERE id='.$dishId.'';
        querySend($sql);


        $imagepath=$_POST['imagepath'];
        if(file_exists("../../../images/dishImages/".$imagepath))
        {
            unlink("../../../images/dishImages/".$imagepath);
        }


    }
    else if($_POST['option']=='showPriceofAllDishes')
    {
        $image=$_POST['image'];
        $dishid=$_POST['dishid'];
        $dishName=$_POST['dishName'];

        $display='    
   
        <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-concierge-bell mr-1"></i>'.$dishName.'  </h4>
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
      <td>'.$AttributeDetail[$i][1].'</td>
   </tr>';
            }

            if(count($dishWithAttribute)>0) {


                $display .= ' </tbody>
                </table> ';
            }



            $display.=  '
                    <div class="card-footer m-auto">
                    <h6 class="text-danger">Price: <i class="fas fa-money-bill-alt"></i>  '.$dishWithAttribute[$j][3].'</h6>
                    </div>
                </div>';



        }




        $display.='</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>';

        echo $display;


    }
    else if($_POST['option']=="SubmitPackagesSave")
    {



        $post=$_POST;
        checkAndUpdateDishControlInCaterings($post);
        checkAndUpdateDishesPrices($post);
        checkAndInsertNewPrices($post);
        checkDishEdit($post);
    }
    else  if($_POST['option']=="checkAttributeExistByKeyUp")
    {
        $display='';
        $value=trim($_POST['value']);
        if($value=="")
            exit();
        $company_id=$_POST['company_id'];

      $sql='SELECT a.name FROM attribute as a INNER join dishWithAttribute as dwa
on (a.dishWithAttribute_id=dwa.id) INNER join dish as d 
on (d.id=dwa.dish_id) INNER join dishControl as dc 
on (d.id=dc.dish_id)
WHERE 
(ISNULL(dc.expire))AND
(ISNULL(d.expire))AND(ISNULL(dwa.expire))AND (ISNULL(a.expire))AND (dc.company_id='.$company_id.')AND (a.name like "%'.$value.'%") 
GROUP by a.name limit 5';
        $exist=queryReceive($sql);
        for($i=0;$i<count($exist);$i++)
        {
            $display.='
            <li class="border border-info"><a href="#" data-attributename="'.$exist[$i][0].'" class="rightAttribute btn btn-light ">  '.$exist[$i][0].'</a></li>';
        }
        echo $display;
    }
}



?>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>
