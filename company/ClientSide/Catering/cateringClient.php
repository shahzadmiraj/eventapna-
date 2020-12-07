<?php
include_once ('../../../connection/connect.php');
if(!isset($_GET['c']))
{
    header("location:../../../index.php");
}
include_once ("../../cateringBranches/dish/dishespriceModel.php");
$userid="NoUser";
if(isset($_COOKIE['userid']))
$userid=$_COOKIE['userid'];
$cateringid=$_GET['c'];
$sql='SELECT c.name,c.image,c.company_id,cl.country,cl.city,cl.address,cl.longitude,cl.latitude,cl.radius FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE
(ISNULL(c.expire))AND (ISNULL(cl.expire))AND(c.id='.$cateringid.')';
$catering=queryReceive($sql);

if(count($catering)==0)
{
    exit();
}

$sql='SELECT dt.id,dt.name FROM dishControl as dc INNER join  dish as d 
on(dc.dish_id=d.id) INNER join dish_type as dt 
on (d.dish_type_id=dt.id)
WHERE
(ISNULL(dc.expire)) AND(ISNULL(dt.expire))AND(dc.catering_id in('.$cateringid.'))
GROUP by (dt.id)';
$dishTypeDetail=queryReceive($sql);


$sql='SELECT `id`,`cateringPackages_id` FROM `cateringPackageControl` WHERE (catering_id='.$cateringid.')AND(ISNULL(expire))
GROUP by (cateringPackages_id)
';
$dishDealPackageDetail=queryReceive($sql);


?>
<!DOCTYPE html>
<head>

    <?php
    include('../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Catering Services</title>
    <meta name="description" content="Catering Services ,Services Company Services page, Order Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Catering Services,Food Services Company Management,Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../webdesign/css/CardStyle.css">
    <link rel="stylesheet" href="../../../webdesign/css/Gallery.css">
    <link rel="stylesheet" href="../../../webdesign/css/comment.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="../../../mapRadius/css/gmaps-lat-lng-radius.css" type="text/css">
    <script src="../../../webdesign/JSfile/JSFunction.js"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CateringOrderWizard/assets/css/bd-wizard.css">

    <script  src="../Hall/js/userLogin.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        .checked {
            color: orange;
        }



    </style>
</head>
<body>



<?php
include_once ("../../../webdesign/header/header.php");
?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo $catering[0][0]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="#">Curent Catering
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../../../contactUs/companyContact.php?c=<?php echo $catering[0][2];?>">Contact us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../Company/ClientCompany.php?c=<?php echo $catering[0][2]; ?>">Company Service</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
$HeadingImage=$catering[0][1];
$HeadingName=$catering[0][0];
$Source='../../../images/catering/';
include_once ("../Company/Box.php");
?>

<div class="container">

    <div class="row">
        <div class="col-md-8 col-12 mb-5">
            <h2>Service Range <button class="btn btn-primary" id="See_Map">Click to See Map</button></h2>
            <hr>



            <div class="container">
                <input hidden value="<?php echo $catering[0][8];?>"  id="radius" name="radius" class="form-control" type="number" placeholder="Target Radius Set Map ">
                <input hidden  value="<?php echo $catering[0][7];?>" id="latitude" name="latitude" class="form-control" type="number" placeholder="Latitude Set Map">
                <input hidden value="<?php echo $catering[0][6];?>"   id="longitude" name="longitude" class="form-control" type="number" placeholder="Longitude Set Map">


                <input hidden id="pac-input" class="controls" type="text" placeholder="Enter a location">
                <div hidden id="shape-input" class="controls">
                    <div class="shape-option selected" data-geo-type="circle">Circle</div>
                    <div class="shape-option" data-geo-type="polygon">Polygon</div></div>
                <div hidden id="output-container" class="controls">
                    <button class="copybtn" data-clipboard-target="#pos-output"><img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="12" alt="Copy to clipboard"></button>
                    <div id="pos-output">Start by searching for the city...</div>
                </div>
                <div id="map"></div>
            </div>
        </div>


        <div class="col-md-4 mb-5 ">
            <h2>Service inormation </h2>
            <hr>
            <address>

                <span class="p-3">Country  <?php echo $catering[0][3]; ?></span><br>
                <span class="p-3">City <?php echo $catering[0][4]; ?> </span>
                <br>
                <p class="p-3">Address:<?php echo $catering[0][5]; ?></p><br>
                <span class="p-3">Target Area within below range </span><br>
                <strong class="p-3"><?php echo $catering[0][8]; ?>KM</strong>
                <br>
            </address>









        </div>


    </div>
    <!-- /.row -->

    <form id="SubmitFormOfPackage" class="container ">
       <!-- <?php
       $displayModelExtraItems="";
