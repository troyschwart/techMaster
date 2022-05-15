<?php include 'menu_nav.php'; 
if(isset($_POST["btn_change"])){
   $userID = htmlentities($_POST['userID']);
   $password = htmlentities($_POST['password_c']);
   $Cpassword = htmlentities($_POST['con_pass']);
if(empty($password) | empty($Cpassword)){
    $div=" <script>
        swal('Please enter the passwords you want, Try again!','','error')
    </script>
    ";
}
else if(strlen($password)<4 | strlen($Cpassword)<4){
    $div=" <script>
        swal('Password should not be less than 4, Try again!','','error')
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
  $password=password_hash($password, PASSWORD_DEFAULT,['cost=>20']);
  $ref_update=mysqli_query($link,"UPDATE tbl_register SET password='$password' WHERE ID='$userID'");
  $div="<div class='alert text-center alert-success col-lg-12 col-lg-push-0'>
         <i class='fa fa-spinner fa-2x fa-spin'></i><br>Your password have been successfully Changed
        </div> <script>
        swal('Password Successfully Changed !','','success')
    </script>
    ";
}
}
?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <style type="text/css">
      .card-profile-image img{
            height:120px;
            width: 120px;
        }
    </style>
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Hello <?=$check[2]." ".$check[3]; ?></h2>
            <p class="text-white mt-0 mb-5">You are about to change your previous password. Please after changes is made, keep your login details secure.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/brand/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?=$check[10];?>" class="rounded-circle" id="user_photo">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <!--a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a-->
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  <?=$check[2]." ".$check[3]; ?><span class="font-weight-light">, <?=$check[5]; ?></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?=$check[6]; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?=$check[1]; ?> - Ford A.W Glogal Concept Ltd
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Head Office: 63 Ibrahim Taiwo Road, Kano
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Change Password Logins </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
              <form method="POST" id="pro_update" name="pro_update">
                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                <input type="hidden" id="userID" name="userID" class="form-control" placeholder="ID" value="<?=$check[0];?>">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="password_c">New Password</label>
                        <input type="password" id="password_c" name="password_c" class="form-control text-capitalize" placeholder="New Password">
                      </div>
                    </div>
                  </div><!-- END ROW 1 -->
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="con_pass">Confirm Password</label>
                        <input type="password" id="con_pass" name="con_pass" class="form-control text-capitalize" placeholder="Confirm Password">
                      </div>
                      <p id="message"></p>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <hr class="my-4" />
                <div class="col-12 text-right">
                  <button type="submit" id="btn_change" name="btn_change" class="btn btn-danger">Apply Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
  
</script>
<?php include 'footer2.php'; ?>