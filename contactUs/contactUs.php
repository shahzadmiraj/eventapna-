




<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">
            <form id="emailsendForm">
                <?php
                echo '<input hidden name="SenderAddress" value="'.$SenderAddressList.'" >'; //like for in loop $userids
                echo '<input hidden name="SenderName" value="'.$SenderNameList.'" >'; //like for in loop $userids
                echo '<input hidden  name="ExtraInformation" value="'.$ExtraInformation.'" >';
                ?>

                <div class="card border-warning rounded-0">
                    <div class="card-header p-0">
                        <div class="text-white text-center py-2" style="background-color: #ff328c;">
                            <h3><i class="fa fa-envelope"></i> Contact Form</h3>
                            <p class="m-0" id="error">HELP</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your Name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Sender Email Address" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                </div>
                                <textarea name="Message" id="Message" class="form-control" placeholder="Message " ></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <input id="submitEmail" type="button" value="Send" class="btn btn-warning btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>


<script>

    $(document).ready(function ()
    {

        $("#submitEmail").click(function ()
        {
            if(validationWithString("username","Please enter your Name"))
                return false;
            if(validateEmailByString("email","Please enter valid Email"))
                return false;
            if(validationWithString("Message","Please type your Message"))
                return false;
            var formdata=new FormData($("#emailsendForm")[0]);
            formdata.append("option","EmailSentbycontact");
            $.ajax({
                url:"<?php echo $urlContactus;?>",
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
                    if($.trim(data)=='')
                    {
                     $("#error").html("<span class='btn-success'>You have sent message </span>");
                        $('#emailsendForm').trigger("reset");

                    }
                    else
                    {
                        $("#error").html(data);
                    }

                }
            });



        });



    });
</script>
