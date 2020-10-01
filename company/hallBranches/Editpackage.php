<?php
include_once ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfPackagesDate("Owner","../../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);


$packageDateId=$_GET['pdid'];
$packageDateToken=$_GET['pdtoken'];


$sql='SELECT package_id,selectedDate FROM packageDate WHERE ISNULL(expire)AND(id='.$packageDateId.')AND(token="'.$packageDateToken.'")';
$packageSelective=queryReceive($sql);

$packageid=$packageSelective[0][0];

$companyid=$userdetail[0][0];
$sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`, `expire`,1, `package_name`, `active`, `user_id`, `expireUser`, (SELECT u.username FROM user as u where u.id=packages.user_id),`MinimumGuest` FROM `packages` WHERE (id='.$packageid.')AND(ISNULL(expire))';
$packageDetail=queryReceive($sql);
$userid=$_COOKIE['userid'];

$sql='SELECT `name` FROM `company` WHERE id='.$companyid.' AND ISNULL(expire)';
$CompanyInfo=queryReceive($sql);



?>

<!DOCTYPE html>
<head>



    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Edit Hall Package</title>
    <meta name="description" content="Edit Hall Package page,Edit Hall Package Deal ,Edit Detail packages Marquee,Edit Detail Marquee Deal,Preview Detail New Dera Packages only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Edit Hall Package page,Preview Package,Show Package  Marquee,Display Package  Marquee,change Package  Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <script src="../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
 <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/comment.css">

    <link rel="stylesheet" href="../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>
    <style>

        #selectedmenu
        {
            background: #F09819;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EDDE5D, #F09819);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EDDE5D, #F09819); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        #selectmenu
        {
            background: #9796f0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #fbc7d4, #9796f0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #fbc7d4, #9796f0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .checked {
            color: orange;
        }
    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>

<?php
$HeadingImage="";
$HeadingName=$CompanyInfo[0][0];
$Source='';
$pageName='Package Edit ';
include_once ("../ClientSide/Company/Box.php");
?>

<div class="container card">
    <form id="EditPackageForm">
        <input hidden name="companyid" value="<?php echo $companyid;?>">

        <input hidden name="userid" value="<?php echo $userid;?>">

        <input hidden name="packageid" value="<?php echo $packageDetail[0][0];?>">
    <h6>You can just manage Dates  , Delect package and activation for halls</h6>
    <div class="form-group row">
        <lable class="col-form-label">Packages Name</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
            </div>
            <input  readonly data-columnname="package_name"     class="packagechange form-control" type="text" value="<?php echo $packageDetail[0][7];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Rate per head</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>
            <input readonly data-columnname="price" class="packagechange form-control" type="number" value="<?php echo $packageDetail[0][2];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable for="PackagesType" class="col-form-label">Packages per head With:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chair"></i></span>
            </div>
            <select name="PackagesType" id="PackagesType" class="form-control">
                <?php
                if($packageDetail[0][1]==0)
                {
                    echo '<option value="0">per head only seating </option>';
                }
                else
                {
                        echo '
                <option value="1">per head Food and seating</option>';
                }

                ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <lable for="describe" class="col-form-label">Package Daytime:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
            </div>
            <select id="Daytime" name="Daytime" class="form-control" placeholder="Daytime" >
                <?php
                echo '
                <option>'.$packageDetail[0][4].'</option>'

                ?>
            </select>

        </div>
    </div>
    <div class="form-group row">
        <lable for="rate" class="col-form-label">How many minimum guest will book this packages</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>
            <input readonly id="MinimumGuest" name="MinimumGuest" class="form-control" type="number"  value="<?php echo $packageDetail[0][12];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Description</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>
            <textarea readonly data-columnname="describe"  class=" form-control" > <?php echo $packageDetail[0][3];?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Active Date</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
            </div>
            <input readonly data-columnname="price" class="packagechange form-control" type="datetime" value="<?php echo $packageDetail[0][8];?>">
        </div>
    </div>

        <div class="form-group row m-auto">
            <lable for="describe" class="col-form-label">Add New  Items in package  </lable>
            <button type="button" class="btn btn-primary form-control " data-toggle="modal" data-target="#exampleModal">
                + Add item
            </button>
        </div>


        <div class="container mt-5 border border-dark" id="RowsColumns">


            <?php
            $RowPhp=1;
            $ColumnPhp=1;

            $sql='SELECT `id`, `itemname`,`itemtype` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packageDetail[0][0].') GROUP BY itemtype';
            $MenuType=queryReceive($sql);

            $arrayDisplay='';
            $display='';

            if(count($MenuType)>0)
                $display="<h3 class='text-center col-12'>Choices of items</h3>";
            for($i=0;$i<count($MenuType);$i++)
            {
                $arrayDisplay.='arrayOfItemType.push({
                                            itemtypeNumber: '.($i+1).',
                                            itemtype: "'.$MenuType[$i][2].'",
                                                  });';
                $RowPhp++;
                $display.=' <div class="row" id="RowNumber-'.($i+1).'">
                                   
                                    <div class="input-group mb-3 input-group-lg">
                                            <button type="button" data-rownumber="'.($i+1).'" class="RemoveRow btn btn-danger">- Type </button>
                                            <input readonly id="RowName-'.($i+1).'" type="text" class="form-control text-center" placeholder="Name of items type"   style="border:none" value="'.$MenuType[$i][2].'">
                                            <button type="button" data-rownumber="'.($i+1).'"  class="btn btn-primary AddColumn"  >+ Item</button>
                                     </div>';

                $sql='SELECT `id`, `itemname`,`itemtype`,`price`	 FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packageDetail[0][0].')AND (itemtype="'.$MenuType[$i][2].'")';
                $MenuName=queryReceive($sql);
                for($k=0;$k<count($MenuName);$k++)
                {
                    $display.='  <div class="card" style="width: 25rem;" id="columnno-'.$k.'">
                                    <div class="card-body">
                                            <h5 class="card-title form-inline">Item Name: <input type="text" name="SelecteditemsName[]"  value="'.$MenuName[$k][1].'"  style="border:none"> </h5>
                                            <input hidden type="number" name="SelecteditemIds[]"  value="'.$MenuName[$k][0].'"  >
                                            ';
                                    $priceShow="hidden";
                                    if($MenuName[$k][3]!=0)
                                        $priceShow="";

                                         $display.= '<h6 '.$priceShow.'  class="card-subtitle mb-2 text-muted form-inline">Item price: <input type="number" name="SelectedPriceItem[]" readonly value="'.$MenuName[$k][3].'"  style="border:none"></h6>
                                            <h6 class="card-subtitle mb-2 text-muted form-inline">Item type: <input type="text" name="SelecteditemsType[]" readonly value="'.$MenuType[$i][2].'"  style="border:none"></h6>
                                             <button data-columnno="'.$k.'" class="RemoveColumn btn btn-danger form-control"> Delete item</button>
                                        </div>
                               </div>';

                    $ColumnPhp++;
                }

                $display.='</div>';
            }

            echo $display;

            ?>






        </div>

    <div class="form-group card">


        <lable  class="col-form-label">Select hall for package active</lable>


        <?php
        //
        $sql='SELECT `hall_id`,`id`,(SELECT hall.name from hall WHERE hall.id=packageControl.hall_id) FROM `packageControl` WHERE (ISNULL(expire))AND(package_id='.$packageDetail[0][0].')';
        $SelectiveHalls=queryReceive($sql);
        for($i=0;$i<count($SelectiveHalls);$i++)
        {
            echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="selectedHalls[]" value="'.$SelectiveHalls[$i][1].'"> '.$SelectiveHalls[$i][2].'</h4>
                </div>';
        }
        $SelectiveHalls=array_column($SelectiveHalls, 0);
        $List = implode(', ', $SelectiveHalls);



        $sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')AND( id NOT IN ('.$List.'))';
        $AllHalls=queryReceive($sql);
        for($i=0;$i<count($AllHalls);$i++)
        {
            echo '  
              <div class="checkbox">
                <h4><input type="checkbox"   name="hallactive[]" value="'.$AllHalls[$i][0].'"> '.$AllHalls[$i][1].'</h4>
                </div>';
        }
        ?>

    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Active User</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input readonly  class="form-control" type="text" value="<?php echo $packageDetail[0][11];?>">
        </div>
    </div>


    </form>


    <h2>Calender </h2>
    <hr>
    <div id="calendar" ></div>
    <hr>







<form id="submitpackage">


<h2>Packages all detail</h2>
<div style="overflow:auto;height: 40vh">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>No:</th>
            <th>ID date:</th>
            <th>Date:</th>
            <th>User Name:</th>
            <th>Active Date:</th>
        </tr>
        </thead>
        <tbody  id="tableEditpackages">

        </tbody>
    </table>
</div>





<div class="col-12 mt-2 row" >
        <button id="deletePackage"  type="button"  class="btn btn-danger col-6 m-auto"><i class="fas fa-trash-alt"></i>Delect Package</button>
        <button id="SubmitFormPackage"  type="button"  class="btn btn-primary col-6 m-auto">Submit</button>
    </div>

</form>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Item </h5>
                        <button   type="button" class="close closemodel" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="container">


                                <div class="form-group row">
                                    <lable for="describe" class="col-form-label">Items Name:</lable>
                                    <div class="input-group mb-3 input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                        </div>
                                        <input  id="NameOfItem" type="text"  class="form-control" placeholder="Name of item">
                                    </div>
                                </div>

                                <div class="form-group row" id="DisplayNameOfItemType">
                                    <lable for="describe" class="col-form-label">Items Type :</lable>
                                    <div class="input-group mb-3 input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                        </div>
                                        <select id="NameOfItemType" class="form-control">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="NewItemTypeAdd">
                                    <lable for="describe" class="col-form-label">Other item type:New Row</lable>
                                    <div class="input-group mb-3 input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                        </div>
                                        <input  id="itemChoice" type="text" class="form-control" placeholder="Name of Item Type">
                                    </div>
                                </div>



                                <div class="form-group row" id="IncludeItem">
                                    <lable for="describe" class="col-form-label">Include item in this packagse or extra charges</lable>
                                    <div class="input-group mb-3 input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                        </div>
                                        <select id="IncludeItemOption" class="form-control">
                                            <option value="includeItem">No Extra Chages .this Item include in this package</option>
                                            <option value="NoItemNot include">Extra charges of this item</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row" id="ExtrachargeOfitem" style="display: none">
                                    <lable for="describe" class="col-form-label">How much customer pay for this item</lable>
                                    <div class="input-group mb-3 input-group-lg">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                                        </div>
                                        <input  id="ExtrachargeOfitemAmount" type="number" class="form-control" placeholder="How much Extra charge ?">
                                    </div>
                                </div>





                            </div>




                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                        <button type="button" id="AddItemInForm" class="btn btn-primary float-right">Save changes</button>
                    </div>
                </div>
            </div>
        </div>









    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <lable for="describe" class="col-form-label">Items Name:</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <input  id="NameOfItemExtra" type="text"  class="form-control" placeholder="Name of item">
                        </div>
                    </div>

                    <div class="form-group row" id="NewItemTypeAdd">
                        <lable for="describe" class="col-form-label">Other item type:New Row</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <input  readonly id="itemChoiceExtra" type="text" class="form-control" placeholder="Name of Item Type">
                        </div>
                    </div>



                    <div class="form-group row" id="IncludeItemExtra">
                        <lable for="describe" class="col-form-label">Include item in this packagse or extra charges</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <select id="IncludeItemOptionExtra" class="form-control">
                                <option value="includeItem">No Extra Chages .this Item include in this package</option>
                                <option value="NoItemNot include">Extra charges of this item</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="ExtrachargeOfitemExtra" style="display:none">
                        <lable for="describe" class="col-form-label">How much customer pay for this item</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-comments"></i></span>
                            </div>
                            <input  id="ExtrachargeOfitemAmountExtra" type="number" class="form-control" placeholder="How much Extra charge ?">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="SubmitExtraColumn" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



</div>
<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {



        function ExtraItemControl(Main,Secondary)
        {
            var value=$("#"+Main).val();
            if(value==="includeItem")
            {
                $("#"+Secondary).hide();
            }
            else
            {
                $("#"+Secondary).show();
            }
        }

        $("#IncludeItemOption").change(function ()
        {
            ExtraItemControl("IncludeItemOption","ExtrachargeOfitem");
        });

        $("#IncludeItemOptionExtra").change(function ()
        {
            ExtraItemControl("IncludeItemOptionExtra","ExtrachargeOfitemExtra");
        });


        var RowNumber=Number("<?php echo $RowPhp;?>");
        var ColumnNumber=Number("<?php echo $ColumnPhp;?>");
        var VarItemsType = {
            itemtypeNumber: 1,
            itemtype: "Other",
        };
        var arrayOfItemType= [];
        arrayOfItemType.push(VarItemsType);
        <?php
        echo $arrayDisplay;
        ?>
        function  TextItemTypeOptions()
        {
            var text="";
            arrayOfItemType.forEach(myFunction);
            function myFunction(item, index, arr)
            {
                text+='<option value="'+arr[index].itemtype+'">'+arr[index].itemtype+'</option>';
            }
            $("#NameOfItemType").html(text);
        }

        TextItemTypeOptions();


        function TypeControl()
        {
            var value=$("#NameOfItemType").val();
            if(value==="Other")
            {
                $("#NewItemTypeAdd").show();
            }
            else
            {
                $("#NewItemTypeAdd").hide();
            }
        }

        TypeControl();

        $("#NameOfItemType").change(TypeControl);

        function findIndex(itemtype)
        {
            var indexGloble=-1;
            arrayOfItemType.forEach(myFunction);
            function myFunction(item, index, arr)
            {
                if(arr[index].itemtype===itemtype)
                {
                    indexGloble=index;
                }
            }
            return indexGloble;
        }


        function GetColumn(ItemName,ItemType,RowNumber,ColumnNumber,ItemPrice)
        {
            var text=' <div class="card" style="width: 25rem;" id="columnno-'+ColumnNumber+'">\n' +
                '                <div class="card-body">\n' +
                '                    <h5 class="card-title form-inline">Item Name: <input type="text" name="itemsName[]"  value="'+ItemName+'"  style="border:none"> </h5>\n' +
                '                    <h6 class="card-subtitle mb-2 text-muted form-inline">Item type: <input type="text" name="itemsType[]" readonly value="'+ItemType+'"  style="border:none"></h6>\n' +
                '                    <h6 class="card-subtitle mb-2 text-muted form-inline">Item Price: <input type="text" name="PriceItem[]" readonly value="'+ItemPrice+'"  style="border:none"></h6>\n' +
                '                    <button data-columnno="'+ColumnNumber+'" class="RemoveColumn btn btn-danger form-control"> Delete item</button>\n' +
                '                </div>\n' +
                '            </div>';
            return text;
        }

        function GetRowColumn(ItemName,ItemType,RowNumber,ColumnNumber,ItemPrice)
        {
            var text='<div class="row" id="RowNumber-'+RowNumber+'">\n' +
                '            <div class="col-12">\n' +
                '                <div class="input-group mb-3 input-group-lg">\n' +
                '                    <button type="button" data-rownumber="'+RowNumber+'" class="RemoveRow btn btn-danger">- Type </button>\n' +
                '                    <input readonly id="RowName-'+RowNumber+'" type="text" class="form-control text-center" placeholder="Name of items type"   style="border:none" value="'+ItemType+'">\n' +
                '                    <button type="button" data-rownumber="'+RowNumber+'"  class="btn btn-primary AddColumn"  >+ Item</button>\n' +
                '                </div>\n' +
                '            </div>\n' ;

            text+=GetColumn(ItemName,ItemType,RowNumber,ColumnNumber,ItemPrice);

            text+='</div>';
            return text;
        }

        $("#NameOfItemType").change(function () {
            var ItemsTypes=$(this).val();
        });


        $("#AddItemInForm").click(function (e)
        {
            e.preventDefault();
            var NameOfItem=$("#NameOfItem").val();
            var TypeOfItem=$("#NameOfItemType").val();
            var ExtraItemType=$("#IncludeItemOption").val();
            var valueOfExtraCharge=$("#ExtrachargeOfitemAmount").val();
            if(ExtraItemType=="includeItem")
            {
                valueOfExtraCharge=0;
            }
            var TypeString="";
            if(NameOfItem=="")
            {
                alert("Enter Name of item");
                return  false;
            }
            if(TypeOfItem==="Other")
            {
                //other type user select
                TypeString=$("#itemChoice").val();

                if(TypeString=="")
                {
                    alert("Please Enter type of item");
                    return  false;
                }

                if(findIndex(TypeString)!=-1)
                {
                    alert("You Have already insert same Type of item");
                    return false;
                }
                var VarItemsType = {
                    itemtypeNumber: RowNumber,
                    itemtype: TypeString,
                };
                arrayOfItemType.push(VarItemsType);
                TextItemTypeOptions();
                var text=GetRowColumn(NameOfItem,TypeString,RowNumber,ColumnNumber,valueOfExtraCharge);
                $("#RowsColumns").append(text);
                RowNumber++;
                ColumnNumber++;
            }
            else
            {
                // not other select
                TypeString= TypeOfItem;
                var index=findIndex(TypeString);
                var AlreadyRowNumber=arrayOfItemType[index].itemtypeNumber;
                var text= GetColumn(NameOfItem,TypeString,AlreadyRowNumber,ColumnNumber,valueOfExtraCharge);
                $("#RowNumber-"+AlreadyRowNumber).append(text);
                ColumnNumber++;
            }



            $("#NameOfItem").val("");
            $("#itemChoice").val("");
            $("#ExtrachargeOfitem").val("");
            $("#ExtrachargeOfitemAmount").val("");
            $('#exampleModal').modal('hide');
        });


        $(document).on("click",".RemoveRow",function () {
            var row=$(this).data("rownumber");
            var typeitem=$("#RowName-"+row).val();
            var index=findIndex(typeitem);
            delete arrayOfItemType[index];
            $("#RowNumber-"+row).remove();

            TextItemTypeOptions();
        });

        $(document).on("click",".RemoveColumn",function () {
            var col=$(this).data("columnno");
            $("#columnno-"+col).remove();
        });

        var rowExtraNumber=-1;
        $(document).on("click",".AddColumn",function () {

            rowExtraNumber=$(this).data("rownumber");
            var itemType=$("#RowName-"+rowExtraNumber).val();
            $("#exampleModalLongTitle").html(itemType);
            $('#exampleModalCenter').modal();
            $("#NameOfItemExtra").val("");
            $("#itemChoiceExtra").val(itemType);
        });

        $(document).on("click","#SubmitExtraColumn",function () {
            var NameOfItemExtra=$("#NameOfItemExtra").val();
            var itemChoiceExtra=$("#itemChoiceExtra").val();
            var ExtraItemType=$("#IncludeItemOptionExtra").val();
            var valueOfExtraCharge=$("#ExtrachargeOfitemAmountExtra").val();
            if(ExtraItemType==="includeItem")
            {
                valueOfExtraCharge=0;
            }

            var text=GetColumn(NameOfItemExtra,itemChoiceExtra,rowExtraNumber,ColumnNumber,valueOfExtraCharge)
            $("#RowNumber-"+rowExtraNumber).append(text);
            ColumnNumber++;
            $('#exampleModalCenter').modal("hide");
        });



        $("#SubmitFormPackage").click(function ()
        {
            if (!confirm('Are you sure you want to Save Package informatiom ?'))
                return  false;

            var formdata = new FormData($("#EditPackageForm")[0]);
            formdata.append("option","SubmitPackagesSave");
            $.ajax({
                url:"packages/PACKServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                },
                success:function (data)
                {
                    if($.trim(data)!='')
                        alert(data);
                    else
                    window.history.back();
                }
            });
        });


        function updateTable()
        {
            $.ajax({
                url:"../../calender/fulcalender/pacakageOption.php",
                type:"POST",
                data:{option:"updateEdittable",Packageid:"<?php echo $packageid?>"},

                success:function (data)
                {

                    $("#tableEditpackages").html(data);
                }
            })
        }



        var Editformdata=new FormData;
        Editformdata.append("option","SpecificpackageView");
        Editformdata.append("packageid","<?php echo $packageid?>");
        var calendar = $('#calendar').fullCalendar({
            editable:false,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,listWeek,dayGridWeek'
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '../../calender/fulcalender/pacakageOption.php',
                    method:"POST",
                    data:Editformdata,
                    contentType: false,
                    processData: false,
                    success:function (doc)
                    {
                        updateTable();
                        var obj = jQuery.parseJSON(doc);
                        var events = [];
                        $.each(obj, function(index, value) {
                            events.push({
                                end: value['end'],
                                id: value['id'],
                                start: value['start'],
                                title: value['title'],
                            });
                            //console.log(value)
                        });
                        callback(events);
                    },
                    error: function(e, x, y) {
                        console.log(e);
                        console.log(x);
                        console.log(y);
                    }

                });
            },
            selectable:true,
            selectHelper:true,
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    var userid="<?php echo $userid;?>";
                    $.ajax({
                        url:"../../calender/fulcalender/pacakageOption.php",
                        type:"POST",
                        data:{id:id,option:"DelectEventdate",userid:userid},
                    success:function (data)
                    {

                        calendar.fullCalendar('refetchEvents');
                            updateTable();
                           // alert("Event Removed");
                        }
                    })
                }
            },
            select: function(start, end, allDay)
            {
                var selectedDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
                if(confirm("Are you sure to Add event on this Date "+selectedDate))
                {
                    $.ajax({
                        url:"../../calender/fulcalender/pacakageOption.php",
                        type:"POST",
                        data:{option:"InsertNewDate", selectedDate:selectedDate,Packageid:"<?php echo $packageid?>",userid:"<?php echo $userid;?>"},
                         success:function ()
                        {
                        calendar.fullCalendar('refetchEvents');
                            updateTable();
                          //  alert("Added Successfully");
                        }
                    })
                }
            }

        });



        $("#PackagesType").change(function ()
        {
            checkpaktype();
        });
        $("#deletePackage").click(function (e)
        {
            e.preventDefault();
            if (!confirm('Are you sure you want to Delete Package Overall ?'))
                return  false;
            var userid="<?php echo $userid;?>";
            var formdata=new FormData;
            formdata.append("option","PackDelete");
            formdata.append("packageid",<?php echo $packageid;?>);
            formdata.append("userid",<?php echo $userid;?>);
            $.ajax({
                url:"packages/PACKServer.php",
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
                    if($.trim(data)!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });


        });





        var numbers=0;




        $("#btncancel").click(function (e)
        {
            e.preventDefault();

            if (!confirm('Are you sure you want to Delete Package Overall ?'))
                return  false;
            var value=$(this).val();
            var formdata=new FormData;
            formdata.append("option","ExpireBtn");
            formdata.append("packageid",<?php echo $packageid;?>);
            formdata.append("expirevalue",value);
            $.ajax({
                url:"../companyServer.php",
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

                    if($.trim(data)!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });
        });



        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });






    });


    var scores=3;
    $(document).ready(function(){
        $('#demo1').jsRapStar({
            onClick:function(score){
                $(this)[0].StarF.css({color:'red'});
                scores=score;
            }});
    });


</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>