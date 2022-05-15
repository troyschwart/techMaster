<?php
	include('../includes/connection.php');
	  $account_query = htmlentities($_POST['account_query']);
    $account_name=htmlentities($_POST['account_name']);
    $query_mes=nl2br(htmlentities($_POST['query_mes']));
    $email=$_SESSION['login'];
    $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    $check=mysqli_fetch_array($retval1);
    $uid=$check[0];
    //$retval=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
    if($account_query=='choose'){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please select account type!</span>
        </div>";
    }
    else if($account_name==''){
      $div="<div class='alert text-center alert-warning col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please choose the staff name!</span>
        </div>";
    }
    else if($query_mes==""){
      $div="<div class='alert text-center alert-danger col-lg-12 col-lg-push-0'>
         <span class='fa fa-exclamation-triangle'> Please type the query </span>
        </div>";
    }
    else {
        $sqls = "INSERT INTO tbl_query (id,query_mess,postDate,sender) VALUES ('$account_name','$query_mes',now(),'$uid')" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
            swal('Query sent successfully','','success')
            $('#query_staff').modal('hide');
        </script>";
        }
        else{
          $div="<script>
            swal('Error sending query','Try again !!!','warning')
        </script>";
        }
      }
	echo @$div;
?>