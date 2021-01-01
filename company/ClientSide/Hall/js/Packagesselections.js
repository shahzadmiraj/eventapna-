$('document').ready(function () {

    var Extraitemcounter=0;


    function addSwal() {
        swal({
            html:true,
            title: "Add item",
            text: 'Item has been added',
            buttons: false,
            icon: "success",
            timer: 1500
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
    function funAddExtraitemIncard()
    {

        var notrealrowprice=$(this).data("notrealrowprice");
        var notrealrowtype=$(this).data("notrealrowtype");
        var notrealname=$(this).data("notrealname");
        var notrealrowimage=$(this).data("notrealrowimage");
        var notrealrowid=$(this).data("notrealrowid");
        var notrealrowQuantity=$('#TableNotReal'+notrealrowid).val();
        if(validationWithString("TableNotReal"+notrealrowid,"Please Enter Quantity of item"))
            return false;
        var totalEachPrice=Number(notrealrowQuantity)*Number(notrealrowprice);

        var text='';
        text+=' <tr id="rowoftable'+Extraitemcounter+'">\n' +
            '                    <th scope="row">'+notrealrowid+'</th>\n' +
            '                    <td><img src="'+notrealrowimage+'" style="width: 80px"></td>\n' +
            '                    <td>'+notrealname+'</td>\n' +
            '                    <td>'+notrealrowtype+'</td>\n' +
            '                    <td><lable>'+notrealrowprice+'</lable></td>\n' +
            '                    <td><input name="itemExtraId[]"  type="number" hidden value="'+notrealrowid+'">\n' +
            '                        <input data-totalprice="'+totalEachPrice+'"  readonly style="border: none"   name="itemQuantity[]" class="itemQuantity" type="number" value="'+notrealrowQuantity+'"></td>\n' +
            '                    <td><lable id="TotolAmountEachRow'+Extraitemcounter+'">'+totalEachPrice+'</lable></td>\n' +
            '                    <td><button data-rowoftable="'+Extraitemcounter+'"  class="btn btn-outline-danger deleteRowOfTable">X</button></td>\n' +
            '                </tr>';

        $("#TableOFBodyMenu").append(text);

        Extraitemcounter++;
        CompleteCalculation();
        addSwal();
    }
    $('.AddRowOfTable').unbind().click(funAddExtraitemIncard);

    $(document).on('click','#CoponCodeBtn',function (e)
    {
        e.preventDefault();
         var CoponCode=$("#CoponCode").val();
         var companyid=$("#companyid").val();
         var formData=new FormData;
        formData.append("CoponCode",CoponCode);
        formData.append("companyid",companyid);

        formData.append("option","CouponCodeValidation");
        $.ajax({
            url: 'couponcode/coponserver.php',
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data)
            {
                console.log(data);
                if(data!=="No")
                {
                    var dataNew= JSON.parse(data);

                    //PercentageORAmount 1
                    //Discount 2
                    console.log(dataNew[0]);
                    $("#CoponCodeReal").val(dataNew[0]);
                    $("#wizardCouponCodePercentageORAmount").val(dataNew[1]);
                    $("#CouponCodeDiscount").val(dataNew[2]);
                }
                else
                {
                    $("#CoponCodeReal").val("");
                    $("#wizardCouponCodePercentageORAmount").val(0);
                    $("#CouponCodeDiscount").val(0);
                }

                CompleteCalculation();

            }
        });
    });




    $(document).on('click', '.deleteRowOfTable',function(e) {
        // function body
        e.stopImmediatePropagation();
        var deleteRowOfTablerowid=$(this).data('rowoftable');
        $("#rowoftable"+deleteRowOfTablerowid).remove();
        CompleteCalculation();
        removeSWAL();
    });
    var DealItems = [];
    function TotalNumbersOfNameIninput()
    {

        $('input:radio').each(function() { // find unique names

            DealItems.push($(this).attr('name'));
        });


        DealItems= $.unique(DealItems);

    }
    TotalNumbersOfNameIninput();


    function CalculateDealItems() {
        var TotoalDealAmount=0;
        for(var x=0;x<DealItems.length;x++)
        {
            TotoalDealAmount+=Number($('input[name='+DealItems[x]+']:checked').val());
        }
        return TotoalDealAmount;
    }
    function CalculateExtraitemAddInTable()
    {
        var TotalExtraItem=0;
        $(".itemQuantity").each(function () {
            TotalExtraItem+=Number($(this).data('totalprice'));
        });
        // console.log(TotalExtraItem);
         return TotalExtraItem;
    }

    function CalculateDiscount(TotalAmount)
    {
       //var CoponCodeReal=$("#CoponCodeReal").val();
       var wizardCouponCodePercentageORAmount=$("#wizardCouponCodePercentageORAmount").val();
       var CouponCodeDiscount=$("#CouponCodeDiscount").val();
       var discount=0;
       if(wizardCouponCodePercentageORAmount==="Percentage")
       {
           discount=(TotalAmount*CouponCodeDiscount)/100;
       }
       else if(wizardCouponCodePercentageORAmount==="Amount")
       {
           discount=CouponCodeDiscount;
       }

        $("#wizardDiscountAmountPackage").val(discount);
    }

    function CompleteCalculation()
    {
        var TotalAmount=0;
        var TotoalDealAmount=0;
        var TotalExtraItem=0;
        var PackagePerheadRate=Number($("#PackagePerheadRate").val());
        var numberOfGuest=Number($("#numberOfGuest").val());


        TotoalDealAmount=CalculateDealItems();
        TotalExtraItem=CalculateExtraitemAddInTable();
        TotalAmount=(PackagePerheadRate+TotoalDealAmount)*numberOfGuest;

         TotalAmount+=TotalExtraItem;






        $("#wizardTotalAmountPackage").val(TotalAmount);
         $("#wizardAmountPackage").val(TotalAmount);

        CalculateDiscount(TotalAmount);
        var wizardDiscountAmountPackage=Number($("#wizardDiscountAmountPackage").val());
        TotalAmount-= wizardDiscountAmountPackage;
         $("#wizardRemiangAmountPackage").val(TotalAmount);
    }
    $("#numberOfGuest").change(CompleteCalculation);
    $('input[type=radio]').change(function() {
        CompleteCalculation();
    });
});

