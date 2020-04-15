
function validation(Element,ShowMessage)
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



function validationWithString(Element,ShowMessage)
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

function validationWithoutAlert(Element)
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


function  validationClass(Quantity,ShowMessage)
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

function NumberRange(Element,ShowMessage,Min,Max)
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



