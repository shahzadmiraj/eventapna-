<!--<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BootstrapDash Wizard</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/bd-wizard.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body>-->
  <main class="my-5">
    <div class="container">
      <div id="wizard">
        <?php
        include_once('step2/Packageselections.php');
        include_once('Step3/Preview.php');
        include_once('Step1/PersonalDetail.php');
        ?>


       <!-- <h3>
          <div class="media">
            <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
            <div class="media-body">
              <div class="bd-wizard-step-title">Submit</div>
              <div class="bd-wizard-step-subtitle">Step 4</div>
            </div>
          </div>
        </h3>
        <section>
          <div class="content-wrapper">
            <h4 class="section-heading mb-5">Accept agreement and Submit</h4>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="" id="" value="checkedValue" checked>
                I hereby declare that I had read all the <a href="#">terms and conditions</a>  and all the details provided my me in this form are true.
              </label>
            </div>
          </div>  
        </section>-->



      </div>
    </div>
  </main>






<?php
include_once('Step1/NewUserRegisterModel.php');
include_once('Step1/ForgetPassword.php');
?>
  <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.steps.min.js"></script>
  <script src="assets/js/bd-wizard.js"></script>
</body>
</html>-->
