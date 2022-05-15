<?php
/*define('b_head', TRUE);*/
include 'b_head.php'; 
$continue=$continue_btn=false;
$rand=rand(0,255);
$rand1=rand(0,255);
$rand2=rand(0,255);
$backg="style='background: rgba($rand,$rand1,$rand2,.5)';";



if(isset($_POST['log_btn'])){
	$account_type = htmlentities($_POST['account_type']);
    $userID=htmlentities($_POST['userID']);
    $passID=htmlentities($_POST['passID']);
    $retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE username='$userID'");
    $getRetval=mysqli_fetch_array($retval);
    $uid=$getRetval[0];
    $fullname=$getRetval[2]." ".$getRetval[3];

    if($userID==''){
        $div="<script>
          Swal.fire({
                icon:'error',
                title:'Please enter your username',
                showConfirmButton:false,
                timer:2500
              })
        </script>";
    }
    else if($passID==''){
      $div="<script>
      		swal('Please enter your password !','','error')
      </script>";
    }
    else if(mysqli_num_rows($retval)==1){
      $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE username='$userID' AND accountType='$account_type'");
      $check=mysqli_fetch_array($retval1);
      $email=$check[6];
      $pass=$check[7];
      $status=$check[11];
      $result=password_verify($passID, $pass);
      if($status=="not verified"){
         $div="<script>
          swal('Your account has not been verified by the admin','wait for verfication','warning')
        </script> ";
      }
      else if(!$result){
        $div="<script>
          Swal.fire({
                icon:'warning',
                title:'Incorrect credentials entered <span class=fa fa-times-circle text-danger></span>',
                showConfirmButton:false,
                timer:2500
              })
        </script> ";
         /*$sqls = "INSERT INTO tbl_logins (accountType,userID,status,postDate) VALUES ('$account_type','$userID','0',now())" ;
        $outs = mysqli_query($link,$sqls);*/
      }
      else{
        //INSERTING INTO TBL_LOGIN
        /*$sqls = "INSERT INTO tbl_logins (accountType,userID,status,postDate) VALUES ('$account_type','$userID','1',now())" ;
        $outs = mysqli_query($link,$sqls);*/
        $ref_update=mysqli_query($link,"UPDATE tbl_register SET checks='on' WHERE username='$userID'");
        $_SESSION['login']=$email;
        $_SESSION['list']="Breverage";
        $_SESSION['last_login']=time();
        $continue_btn=true;
        $spin="loading <i class='fa fa-spinner fa-spin'></i>";
        $div="
        <script>
        	let timerInterval
				Swal.fire({
				  title: 'Login Successfully ...!',
				  html: 'loading <b></b> milliseconds...',
				  timer: 2500,
				  timerProgressBar: true,
				  didOpen: () => {
				    Swal.showLoading()
				    const b = Swal.getHtmlContainer().querySelector('b')
				    timerInterval = setInterval(() => {
				      b.textContent = Swal.getTimerLeft()
				    }, 100)
				  },
				  willClose: () => {
				    clearInterval(timerInterval)
				  }
				}).then((result) => {
				  if (result.dismiss === Swal.DismissReason.timer) {
				    console.log('I was closed by the timer')
				  }
				})
            setTimeout(function(){
                window.location='dashboard?$rand1&&welcome&&ic=$rand'
            },2300);
        </script>";
        //INSERTING ACTIVITIES  
         
        $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
        $message="User account logged in on $date by ";
        $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
        $out1 = mysqli_query($link,$sql1);
        }
      }
     else{
      $div="<script>
          Swal.fire({
                icon:'error',
                title:'No Account Found',
                showConfirmButton:false,
                timer:2500
              })
        </script>";
    }
  }
?>


	<div class="col-4 text-center mt-2" style="width:960px;margin:0 auto;"><?=@$div;?></div>
<div <?php if($continue_btn==true){ echo "style='display:none'";}?>>
	<div class="loginbox" <?=$backg;?> >
		<img src="../assets/img/brand/l1.png" class="logo_pix">
		<h1>Breverage Platform</h1>
		<form method="POST" action="" id="form-log" name="form-log">
			<div class="form-group mb-3" style="display:none;">
	          <select class="form-control" id="account_type" name="account_type">
	            <option value="administrator">Administrator</option>
	          </select>
	        </div>
			<p>Username:</p>
			<input type="text" class="" name="userID" id="userID" placeholder="Enter Username">
			<p>Password:</p>
			<input type="password" class="" name="passID" id="passID" placeholder="Enter Password">
			<button type="submit" class="" name="log_btn" id="log_btn"><?php if($continue_btn==true){echo $spin;}else{echo 'Sign in';}?></button>
			<a href="forget?reset=<?=$rand1; ?>">Lost your password?</a>
		</form>
	</div>
</div>
<div id="b_footer" class="col-12">
   Copyright &copy; <?=date("Y");?> Whizkingpin Global Softwares Enterprise.<span class="fa fa-heart text-danger"></span> All rights reserved
 </div>
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/js.cookie.js"></script>
  <script src="../assets/js/jquery.scrollbar.min.js"></script>
  <script src="../assets/js/jquery-scrollLock.min.js"></script>
  <script src="../assets/js/wow.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
  <?php include '../includes/modals.php'; ?>
  <?php include '../includes/custom.php'; ?>
  </body>
  </html>