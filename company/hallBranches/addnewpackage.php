<?php
include_once ("../../connection/connect.php");

include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];
$userid=$_COOKIE['userid'];
$sql='SELECT `name` FROM `company` WHERE id='.$companyid.' AND ISNULL(expire)';
$CompanyInfo=queryReceive($sql);
?>

<!DOCTYPE html>
<head>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Hall Package</title>
    <meta name="description" content="Add Hall Package page,Add Hall Package Deal ,Add Detail packages Marquee,Add Detail Marquee Deal,insert Detail New Dera Packages only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Hall Package page,Insert Package,New Package  Marquee,New Add Package  Marquee,New Package  Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../../calender/customDatepicker/styles.css" rel="stylesheet">
    <script src="../../calender/customDatepicker/multidatespicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script type="text/javascript" src="../../webdesign/JSfile/JSFunction.js"></script>

    <style>


    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");

?>
<?php
$HeadingImage="";
$HeadingName=$CompanyInfo[0][0];
$Source='..';
$pageName='Package Add ';
include_once ("../ClientSide/Company/Box.php");
?>










<div class="container card">


    <div class="form-group row ">
        <lable for="rate" class="col-form-label">Select Dates:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>



                <textarea placeholder="Select Dates of active pakages" type="text" id="selectedValues" class="date-values form-control" readonly></textarea>
                <div id="parent" class="container card border-danger p-3" style="display:none;">
                    <div class="row header-row">
                        <div class="col-xs previous">
                            <button type="button" id="previous" onclick="previous()">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="card-header month-selected col-sm" id="monthAndYear">
                        </div>
                        <div class="col-sm">
                            <select class="form-control col-xs-6" name="month" id="month" onchange="change()"></select>
                        </div>
                        <div class="col-sm">
                            <select class="form-control col-xs-6" name="year" id="year" onchange="change()"></select>
                        </div>
                        <div class="col-xs next">
                            <button type="button" id="next" onclick="next()">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="row col-12">

                            <button type="button" id="next" class="col-6 btn btn-outline-primary" onclick="SelectAllDates('AddAllDates')">
                                     Select all Dates
                            </button>
                            <button type="button" id="next" class="col-6 btn btn-outline-danger" onclick="SelectAllDates('RemoveAllDates')">
                                 Remove all Dates
                            </button>

                        </div>
                    </div>
                    <table id="calendar" class="container">
                        <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>
                        <tbody id="calendarBody" ></tbody>
                    </table>
                </div>
            </div>





        </div>
    </div>


<div class="container">



<form id="submitpackage" >




    <?php
    echo
        '
                    <input hidden  name="userid"  value="'.$userid.'">
                    ';
    ?>


    <div id="shownonperivious">
        <div class="form-group row">
            <lable for="packagename" class="col-form-label">Packages Name</lable>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
                </div>
                <input id="packagename" name="packagename" class="form-control" type="text" placeholder="Menu number or name ,menu_1,menu_2 ">

            </div>
        </div>

        <div class="form-group row">
            <lable for="rate" class="col-form-label">Packages Rate per head</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input id="rate" name="rate" class="form-control" type="number" placeholder="Price like 1000 per head">
            </div>
        </div>


        <div class="form-group row">
            <lable for="PackagesType" class="col-form-label">Packages per head With:</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-chair"></i></span>
                </div>
                <select name="PackagesType" id="PackagesType" class="form-control">
                    <option value="0">per head only seating </option>
                    <option value="1">per head Food and seating</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <lable for="describe" class="col-form-label">Package Timing:</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <select id="Daytime" name="Daytime" class="form-control" placeholder="Daytime" >
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Evening">Evening</option>

                </select>

            </div>
        </div>
        <div class="form-group row">
            <lable for="rate" class="col-form-label">How many minimum guest will book this packages</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input id="MinimumGuest" name="MinimumGuest" class="form-control" type="number" placeholder="Minimum Guest required for booking">
            </div>
        </div>

        <div class="form-group card">
            <input hidden name="companyid" value="<?php echo $companyid;?>">

            <lable  class="col-form-label">Select hall for package active</lable>


            <?php
            $sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')';
           $AllHalls=queryReceive($sql);
            for($i=0;$i<count($AllHalls);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="hallactive[]" value="'.$AllHalls[$i][0].'"> '.$AllHalls[$i][1].'</h4>
                </div>';
            }
            ?>

        </div>



        <div class="form-group row">
            <lable for="describe" class="col-form-label">Packages Description</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea id="describe" name="describe" class="form-control" placeholder="describe package information for client" ></textarea>

            </div>
        </div>

    </div>

    <div class="form-group row m-auto">
        <lable for="describe" class="col-form-label">Add New  Items in package  </lable>
        <button type="button" class="btn btn-primary form-control " data-toggle="modal" data-target="#exampleModal">
            + Add item
        </button>
    </div>







    <div class="container mt-5 border border-dark" id="RowsColumns">







    </div>







    <div class="col-12 mt-2 row">
        <button id="btncancel" type="button" value="Cancel" class="btn btn-danger col-6 "><span class="fas fa-window-close "></span>Cancel</button>
        <button id="btnsubmit" type="button" value="Submit" class="btn btn-primary col-6 "><i class="fas fa-check "></i>Submit</button>
    </div>
</form>

</div>

