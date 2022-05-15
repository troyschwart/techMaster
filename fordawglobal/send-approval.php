<?php
	include('../includes/connection.php');


	  $account_approval = htmlentities($_POST['account_approval']);
    $appro_msg=nl2br(htmlentities($_POST['appro_msg']));
    $email=$_SESSION['login'];
    $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    $check=mysqli_fetch_array($retval1);
    $uid=$check[0];
    //$retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    if($account_approval=='choose'){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please select account type!</span>
        </div>";
    }
    else if($appro_msg==""){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please type the query </span>
        </div>";
    }
    else {
        $sqls = "INSERT INTO tbl_approval (accType,message,sender,postDate) VALUES ('$account_approval','$appro_msg','$uid',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
            swal('Approval request sent successfully','wait for feedback','success')
            $('#approve').modal('hide');
            setTimeout(function(){
                window.location.href='view-app?$rand1&$rand%'
              },3000)
        </script>";
        }
        else{
          $div="<script>
            swal('Error sending approval request','Try again !!!','warning')
        </script>";
        }
      }
	echo @$div;
?>