/*        $OneD = array_column($MenuType, 1);
        $Listofitemtypes = implode(',', $OneD);
        */?>
        <input hidden type="text" name="listofitemtype" value="<?php /*echo $Listofitemtypes;*/?>">
        <input hidden type="number" name="pid" value="<?php /*echo $PackageDateid;*/?>">
        <input hidden type="text" name="cateringid" value="No">
        <input hidden type="number" name="hallid" value="<?php /*echo $PackageDetail[0][5];*/?>">
        <input hidden type="date" name="date" value="<?php /*echo $PackageDate[0][1];*/?>">
        <input hidden type="text" name="time" value="<?php /*echo $PackageDetail[0][4];*/?>">
        <input hidden type="number" name="perheadwith" value="<?php /*echo $PackageDetail[0][1];*/?>">
        <input hidden type="number" name="Charges" value="<?php /*echo '0';*/?>">-->
        <?php
        include_once ("../CateringOrderWizard/index.php");
        echo $displayModelExtraItems;
        ?>
    </form>





    <h2>Deals !</h2>
    <hr>
    <div class="row">
        <?php
        $display='';
        for($i=0;$i<count($dishDealPackageDetail);$i++)
        {

            $sql = '

SELECT `id`, `packageName`, `description`, `image`, `token`, `PerHeadprice`, `activeDate`, `expireDate`, `activeUser`, `expireUser` FROM `cateringPackages` WHERE (id=' . $dishDealPackageDetail[$i][1] . ')
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
            $display .='<div class="card m-auto" style="width: 18rem;">
  <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
  <div class="card-body">
    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[0][1] . '</h5>
    <p class="card-text">'. $dishDetail[0][2].'</p>
  </div>
  <ul class="list-group list-group-flush">
  <li class="list-group-item">Deal id:'. $dishDetail[0][0] . '</li>
    <li class="list-group-item text-danger"><i class="far fa-money-bill-alt"></i> Per Head Rate:   ' . $dishDetail[0][5] . '</li>
      <li class="list-group-item">Quantity: <input type="number" id="DealQuantity'.$dishDetail[0][0].'" placeholder="Quantity"></li>
      
  </ul>';


            $display.='    
                <div class="card-footer">
                    <button data-dealid="'.$dishDetail[0][0].'" data-dealname="'. $dishDetail[0][2].'" data-dealdescription="'.$dishDetail[0][1].'" data-dealimage="'.$image.'" data-dealprice="'.$dishDetail[0][5].'"   class="addDealOncart btn btn-primary form-control mt-5">Add Deal</button>
                </div>
                                </div>';


        }
        echo $display;
        ?>





    </div>







    <h2>Dishes</h2>
    <hr>
        <?php

        $DishPriceModel='';

    $display='';
    for($i=0;$i<count($dishTypeDetail);$i++)
    {
        $display .= '<div class="row">';
        $display .= '<h4  data-dishtype="' . $i . '" data-display="hide"    class="col-md-12 text-center dishtypes">' . $dishTypeDetail[$i][1] . '</h4>';

        $sql = 'SELECT d.name, d.id,d.image,(SELECT price FROM `dishWithAttribute` WHERE dish_id=d.id limit 1 ),d.token FROM dish as d
 INNER join
 dishControl as dc
 on(dc.dish_id=d.id)
 
 
 
 WHERE (dish_type_id=' . $dishTypeDetail[$i][0] . ')AND(ISNULL(d.expire))AND(ISNULL(dc.expire))AND(dc.catering_id in('.$cateringid.')) ';


        $dishDetail = queryReceive($sql);

        for ($CaterinClientJ=0;$CaterinClientJ<count($dishDetail);$CaterinClientJ++)
        {


            $image='';
            if(file_exists('../../../images/dishImages/'.$dishDetail[$CaterinClientJ][2])&&($dishDetail[$CaterinClientJ][2]!=""))
            {
                $image= '../../../images/dishImages/'.$dishDetail[$CaterinClientJ][2];
            }
            else
            {
                $image='../../../images/systemImage/imageNotFound.png';
            }

            $display.='
        <div class="card col-md-4 m-auto" >
            <div class="h-80">
                <img class="card-img-top" src="'.$image.'" alt="" style="height: 20vh">
                <div class="card-body">
                    <h6 class="card-title">' . $dishDetail[$CaterinClientJ][0] . ' </h6>
                         <button type="button"  data-image="'.$dishDetail[$CaterinClientJ][2].'" data-dishname="'. $dishDetail[$CaterinClientJ][0] .'"  data-dishid="'. $dishDetail[$CaterinClientJ][1] .'"   data-toggle="modal" data-target="#ModalDishPrice'.$dishDetail[$CaterinClientJ][1].'"   class="col-12 mb-0 btn btn-primary"><i class="fas fa-check "></i>  Show Price</button>
                </div>
            </div>
        </div>';

            //modal
            $DishPriceModel.='
    <div id="ModalDishPrice'.$dishDetail[$CaterinClientJ][1].'" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content"  >';

            $DishPriceModel.=DishesPriceModelShow($image,$dishDetail[$CaterinClientJ][1],$dishDetail[$CaterinClientJ][0]);

            $DishPriceModel.= '

            </div>

        </div>
    </div>
';


        }





        $display.='</div>';

        }

        echo $display;

    echo $DishPriceModel;

    ?>











    <h2>Team information</h2>
    <hr>

    <div class="row">



        <?php
        $SenderAddress=array();
        $SenderName=array();
        //'.$hallInformation[0][0].'
        $sql='SELECT u.username, u.image,BJS.WorkingStatus, u.email, u.number FROM user as u inner join BranchesJobStatus as BJS on (u.id=BJS.user_id) WHERE (ISNULL(BJS.ExpireDate)AND(BJS.WorkingStatus="Manager") AND(ISNULL(u.expire))AND(BJS.catering_id='.$cateringid.') )';
        $users=queryReceive($sql);
        $sql='SELECT  `username`,`image`,`jobTitle`, `email`, `number` FROM `user` WHERE ISNULL(expire)AND(company_id='.$catering[0][2].')AND(jobTitle="Owner")';
        $Owners=queryReceive($sql);


        $count=count($Owners);
        if(count($users)>0)
            $Owners[$count]=$users[0];
        for($i=0;$i<count($Owners);$i++)
        {
            $SenderAddress[$i]=$Owners[$i][3];
                $SenderName[$i]=$Owners[$i][0];

            $imageUser='../../../images/systemImage/imageNotFound.png';
            if(file_exists('../../../images/users/'.$Owners[$i][1])&&($Owners[$i][1]!=""))
            {
                $imageUser= '../../../images/users/'.$Owners[$i][1];
            }

            echo '
    <div class="col-md-4 mb-5">

        <address>

            <img src="'.$imageUser.'" class="img-thumbnail" style="width: 40%">
            <span>'.$Owners[$i][0].'</span>
            <br>
            <strong>'.$Owners[$i][2].'</strong>
            <br>
            <span>'.$Owners[$i][3].'</span>
            <br>
            <span>P# '.$Owners[$i][4].'.</span>
        </address>


    </div>';
        }

        $SenderAddressUnique=array_unique($SenderAddress);
        $SenderNameUnique=array_unique($SenderName);
        $SenderAddressList= implode(',', $SenderAddressUnique);
        $SenderNameList=implode(',',$SenderNameUnique)




        ?>

    </div>


    </div>




    </div>






