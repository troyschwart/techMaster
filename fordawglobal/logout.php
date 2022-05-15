<?php
 include('../includes/connection.php');
$email=$_SESSION['login'];
@$list=$_SESSION['list'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
if($list=="Breverage"){
  $list="Breverage";
}
else{
  $list=$acctype;
}
$ref_update=mysqli_query($link,"UPDATE tbl_register SET checks='off' WHERE email='$email'");
session_start();
unset($_SESSION['login']);
session_destroy();
setcookie("email",'',time()-3600);
if($list=="Breverage"){
    header('Location:signin');
}
else if($list=="Administrator"){
    header('Location:../control-panel/login');
}
else{
    header('Location:../index.php');
}
?>
