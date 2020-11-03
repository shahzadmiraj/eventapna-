
$(document).ready(function () {

    $("#checklogin").click(function () {
        var state=false;
        if(validationWithString("OldUsername","please enter username "))
            state=true;
        if(password("LoginPassword","please enter 4 to 15 letters password",4,15))
            state=true;
        if(state)
            return false;
        var UserName=$("#OldUsername").val();
        var password1=$("#LoginPassword").val();
        var formdata = new FormData();
        formdata.append("option", "login");
        formdata.append("UserName", UserName);
        formdata.append("password", password1);
        $.ajax({
            url: "../../../user/userServer.php",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#pleaseWaitDialog').modal();
            },
            success: function (data)
            {
                $('#pleaseWaitDialog').modal('hide');
                if(($.trim(data)==="back")||($.trim(data)==="companyUser"))
                {
                    $("#LoginDetailwrap").hide();
                    $("#isdownuserValid").val("Yes");
                }
                else
                {
                    alert(data);
                }
            }
        });
    });



    $('#NewUserRegisterbutton').click(function ()
    {
        var state=false;
        if(validateEmailByString("NewEmail","Please enter valid Email"))
            state=true;
        if(password("newpassword","please enter 4 to 15 letters password",4,8))
            state=true;

        if(validationWithString("Newusername","please enter username "))
            state=true;
        if($("#agree").prop("checked")==false)
        {
            alert("Please Accept Terms & Conditions");
            state=true;
        }
        if(state)
            return false;
        var NewEmail=$("#NewEmail").val();
        var newpassword=$("#newpassword").val();
        var Newusername=$("#Newusername").val();

        var formdata = new FormData();
        formdata.append("option","LocatUserRegisters");
        formdata.append("username",Newusername);
        formdata.append("Email",NewEmail);
        formdata.append("password",newpassword);
        $.ajax({
            url: "../../../user/userServer.php",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,

            beforeSend: function () {
                $('#pleaseWaitDialog').modal();
            },
            success: function (data)
            {
                $('#pleaseWaitDialog').modal('hide');
                alert(data);
                $("#formLogin")[0].reset();
            }
        });


    });


    $("#ForgotPasswordmodel").click(function () {

        if(validateEmailByString("PreviousEmail","Please enter valid Email"))
            return true;
        var PreviousEmail=$("#PreviousEmail").val();
        var formdata = new FormData();
        formdata.append("option","sendForgetpasswordOrUsername");
        formdata.append("PreviousEmail",PreviousEmail);
        $.ajax({
            url: "../../../user/userServer.php",
            method: "POST",
            data: formdata,
            contentType: false,
            processData: false,

            beforeSend: function () {
                $('#pleaseWaitDialog').modal();
            },
            success: function (data)
            {
                $('#pleaseWaitDialog').modal('hide');
                alert(data);

                $("#ForgotPasswordmodel")[0].reset();
            }
        });
    });

});