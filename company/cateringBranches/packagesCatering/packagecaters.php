<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../../index.php");

if(isset($_GET['id']))
{
    RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner","../../../index.php","id");
}

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$sql='SELECT `id`, `name`, `token` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$CateringName=queryReceive($sql);
$List=array();
$cateringid='';
$Active="All";
if(isset($_GET['id']))
{

    $id=$_GET['id'];
    $token=$_GET['token'];
    $cateringid=$id;
    $sql = 'SELECT  `name` FROM `catering` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
    $cateringdetail = queryReceive($sql);
    if(count($cateringdetail)<=0)
        exit();
    $List=$id;
    $Active=$id;

}
else
{

    $listOfCatering=array_column($CateringName, 0);
    $List = implode(',', $listOfCatering);
}
$userid=$_COOKIE['userid'];
$companyid=$userdetail[0][0];


?>
    <!DOCTYPE html>
    <head>
        <?php
        include('../../../webdesign/header/InsertHeaderTag.php');
        ?>
        <title>Dish Management </title>
        <meta name="description" content="Management  Dish ,Management  food,Management  dish only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
        <meta name="keywords" content="Management  Dish ,Management  food,Management  dish Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

        <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
        <script src="../../../jquery-3.3.1.js"></script>
        <script type="text/javascript" src="../../../bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <link rel="stylesheet" href="../../../webdesign/css/loader.css">
        <link rel="stylesheet" href="../../../webdesign/css/complete.css">

        <script src="../../../webdesign/JSfile/JSFunction.js"></script>
        <style>

        </style>
    </head>
    <body>
    <?php
    include_once ("../../../webdesign/header/header.php");

    ?>




    <div class="container">
        <h1 class="text-muted text-center">Catering Package Manage</h1>

        <h3 class="font-weight-bold">Catering Package   <button type="button" class="btn btn-primary float-right col-4" data-toggle="modal" data-target="#exampleModalCenter1">
                ADD Package
            </button> </h3>

        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link <?php
                if($Active=="All")
                {
                    echo "active";
                }
                ?> cateringnumber "  data-cateringnumber="All"  href="?">All</a>
            </li>


            <?php


            $display="";
            for($i=0;$i<count($CateringName);$i++)
            {
                $display.= '  
              
        <li class="nav-item">
            <a class="nav-link cateringnumber ';

                if($Active==$CateringName[$i][0])
                    $display.="active";

                $display.='" data-cateringnumber="'.$CateringName[$i][0].'"  href="?id='.$CateringName[$i][0].'&token='.$CateringName[$i][2].'" >'.$CateringName[$i][1].'</a>
        </li>';
            }
            echo $display;

            $sql='SELECT `id`,`cateringPackages_id` FROM `cateringPackageControl` WHERE (catering_id in ('.$List.'))AND(ISNULL(expire))
GROUP by (cateringPackages_id)
';
            $dishTypeDetail=queryReceive($sql);
            ?>

        </ul>








    </div>







    <br>
    <div class="container">
        <h3>Catering Packages</h3>
        <hr>
        <div class="row">
            <?php
