<?php
define('header', TRUE);
include 'header.php'; 
$continue=$continue_btn=false;
//PASSWWORD RESET
  if(isset($_POST['btn_reset'])){
    $email=htmlentities($_POST['email']);
    $retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    if($email==''){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> You have not provided us with an email</span>
        </div>";
    }
     else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> The email you entered is not a valid email</span>
        </div>";
    }
    else if(mysqli_num_rows($retval)==1){
      $retvals=mysqli_query($link,"SELECT * FROM tbl_otp WHERE email='$email' AND status!='expired'");
      if(mysqli_num_rows($retvals)==1){
        $ref_update=mysqli_query($link,"UPDATE tbl_otp SET status='expired' WHERE email='$email'");
        $to="$email";
        $from="fordawglobal.com";
        $subject = "Password reset security code";
        $message = "Fordawglobal Logisitic Company \n\n This is your security code: $rand. \n it will expire within 5 minutes if not used, please, if you didnot initiate this message please ignore all form of clicking on the link.\n\n https:whiztechweb.000webhostapp.com/fordawglobal/forget?reset=$rand2&ed&token=$rand1 \n\n Best Regards,\n\n\n Office hr team, \n Clifford Apagu";
        $headers="From: $from \r\n";
        $headers .="Reply-To: $to \r\n";
        mail($to,$subject,$message,$headers);

        $time=time();
        $_SESSION['last_time']=time();
        $sql1 = "INSERT INTO tbl_otp (email,otp,time_sent) VALUES ('$email','$rand','$time')";
        $out1 = mysqli_query($link,$sql1);
        $_SESSION['secure_mail']=$_POST['email'];
        $_SESSION['otp']="$rand";
        $continue=true;
        $div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
             <p style='font-size:1rem;font-weight:900;'><span class='fa fa-check-circle'></span> Please a security code has been sent to the email you provided.Kindly check your inbox or spam folder.
             Please the OTP expires within 5 minutes, if not used</p>.
            </div><script>
                    setTimeout(function(){
                        window.location='forget?reset=$rand1&ed&$rand2'
                    },10000);
                </script>";
      }
      else{
        $to="$email";
        $from="fordawglobal.com";
        $subject = "Password reset security code";
        //$message =  $from  . "\n\n" . 
        $message = "Fordawglobal Logisitic Company \n\n This is your security code: $rand. \n it will expire within 5 minutes if not used, please, if you didnot initiate this message please ignore all form of clicking on the link.\n\n https:whiztechweb.000webhostapp.com/fordawglobal/forget?reset=$rand2&ed&token=$rand1 \n\n Best Regards,\n\n\n Office hr team \n Clifford Apagu";
        $headers="From: $from \r\n";
        $headers .="Reply-To: $to \r\n";
        mail($to,$subject,$message,$headers);

        $time=time();
        $_SESSION['last_time']=time();
        $sql1 = "INSERT INTO tbl_otp (email,otp,time_sent,status) VALUES ('$email','$rand','$time','')";
        $out1 = mysqli_query($link,$sql1);
        $_SESSION['secure_mail']=$_POST['email'];
        $_SESSION['otp']="$rand";
        $continue=true;
        $div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
             <p style='font-size:1rem;font-weight:900;'><span class='fa fa-check-circle'></span> Please a security code has been sent to the email you provided.Kindly check your inbox or spam folder.
             Please the OTP expires within 5 minutes, if not used.</p>
            </div><script>
                    setTimeout(function(){
                        window.location='forget?reset=$rand1&ed&$rand2'
                    },10000);
                </script>";
        }
    }
    else{
      $div="<script>
                    swal('No account matched the email you provided','','warning')
                    setTimeout(function(){
                        window.location='forget?reset=$rand1'
                    },3000);
                </script>";
    }
  }
  //CHECKING OTP
   if(isset($_POST['btn_confirm'])){
      $email=$_SESSION['secure_mail'];
      $otp=htmlentities($_POST['otp']);
      //AUTO EXPIRE OTP
      if(isset($_SESSION['secure_mail'])){
          if((time()-$_SESSION['last_time'])>300) //600=10*60 10 seconds checker)
          { 
            $ref_update=mysqli_query($link,"UPDATE tbl_otp SET status='expired' WHERE email='$email'");
            $div="<div class='alert text-center alert-danger alert-dismissible col-lg-12 col-lg-push-0'>
                        <button type=button class=close data-dismiss=alert><span>&times;</span></button>
                       <span class='fa fa-exclamation-triangle'></span> You entered an expired OTP! Try again by resending.
                      </div><script>
                              setTimeout(function(){
                                  window.location='forget?reset=$rand1&$rand2'
                              },5000);
                          </script>";
          }
          else{
                $retval=mysqli_query($link,"SELECT * FROM tbl_otp WHERE email='$email' AND otp='$otp' AND status!='expired'");
                $continue=true;
                if(mysqli_num_rows($retval)>0){
                  $div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
                        <button type=button class=close data-dismiss=alert><span>&times;</span></button>
                       <span class='fa fa-check-circle'></span> security code confirmed successfully !!! you will be redirected within <b>3 second</b> to a page to change your password.
                      </div><script>
                              setTimeout(function(){
                                  window.location='forget?reset=$rand1&change&$rand2'
                              },3000);
                          </script>";
                }
                else{
                  $div="<script>
                    swal('Please check your email for the security code or go back and resend email','','warning')
                    setTimeout(function(){
                        window.location.href='forget?reset=$rand1&ed&fail'
                    },3000)
                  </script>";
                }
          }
     }
   }
   if(isset($_GET['reset'])& !isset($_GET['change'])){
      $tittle="<h1 class='text-white'>Password Reset Form</h1>
              <p class='text-lead text-white'>Please provide us with your registered email below.</p>";
   }
   else{
      $tittle="<h1 class='text-white'>Password Changed Form</h1>
              <p class='text-lead text-white'>Please choose a new password different from your previous password</p>";
   }
   //CHANGE PASSWORD 
   if(isset($_POST['btn_change'])){
      $email=$_SESSION['secure_mail'];
      $password = htmlentities($_POST['password']);
      $Cpassword = htmlentities($_POST['c_password1']);
      $retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
      $getRetval=mysqli_fetch_array($retval);
      $id=$getRetval[0];
      if($password==''| strlen($password)<4 | $Cpassword==''| strlen($password)<4){
        $div=" <script>
            swal('Please enter a password and password should not be less than 4 characters!','','error')
        </script>
        ";
      }
      else if($password!==$Cpassword){
          $div=" <script>
              swal('Password do not match, Try again!','','error')
          </script>
          ";
      }
      else{
        //PASSWORD SECURE HASHING
        $password=password_hash($password, PASSWORD_DEFAULT,['cost=>20']);
        $ref_update=mysqli_query($link,"UPDATE tbl_register SET password='$password' WHERE id='$id'");
        $div="<script>
                    swal('Password reset was successful!','','success')
                    setTimeout(function(){
                  window.location.href='login?sid=$rand1&'
                  },3000)
                </script>
                ";
                if($ref_update){
                   $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                    $message=" Your password was reset on $date by ";
                    $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$id','$message',now())" ;
                    $out1 = mysqli_query($link,$sql1);
                }
      }
   }
