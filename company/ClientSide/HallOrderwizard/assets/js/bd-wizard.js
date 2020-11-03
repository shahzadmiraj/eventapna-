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
        if (newIndex === 1 )
        {
            if(CheckFirstStep())
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
        if(CheckSecondStep())
        {

            SubmitFormComplete();
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
    var Remaingseating=Number($("#Remaingseating").val());
    var numberOfGuest=Number($("#numberOfGuest").val());
    if(Remaingseating<numberOfGuest)
    {
        alert("Over Guest is not Allow");
        return false;
    }
    return true;

}

function SubmitFormComplete() {
    var formdata = new FormData($('#SubmitFormOfPackage')[0]);
    formdata.append("option","CompleteFormSubmitByClient");
    $.ajax({
        url: "serverClientside.php",
        method: "POST",
        data: formdata,
        contentType: false,
        processData: false,
        async:false,
        beforeSend: function () {
            $('#pleaseWaitDialog').modal();
        },
        success: function (data)
        {
            $('#pleaseWaitDialog').modal('hide');
            alert(data);
        }
    });

}