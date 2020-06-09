<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-11
 * Time: 16:25
 */
include_once ("../../../connection/connect.php");




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
            $dishimage = "../../../images/dishImages/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $dishimage =$_FILES['image']['name'];
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

        $token=uniqueToken("dish");
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
                    $token=uniqueToken("dishWithAttribute");
                    $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`,`token`) VALUES (NULL,"'.$timestamp.'",NULL,'.$prices[$i].','.$dishid.','.$userid.',"'.$token.'")';
                    querySend($sql);
                    $dishWithAttributeid=mysqli_insert_id($connect);
                    for($j=0;$j<$countAttribute;$j++)
                    {
                        $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.$addAttributes[$j].'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($quantity[$CountQuantity]).','.$dishWithAttributeid.','.$userid.')';
                        querySend($sql);
                        $CountQuantity++;
                    }

                }
            }
            else
            {
                $token=uniqueToken("dishWithAttribute");
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
        $dishid=$_POST['dishid'];
        $column=$_POST['column'];
        $text=chechIsEmpty($_POST['text']);
        $sql='UPDATE `dish` SET '.$column.'="'.$text.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=='changeAttributes')
    {
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
        $userid=$_POST['userid'];
        $addAttributes=array();
        $quantity=array();
        $countAttribute=0;
        if(isset($_POST['attribute']))
        {
            $addAttributes = $_POST['attribute'];
            $countAttribute=count($addAttributes);
            $quantity=$_POST['quantity'];
        }
        $dishid=$_POST['dishid'];

        $price=checknumberOtherNull($_POST['price']);


            $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$price.','.$dishid.','.$userid.')';
            querySend($sql);
            $dishWithAttributeid=mysqli_insert_id($connect);
            for($j=0;$j<$countAttribute;$j++)
            {


                $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.$addAttributes[$j].'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($quantity[$j]).','.$dishWithAttributeid.','.$userid.')';
                querySend($sql);
            }


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
        if(empty($_FILES['image']["name"]))
        {
            exit();

        }
        $dishId=$_POST['dishId'];



        $dishimage="../../../images/dishImages/".$_FILES['image']['name'];
        $resultimage=ImageUploaded($_FILES,$dishimage);//$dishimage is destination file location;
        if($resultimage!="")
        {
            print_r($resultimage);
            exit();
        }

        $dishimage=$_FILES['image']['name'];
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
                    <h5>Dish id : '.$dishWithAttribute[$j][0].'</h5>
                 
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
        $companyid=$_POST['companyid'];
        $userid=$_POST['userid'];
        $packageid=$_POST['dishid'];
        $sql='SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=dishControl.catering_id) FROM `dishControl` WHERE (ISNULL(expire))AND(dish_id='.$packageid.')';
        $Selective=queryReceive($sql); //previous selections
        $Selectived= array_column($Selective, 1);
        $selectedPrevious=array();
        if(isset($_POST['selected']))
        {
            $selectedPrevious=$_POST['selected'];//current selections packageControl ids

        }
        $result=array_diff($Selectived,$selectedPrevious); //different packageControl ids

        foreach ($result as $k => $v) //disactive different packageControl ids
        {
            $sql='UPDATE `dishControl` SET `expire`="'.$timestamp.'",`expireUserid`='.$userid.' WHERE id='.$v.'';
            querySend($sql);
        }

        if(isset($_POST['active']))
        {
            //create new
            $createActive=$_POST['active'];
            for($i=0;$i<count($createActive);$i++)
            {
                $sql='INSERT INTO `dishControl`(`id`, `dish_id`, `catering_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$packageid.','.$createActive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
                querySend($sql);
            }
        }
    }
}


?>