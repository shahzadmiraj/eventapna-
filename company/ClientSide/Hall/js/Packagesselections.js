$('document').ready(function () {

    var Extraitemcounter=0;



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
    }
    $('.AddRowOfTable').unbind().click(funAddExtraitemIncard);




    $(document).on('click', '.deleteRowOfTable',function(e) {
        // function body
        e.stopImmediatePropagation();
        var deleteRowOfTablerowid=$(this).data('rowoftable');
        $("#rowoftable"+deleteRowOfTablerowid).remove();
        CompleteCalculation();
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
    }
    $("#numberOfGuest").change(CompleteCalculation);
    $('input[type=radio]').change(function() {
        CompleteCalculation();
    });
});

