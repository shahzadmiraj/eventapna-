
window.validateEmailByString= function (Element,ShowMessage)
{

    var state=true;
    Element=$("#"+Element);
   var  ismail=Element.val();

    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    if (pattern.test(ismail))
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        alert(ShowMessage);
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");
    }

    return state;
}


window.validatePakistaniNumberByString= function (Element)
{

    var state=true;
    Element=$("#"+Element);
    var  Isnumber=Element.val();

    var pattern = /^((\+92)|(092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/g;
    if (pattern.test(Isnumber))
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        alert("your number is invalid So, these are example 03231234567 | 0345-1234567 | +923211234567 | +92324-1234567 | +92-3331234567 | +92-333-1234567 | 0923331234567 | 092333-1234567 | 092-3331234567 | 092-333-1234567");
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");
    }

    return state;
}


window.password=function (Element,ShowMessage,Min,Max)
{
    var state=true;
    Element=$("#"+Element);
    if((Element.val().length>=Min)&&(Element.val().length<=Max))
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        alert(ShowMessage);
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");

    }
    return state;
}
window.matchesTwoIdBySting=function (Element1,Element2,ShowMessage)
{
    var state=true;
    Element1=$("#"+Element1);
    Element2=$("#"+Element2);
    if(Element1.val()==Element2.val())
    {
        if(Element1.hasClass("btn-danger"))
        {
            Element1.removeClass("btn-danger");
        }
        if(Element2.hasClass("btn-danger"))
        {
            Element2.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        if(!(Element1.hasClass("btn-danger")))
            Element1.addClass("btn-danger");
        if(!(Element2.hasClass("btn-danger")))
            Element2.addClass("btn-danger");
        alert(ShowMessage);
    }
    return state;
}
window.NumberRange=function (Element,ShowMessage,Min,Max)
{
    var state=true;
    Element=$("#"+Element);
    if((Element.val()>=Min)&&(Element.val()<=Max))
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        alert(ShowMessage);
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");

    }
    return state;
}


window.PhoneNumberCheck=function (Element)
{
    var state=true;
    Element=$("#"+Element);

    //var RegexPhone = /^[\+0][0-9]?()[0-9](\s|\S)(\d[0-9]{9})$/;

    var RegexPhone = /^[0-9]+$/;
    if(RegexPhone.test(Element.val()))
    {
        if (Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state = false;
    }
    else
    {
        alert("number must be format" +
            "\n+92 1213315000\n" +
            " +9231213315000\n" +
            "+1 2323214316\n" +
            "+9223432432432\n" +
            "0923213315000 ");
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");

    }
    return state;
}


window.validation= function (Element,ShowMessage)
{
    if($.trim(Element.val())=="")
    {
        alert(ShowMessage);
        Element.addClass("btn-danger");
        return true;
    }
    else
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }

    }
    return false;
}


    window.validationWithString=function (Element,ShowMessage)
    {
        Element=$("#"+Element);
        if($.trim(Element.val())=="")
        {
            alert(ShowMessage);
            Element.addClass("btn-danger");
            return true;
        }
        else
        {
            if(Element.hasClass("btn-danger"))
            {
                Element.removeClass("btn-danger");
            }

        }
        return false;
    }


  window.validationWithoutAlert= function(Element)
{
    if($.trim(Element.val())=="")
    {
        Element.addClass("btn-danger");
        return true;
    }
    else
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }

    }
    return false;
}


window.validationClass=function (Quantity,ShowMessage)
{
    var state=false;
    $( "."+Quantity ).each(function( index )
    {
        if(validationWithoutAlert($(this)))
        state=true;
    });

    if(state)
    {
        alert(ShowMessage);
    }

    return state;
}

window.NumberRange= function (Element,ShowMessage,Min,Max)
{
    var state=true;
    Element=$("#"+Element);
    if((Element.val()>=Min)&&(Element.val()<=Max))
    {
        if(Element.hasClass("btn-danger"))
        {
            Element.removeClass("btn-danger");
        }
        state=false;
    }
    else
    {
        alert(ShowMessage);
        if(!(Element.hasClass("btn-danger")))
            Element.addClass("btn-danger");

    }
    return state;
}

// function  AddSwalFunction() {
//     swal({
//         html:true,
//         title: "Add item",
//         text: 'Item has been added',
//         buttons: false,
//         icon: "success",
//         timer: 1500,
//     });
//
// }
//
// function  RemoveSwalFunction() {
//     swal({
//         title: "Deleted",
//         text: 'Item has been Deleted',
//         buttons: false,
//         icon: "error",
//         timer: 1500,
//         html: true
//     });
//
// }