$display='';
for($i=0;$i<count($dishTypeDetail);$i++)
{

    $sql = '

SELECT `id`, `packageName`, `description`, `image`, `token`, `PerHeadprice`, `activeDate`, `expireDate`, `activeUser`, `expireUser` FROM `cateringPackages` WHERE (id=' . $dishTypeDetail[$i][1] . ')
';
    $dishDetail=queryReceive($sql);
    $image='';
    if(file_exists('../../../images/cateringPackage/'.$dishDetail[0][3])&&($dishDetail[0][3]!=""))
    {
        $image= '../../../images/cateringPackage/'.$dishDetail[0][3];
    }
    else
    {
        $image='../../../images/systemImage/imageNotFound.png';
    }
    $display .='<div class="card" style="width: 18rem;">
  <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
  <div class="card-body">
    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[0][1] . '</h5>
    <p class="card-text">' . $dishDetail[0][2] . '</p>
  </div>
  <ul class="list-group list-group-flush">
  <li class="list-group-item">Package id:' . $dishDetail[0][0] . '</li>
    <li class="list-group-item text-danger">Per Head Rate:' . $dishDetail[0][5] . '</li>
  </ul>';
    $display.='    <form id="FormActivationDish'.$i.'" >
              
                 <input hidden name="companyid" value="'.$userdetail[0][0].'">
                 <input hidden name="userid" value="'.$userid.'">
                 <input hidden name="dishid" value="'.$dishDetail[0][0].'">';
    //Start Activation
    $sql = 'SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=cateringPackageControl.catering_id) FROM `cateringPackageControl` WHERE (ISNULL(expire))AND(cateringPackages_id=' . $dishDetail[0][0] . ')';
    $Selective = queryReceive($sql);
    for ($K = 0; $K < count($Selective); $K++)
    {
        $display.= '  
              <div class="checkbox">
                <h4><input data-formid="'.$i.'" class="SubmitFormActivationDishes" type="checkbox" checked  name="selected[]" value="' . $Selective[$K][1] . '">' . $Selective[$K][2] . '</h4>
                </div>';
    }
    $Selective = array_column($Selective, 0);
    $List = implode(',', $Selective);


    $sql = 'SELECT `id`, `name` FROM `catering` WHERE (ISNULL(expire))AND (company_id= ' . $companyid . ')AND( id NOT IN (' . $List . '))';
    $All = queryReceive($sql);
    for ($K = 0; $K < count($All); $K++) {
        $display.= '  
              <div class="checkbox">
                <h4><input data-formid="'.$i.'" class="SubmitFormActivationDishes" type="checkbox"   name="active[]" value="'.$All[$K][0].'">' . $All[$K][1] . '</h4>
                </div>';
    }


$display.='</form>
</div>';


}
echo $display;
            ?>





        </div>

    </div>


    <?php
    include_once ("../../../webdesign/footer/footer.php");
    ?>




    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">ADD PACKAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="packageADDForm">
                        <?php
                        echo '<input hidden name="companyid" value="'.$userdetail[0][0].'">
                                  <input hidden name="userid" value="'.$userid.'">';
                        ?>
                        <div class="form-group">
                            <label for="PackageName">Package Name</label>
                            <input type="text" class="form-control" name="PackageName" id="PackageName" placeholder="Package Name">
                        </div>
                        <div class="form-group">
                            <label for="PackageImage">Package Image</label>
                            <input type="file" class="form-control" name="PackageImage" id="PackageImage" placeholder="Package Name">
                        </div>
                        <div class="form-group">
                            <label for="PackagePerHeadRate">Package Per Head Rate</label>
                            <input type="number" name="PackagePerHeadRate" class="form-control" id="PackagePerHeadRate" placeholder="Package Per Head Rate (Amount)">
                        </div>
                        <div class="form-group">
                            <label for="PackageDescription">Package Description</label>
                            <textarea class="form-control" name="PackageDescription" id="PackageDescription" rows="3" placeholder="Package Description"></textarea>
                        </div>
                        <div class="form-group">


                            <lable  class="col-form-label">Select catering for dishes active</lable>


                            <?php
                            $sql='SELECT `id`, `name` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')';
                            $allbranch=queryReceive($sql);
                            for($i=0;$i<count($allbranch);$i++)
                            {
                                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="branchactive[]" value="'.$allbranch[$i][0].'"> '.$allbranch[$i][1].'</h4>
                </div>';
                            }
                            ?>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="addpackagebutton" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function ()
        {


            $("#addpackagebutton").click(function (e)
            {
                e.preventDefault();
                var formdata = new FormData($("#packageADDForm")[0]);
                formdata.append("option","packageADDForm");
                $.ajax({
                    url:"packageServer.php",
                    method:"POST",
                    data:formdata,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $('#pleaseWaitDialog').modal();
                    },
                    success:function (data)
                    {
                        $('#pleaseWaitDialog').modal('hide');
                        if($.trim(data)!="")
                        {
                            alert(data);
                        }
                        location.reload();
                    }
                });
            });

            $(".SubmitFormActivationDishes").change(function ()
            {
                var formid=$(this).data("formid");
                var formdata = new FormData($("#FormActivationDish"+formid)[0]);
                formdata.append("option","SubmitFormActivationDishes");
                console.log(formdata);
                $.ajax({
                    url:"packageServer.php",
                    method:"POST",
                    data:formdata,
                    contentType: false,
                    processData: false,

                    beforeSend: function() {
                        $('#pleaseWaitDialog').modal();
                    },
                    success:function (data)
                    {
                        $('#pleaseWaitDialog').modal('hide');
                        if($.trim(data)!="")
                        {
                            alert(data);
                        }

                    }
                });
            });




            $(document).on("change",".changeDishType",function ()
            {
                if (!confirm('Are you sure you want to change  food dish Type in Food & Catering  Branches?'))
                    return  false;
                var id=$(this).data("dishtypeid");
                if(validation($(this),"Please Enter Dish Type"))
                    return false;
                var value=$(this).val();
                $.ajax({
                    url:"dishServer.php",
                    data:{id:id,value:value,option:"changeDishType"},
                    dataType:"text",
                    method:"POST",
                    beforeSend: function() {
                        $('#pleaseWaitDialog').modal();
                    },
                    success:function (data)
                    {
                        $('#pleaseWaitDialog').modal('hide');
                        if($.trim(data)!='')
                        {
                            alert(data);
                        }
                        else
                        {
                            location.reload();
                        }

                    }

                });

            });

            $(document).on("click",".Delele_Dish_Type",function ()
            {
                if (!confirm('Are you sure you want to DELETE  food dish in Food & Catering  Branches?'))
                    return  false;
                var id=$(this).data("dishtypeid");
                var value=$(this).val();
                $.ajax({
                    url:"dishServer.php",
                    data:{value:value,id:id,option:"Delele_Dish_Type"},
                    dataType:"text",
                    method:"POST",

                    beforeSend: function()
                    {
                        $('#pleaseWaitDialog').modal();
                    },
                    success:function (data)
                    {
                        $('#pleaseWaitDialog').modal('hide');
                        if($.trim(data)!='')
                        {
                            alert(data);
                        }
                        else
                        {
                            location.reload();
                        }

                    }
                });

            });


        });

    </script>


    </body>
    </html>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>