<!--
container-->
</div>








<div class="container">

    <?php
    $sql='SELECT  image FROM images WHERE ISNULL(expire)AND (catering_id='.$cateringid.')';
    $Images=queryReceive($sql);
    $destinatios="../../../images/Gallery/Catering/";

    include_once "../All/PictureGallery.php";
    ?>
    <script src="../../../webdesign/JSfile/Gallery.js"></script>

</div>



<div class="container" >
    <?php
    $video=$Images;
    $destinatios="../../../images/Gallery/Hall/";
    include_once "../All/VideoGallery.php"
    ?>
    <script src="../../../webdesign/JSfile/video.js"></script>
</div>









<div class="container">
    <h2>Contact us</h2>
    <hr>
</div>


<?php
$urlContactus="../../../contactUs/contactServer.php";
$ExtraInformation="contact form".'<h2>'.$catering[0][0].'</h2>';
include_once ("../../../contactUs/contactUs.php");
?>








<?php
$formApend= '
<input hidden type="number" name="cateringid" value="'.$cateringid.'">
<input hidden type="number" name="userid" value="'.$userid.'">
';
$sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, (SELECT u.username FROM user as u 
where u.id=comments.user_id), (SELECT u.image FROM user as u 
where u.id=comments.user_id), `PackOrDishId`, `expireUser`,`rating`,`image` FROM `comments` WHERE (catering_id='.$cateringid.')AND(ISNULL(expire)) ';

$destinatiosUser="../../../images/users/";
$destinationComment="../../../images/comment/cateringComment/";
$isPackShow=0;
$urldata="../../cateringBranches/cateringComment/commentCateringServer.php";
$option="commentCatering";
include_once "../All/Comments.php"
?>





<script src="../../../mapRadius/js/constantMap.js"></script>

