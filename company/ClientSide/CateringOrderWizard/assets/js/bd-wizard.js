//Wizard Init

$("#wizard").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "none",
    titleTemplate: '#title#',
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {

            return true;
        }
        if (newIndex === 0 )
        {
            if(CheckSecondStep())
            {
                return  true;
            }
            else
            {
                return false;
            }

        }

        if (currentIndex < newIndex)
        {
            return true;
        }

    },
    onFinished: function (event, currentIndex)
    {

        if(CheckFirstStep())
        {
            SubmitFormComplete();
            return  true;
        }
        else
        {
            return false;
        }

    }
});

//Form control

function CheckFirstStep()
{
    if(validationWithString("CustomerName","Please Enter Your Name"))
         return false;
    if(validatePakistaniNumberByString("Phoneno"))
        return  false;
    var CustomerName=$("#CustomerName").val();
    var Phoneno=$("#Phoneno").val();
 /*   var CNICNumber=$("#CNICNumber").val();
    var customerAddress=$("#customerAddress").val();*/
    var login= $("#isdownuserValid").val();
    if(login==="No")
    {
        alert("Please Enter and check Login Detail");
        return  false;
    }

return  true;
}

function CheckSecondStep()
{

    if(validationWithString("Book_Date","Please Enter Booking Date"))
    {
        return false;
    }
    if(validationWithString("Book_Time","Please Enter Booking Time"))
    {
        return false;
    }
    if(validationWithString("BookingAddress","Please Enter Booking Address"))
    {
        return false;
    }
    if(validationWithString("numberOfGuest","Please Enter Guests"))
    {
        return false;
    }
    return true;

}

function SubmitFormComplete()
{
    var formdata = new FormData($('#SubmitFormOfPackage')[0]);
    formdata.append("option","CompleteCateringFormSubmitByClient");
    $.ajax(
        {
        url: "CateringOrderServer.php",
        method: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        async:false,
        beforeSend: function ()
        {
            $('#pleaseWaitDialog').modal();
        },
        success: function (data)
        {
            $('#pleaseWaitDialog').modal('hide');
            if($.trim(data)!="")
            {
                alert(data);
            }
            else
            {
                alert("Your order is in Draft please call to owner for Activation this order .Your order is added in Order Cart");
            }
            $("#OrderDetailHistory").load(window.location.href + " #OrderDetailHistory" );
            $("#ShowRefreshHeader").load(window.location.href + " #ShowRefreshHeader" );
            $("#SubmitFormOfPackage").hide();
            $("#BookingAvailablebtn").hide();
        }

    });



}