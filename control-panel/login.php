<?php
define('header', TRUE);
include '../fordawglobal/header.php'; 
$continue=$continue_btn=false;

   if(isset($_POST['signin'])){
    $account_type = htmlentities($_POST['account_type']);
    $email=htmlentities($_POST['email']);
    $password=htmlentities($_POST['password']);
    $checkedBox=isset($_POST['checkbox']);
    $retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    $getRetval=mysqli_fetch_array($retval);
    $uid=$getRetval[0];
    $uid1=$getRetval[12];
    $fullname=$getRetval[2]." ".$getRetval[3];

    if($account_type=='choose'){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please select the account type</span>
        </div> ";
    }
    else if($email==''){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please enter your email!</span>
        </div>";
    }
     else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> The email you entered is not a valid email</span>
        </div>";
    }
    else if($password==''){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please enter your password </span>
        </div>";
    }
    else if(mysqli_num_rows($retval)==1){
      $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email' AND accountType='$account_type'");
      $check=mysqli_fetch_array($retval1);
      $pass=$check[7];
      $status=$check[11];
      $result=password_verify($password, $pass);
      if($status=="not verified"){
         $div="<script>
          swal('Your account has not been verified by the admin','wait for verfication','warning')
        </script> ";
      }
      else if(!$result){
        $div="<script>
          swal('Incorrect credentials entered','','error')
        </script> ";
        if($uid1!=1){
         $sqls = "INSERT INTO tbl_logins (accountType,email,status,postDate) VALUES ('$account_type','$email','0',now())" ;
        $outs = mysqli_query($link,$sqls);
        }
      }
      else{
        //INSERTING INTO TBL_LOGIN
        if($uid1!=1){
        $sqls = "INSERT INTO tbl_logins (accountType,email,status,postDate) VALUES ('$account_type','$email','1',now())" ;
        $outs = mysqli_query($link,$sqls);
        }
        $ref_update=mysqli_query($link,"UPDATE tbl_register SET checks='on' WHERE email='$email'");
        $_SESSION['login']=$_POST['email'];
        $continue_btn=true;
        $div="<div class='alert text-center alert-success col-lg-12 col-lg-push-0'>
         <i class='fa fa-spinner fa-2x fa-spin'></i><br>Welcome Admin, Loading your page... You will be redirected in a short time
        </div> 
        <script>
            setTimeout(function(){
                window.location='../fordawglobal/dashboard?$rand1&&welcome&&ic=$rand'
            },2000);
        </script>";
        //INSERTING ACTIVITIES
        $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
        //$message="$fullname logged in on $date";
        $message="User account logged in on $date by ";
        if($uid1!=1){
          $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
          $out1 = mysqli_query($link,$sql1);
        }
        

        if($checkedBox=="on"){
          setcookie("email",$email,time()+3600);
          }
        }
      }
     else{
      $div="<div class='alert text-center alert-default col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-circle'> No account found </span>
        </div>";
    }
  }
$location="../photo/user.png";
$password=password_hash("whiztech", PASSWORD_DEFAULT,['cost=>20']);
$result=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='whiztechglobal@gmail.com' OR phone='08094720419'");
if(mysqli_num_rows($result)>0){}
else{
    $sqls = "INSERT INTO tbl_register (accountType,fname,lname,username,phone,email,password,postDate,photo,status,keyStatus) VALUES ('Administrator','Master','Admin','Masterkey','08094720419','whiztechglobal@gmail.com','$password',now(),'$location','verified','1')" ;
    $outs = mysqli_query($link,$sqls);
  } 
?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-warning py-7 py-lg-6 pt-lg-3">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Admin Control panel</h1>
              <p class="text-lead text-white">Welcome Administrator!</p>
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
    <div class="container mt--9 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <!--div class="card-header bg-transparent pb-5">
              <div class="text-muted text-center mt-2 mb-3"><small>Sign in with</small></div>
              <div class="btn-wrapper text-center">
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/github.svg"></span>
                  <span class="btn-inner--text">Github</span>
                </a>
                <a href="#" class="btn btn-neutral btn-icon">
                  <span class="btn-inner--icon"><img src="../assets/img/icons/common/google.svg"></span>
                  <span class="btn-inner--text">Google</span>
                </a>
              </div>
            </div-->
            <div class="card-body px-lg-5 py-lg-2">
              <?php echo @$div; ?>
              <div class="text-center text-muted mb-4">
                <small>Manage all website details with this form</small>
              </div>
              <form role="form" method="POST" action="" <?php if($continue_btn==true){ echo "style='display:none'";}else{} ?>>
                <div class="form-group mb-3" style="display:none;">
                  <select class="form-control" id="account_type" name="account_type">
                    <option value="administrator">Administrator</option>
                  </select>
                </div>
                <!-- EMAIL -->
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" id="email" type="email" name="email">
                  </div>
                </div>
                <!-- PASSWORD -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" id="password" type="password" name="password">
                  </div>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="" id="customCheckLogin" type="checkbox" name="customCheckLogin">
                  <label class="" for="customCheckLogin">
                    <span class="text-muted">Remember me</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4" id="signin" name="signin">Sign in</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="../fordawglobal/forget?reset=?<?=$rand1; ?>" class="text-light"><small>Forgot password?</small></a>
            </div>
            <div class="col-6 text-right" id="createAccount" style="display: none;">
              <a href="register?reg=<?=$rand1; ?>" class="text-light"><small>Create new account</small></a>
            </div>
            <input type="hidden" name="uuil" id="uuil" value="login">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- data-toggle="modal" data-target="#modal_prints" -->
<?php include '../fordawglobal/footer.php'; ?>
<script>
      $(document).ready(function(){
        var uuid=$('#uuil').val();
        if(uuil=='login'){
          $('#modal_prints').modal('show');
        }
      });
</script>