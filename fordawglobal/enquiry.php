<?php
define('header', TRUE);
include 'header.php'; 
$continue=$continue_btn=false;

   if(isset($_POST['btn_enquiry'])){
    $fname = htmlentities($_POST['fname']);
    $email=htmlentities($_POST['email']);
    $subject=htmlentities($_POST['subject']);
    $message=nl2br(htmlentities($_POST['message']));
    $retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email' AND username='$fname'");
    if($fname==''){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please enter your full name!</span>
        </div>";
    }
    else if($email==''){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please enter your email!</span>
        </div>";
    }
    else if($subject==''){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please enter the subject </span>
        </div>";
    }
    else if($message==''){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please type the message </span>
        </div>";
    }
    else if(!mysqli_num_rows($retval)==1){
        $div="<script>
            Swal.fire({
              title: 'You are not yet a registered staff!',
              text: 'make sure you enter your registered username and email correctly',
              icon: 'warning',
              confirmButtonColor:'#dc3545'
            })
            setTimeout(function(){
                window.location='enquiry?qst=$rand1'
            },5000);
        </script>";
    }
    else {
        $sqls = "INSERT INTO tbl_enquiry (fullname,email,subject,message,postDate) VALUES ('$fname','$email','$subject','$message',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
            swal('Complain sent successfully','we will get back to you via your email','success')
            setTimeout(function(){
                window.location='enquiry?qst=$rand1'
            },5000);
        </script>";
        }
        else{
          $div="<script>
            swal('Error sending enquiry','Try again !!!','warning')
            setTimeout(function(){
                window.location='enquiry?qst=$rand1'
            },2000);
        </script>";
        }
      }
  }

?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary  py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Welcome Guest!</h1>
              <p class="text-lead text-white">Please feel free to send the admin a complain</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <?php echo @$div; ?>
              
              <form role="form" method="POST" action="">
                <!--  USERNAME -->
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-pen-alt"></i></span>
                    </div>
                    <input class="form-control text-capitalize" type="text" placeholder="Enter Username" id="fname"  name="fname">
                  </div>
                </div>
                <!-- EMAIL -->
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-envelope-open-text"></i></span>
                    </div>
                    <input class="form-control" type="text" placeholder="Enter Email" id="email"  name="email">
                  </div>
                </div> 
                <!-- SUBJECT -->
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-book"></i></span>
                    </div>
                    <input class="form-control" type="text" placeholder="Enter Subject" id="subject"  name="subject">
                  </div>
                </div>
                <!-- MESSAGE -->
                <div class="form-group">
                  <textarea class="form-control" placeholder="Message" name="message" id="message" cols="10" rows="5" style="resize:none;white-space:pre-wrap;"></textarea>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-danger my-4" id="btn_enquiry" name="btn_enquiry">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="forget?reset=<?=$rand1; ?>" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right" id="createAccount">
              <a href="login?sid=<?=$rand1; ?>" class="text-light"><small>Login</small></a>
            </div>
            <input type="hidden" name="uuil" id="uuil" value="login">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- data-toggle="modal" data-target="#modal_prints" -->
<?php include 'footer.php'; ?>