<script>


    $(document).ready(function ()
    {
        function addSwal() {
            swal({
                html:true,
                title: "Add item",
                text: 'Item has been added',
                buttons: false,
                icon: "success",
                timer: 1500,
            });

        }
        function removeSWAL() {
            swal({
                title: "Deleted",
                text: 'Item has been Deleted',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });
        }
        var count=0;
        function TableOFBodyMenuAdd(id,image,item,Type,description,price,InputQuantity)
        {
            var text='<tr id="removeRowFromTableCard'+count+'">\n' +
                '      <th scope="row">'+id+'<input type="number" name="ids[]" value="'+id+'" hidden></th>\n' +
                '      <td>  <img src="'+image+'" style="width: 80px"></td>\n' +
                '      <td>'+item+'</td>\n' +
                '      <td>'+Type+'<input type="text" name="type[]" value="'+Type+'" hidden></td>\n' +
                '      <td>'+description+'</td>\n' +
                '      <td>'+price+'</td>\n' +
                '      <td>'+InputQuantity+'<input type="number" name="quantity[]" value="'+InputQuantity+'" hidden></td>\n' +
                '      <td>'+(Number(price)*Number(InputQuantity))+'<input type="number" class="AddTotalDishesAndDeals" name="total[]" value="'+(Number(price)*Number(InputQuantity))+'" hidden></td>\n' +
                '      <td><button data-removerow="'+count+'" class="removeRowFromTableCard btn btn-danger">X</button></td>\n' +
                '    </tr>';
            count++;
            return text;
        }


        $(document).on('click',".addDishPriceidButton",function () {
            var addDishPriceidButton=$(this).data("adddishpriceidbutton");
            var image=$(this).data("image");
            var item=$(this).data("item");
            //var type=$(this).data("type");
            var description=$(this).data("description");
            var price=$(this).data("price");
            var InputQuantity=$("#InputQuantity"+addDishPriceidButton).val();
            if(validationWithString("InputQuantity"+addDishPriceidButton,"Please Enter Quantity of Dish"))
             return false;

            var text=TableOFBodyMenuAdd(addDishPriceidButton,image,item,"Dish",description,price,InputQuantity);
            $("#TableOFBodyMenu").append(text);
            CompleteCalculation();
            addSwal();
        });
        $(document).on("click",".addDealOncart",function () {
            var dealid=$(this).data("dealid");
            var dealname=$(this).data("dealname");
            var dealdescription=$(this).data("dealdescription");
            var dealimage=$(this).data("dealimage");
            var dealprice=$(this).data("dealprice");
            var DealQuantity=$("#DealQuantity"+dealid).val();
            if(validationWithString("DealQuantity"+dealid,"Please Enter Quantity of Deal"))
                return false;
            var text=TableOFBodyMenuAdd(dealid,dealimage,dealname,"Deal",dealdescription,dealprice,DealQuantity);
            $("#TableOFBodyMenu").append(text);
            CompleteCalculation();
            addSwal();
        });

        $(document).on("click",".removeRowFromTableCard",function () {
            var removerow=$(this).data("removerow");
            $("#removeRowFromTableCard"+removerow).remove();
            CompleteCalculation();
            removeSWAL();

        });

        function CalculateExtraitemAddInTable()
        {
            var TotalExtraItem=0;
            $(".AddTotalDishesAndDeals").each(function () {
                TotalExtraItem+=Number($(this).val());
            });
            // console.log(TotalExtraItem);
            return TotalExtraItem;
        }
        function CompleteCalculation()
        {

            var TotalExtraItem=0;
            TotalExtraItem=CalculateExtraitemAddInTable();
            $("#wizardTotalAmountPackage").val(TotalExtraItem);
            $("#wizardAmountPackage").val(TotalExtraItem);
        }



        $(document).on("click",".dishtypes",function () {
            var display=$(this).data("display");
            var IdDisplay=$(this).data("dishtype");
            if(display=="hide")
            {
                $("#dishtype"+IdDisplay).show('slow');
                $(this).data("display","show");
            }
            else
            {

                $("#dishtype"+IdDisplay).hide('slow');
                $(this).data("display","hide");
            }

        });
    });

    $(document).ready(function()
    {

        $("#See_Map").click(function ()
        {
            $("#map").css({"width": "100%", "height": "60vh"});
            $.ajax({
                        url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initMap",
                        dataType: "script",
                        cache: false
                    });
        });
    });
</script>

<script src="../CateringOrderWizard/assets/js/jquery.steps.min.js"></script>
<script src="../CateringOrderWizard/assets/js/bd-wizard.js"></script>

<?php
include_once ("../../../webdesign/footer/footer.php");
?>
</body>
</html>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>