?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-info py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-4">
          <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-8 col-md-8 px-5">
              <?=$tittle; ?>
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
    <div class="container mt--9">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-body px-lg-5 py-lg-5">
              <?php echo @$div; ?>
              <form role="form" method="POST" action="" name="form1">
                <!-- EMAIL -->
                <div class="row" <?php if(isset($_GET['ed'])|isset($_GET['change'])){ echo "style='display:none'";}else{echo "style='display:flex'";} ?>>
                    <div class="col-md-9 form-group" <?php if($continue==true){ echo "style='display:none'";}?>>
                        <div class="input-group input-group-merge input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                          </div>
                          <input class="form-control" placeholder="Email" id="email" type="email" name="email">
                        </div>
                      </div>
                      <div class="col-md-3" <?php if($continue==true){ echo "style='display:none'";}?>>
                          <button type="submit" class="btn btn-info" id="btn_reset" name="btn_reset">Send</button>
                      </div>
                
                </div>
              </form>
              <form role="form" method="POST" action="" name="form2">
                <div class="row" <?php if(isset($_GET['ed'])){ echo "style='display:flex'";}else{echo "style='display:none'";} ?>>
                  <div class="col-md-7 form-group" <?php if($continue==true){ echo "style='display:none'";}?>>
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                      </div>
                      <input class="form-control" placeholder="Enter the OTP sent" id="otp" type="otp" name="otp">
                    </div>
                  </div>
                  <div class="col-md-5" <?php if($continue==true){ echo "style='display:none'";}?>>
                      <button type="submit" class="btn btn-danger" id="btn_confirm" name="btn_confirm">Confirm OTP</button>
                  </div>
                </div>
              </form>
              <form role="form" method="POST" action="" name="form3">
                <!-- PASSWORD RESET -->
                <div class="row" <?php if(isset($_GET['change'])){ echo "style='display:block'";}else{echo "style='display:none'";} ?>>
                  <!-- PASSWORD -->
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                      </div>
                      <input class="form-control" placeholder="Password" id="password" type="password" name="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                      </div>
                      <input class="form-control" placeholder="Confirm Password" id="c_password1" type="password" name="c_password1">
                    </div>
                  </div>
                  <div class="col-md-6">
                      <button type="submit" class="btn btn-success" id="btn_change" name="btn_change">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="login?sid=?<?=$rand1; ?>" class="text-light"><small>Login</small></a>
            </div>
            <div class="col-6 text-right" id="createAccount">
              <a href="enquiry?qst=<?=$rand1; ?>" class="text-light"><small>Send us enquiry</small></a>
            </div>
            <input type="hidden" name="uuil" id="uuil" value="login">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div style="height:10px;">&nbsp;</div> -->
<?php include 'footer.php'; ?>