<div class="container " id="selectingmenu">


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
                                        <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
                                    </div>
                                    <input  id="NameOfItem" type="text"  class="form-control" placeholder="Name of item">
                                </div>
                            </div>

                            <div class="form-group row" id="DisplayNameOfItemType">
                                <lable for="describe" class="col-form-label">Items Type :</lable>
                                <div class="input-group mb-3 input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                                    </div>
                                    <select id="NameOfItemType" class="form-control">
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="NewItemTypeAdd">
                                <lable for="describe" class="col-form-label">Other item type:New Row</lable>
                                <div class="input-group mb-3 input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                                    </div>
                                    <input  id="itemChoice" type="text" class="form-control" placeholder="Name of Item Type">
                                </div>
                            </div>



                            <div class="form-group row" id="IncludeItem">
                                <lable for="describe" class="col-form-label">Include item in this packagse or extra charges</lable>
                                <div class="input-group mb-3 input-group-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-money-bill-alt"></i> </span>
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
                                        <span class="input-group-text"><i class="far fa-money-bill-alt"></i> </span>
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
                                <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
                            </div>
                            <input  id="NameOfItemExtra" type="text"  class="form-control" placeholder="Name of item">
                        </div>
                    </div>

                    <div class="form-group row" id="NewItemTypeAdd">
                        <lable for="describe" class="col-form-label">Other item type:New Row</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-list-ol" aria-hidden="true"></i></span>
                            </div>
                            <input  readonly id="itemChoiceExtra" type="text" class="form-control" placeholder="Name of Item Type">
                        </div>
                    </div>



                    <div class="form-group row" id="IncludeItemExtra">
                        <lable for="describe" class="col-form-label">Include item in this packagse or extra charges</lable>
                        <div class="input-group mb-3 input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-money-bill-alt"></i> </span>
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
                                <span class="input-group-text"><i class="far fa-money-bill-alt"></i> </span>
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

<script type="text/javascript">
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

    $("#IncludeItemOption").change(function () {

        ExtraItemControl("IncludeItemOption","ExtrachargeOfitem");
    });

    $("#IncludeItemOptionExtra").change(function () {
        ExtraItemControl("IncludeItemOptionExtra","ExtrachargeOfitemExtra");
    });


    var RowNumber=0;
    var ColumnNumber=0;
    var VarItemsType = {
        itemtypeNumber: 1,
        itemtype: "Other",
    };
    var arrayOfItemType= [];
    arrayOfItemType.push(VarItemsType);
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
        if(validationWithString("NameOfItem","Please Enter Name of item"))
            return false;
        if(ExtraItemType==="includeItem")
        {
            valueOfExtraCharge=0;
        }
        else
        {
            if(validationWithString("ExtrachargeOfitemAmount","Please Enter amount of item"))
                return false;
        }
        var TypeString="";

        if(TypeOfItem==="Other")
        {
            //other type user select
            TypeString=$("#itemChoice").val();

            if(validationWithString("itemChoice","Please Enter type of item"))
                return false;

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
            if(validationWithString("NameOfItemType","Please Enter Type of item"))
                return false;
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
         if(validationWithString("NameOfItemExtra","Please Enter Name of item"))
             return false;
                 if(ExtraItemType==="includeItem")
                 {
                     valueOfExtraCharge=0;
                 }
                 else
                 {
                     if(validationWithString("ExtrachargeOfitemAmountExtra","Please Enter amount of item"))
                         return false;
                 }
            var text=GetColumn(NameOfItemExtra,itemChoiceExtra,rowExtraNumber,ColumnNumber,valueOfExtraCharge)
            $("#RowNumber-"+rowExtraNumber).append(text);
            ColumnNumber++;
         $('#exampleModalCenter').modal("hide");
         $("#ExtrachargeOfitemAmount").val('');
     });

    $("#btncancel").click(function () {
        window.history.back();
    });
   $("#btnsubmit").click(function ()
   {


       var state=false;

       if(NumberRange("MinimumGuest","Pleas enter Minimum Guest (1 to 3000) ",1,3000))
       {
           state=true;
       }
       if(validationWithString("selectedValues","Please Enter Dates of packages"))
       {
           state=true;
       }
       if(validationWithString("packagename","Please Enter Name of packages"))
       {
           state=true;
       }
       if(validationWithString("rate","Please Enter Rate of packages"))
       {
           state=true;
       }
       if(state)
       {
           return false;
       }

       if (!confirm('Are you sure you want to Add Package in halls?'))
           return  false;

       var formdata=new FormData($('#submitpackage')[0]);
       formdata.append("option","CreatePackage");
       formdata.append("selectedDates",selectedDates);
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










$(document).ready(function () {

    $("#month").change(function () {
            if(($.trim($("#year").val())!=""))
            {
                $("#calendarBody").show();
            }
    });

    $("#year").change(function () {
        if(($.trim($("#month").val())!=""))
        {
            $("#calendarBody").show();
        }
    });

    function checkmonthyear()
    {
        validationWithString("month","Please select month");
        validationWithString("year","Please select year");
        if(($.trim($("#month").val())=="")||($.trim($("#year").val())==""))
        {
            $("#calendarBody").hide();
        }
        else
        {
            $("#calendarBody").show();
        }
    }

    $("#next").click(function ()
    {

        checkmonthyear();

    });
    $("#previous").click(function ()
    {
        checkmonthyear();
    });




});


});


</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>