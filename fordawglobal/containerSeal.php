<?php
include('../includes/connection.php');
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];

$idcon = htmlentities($_POST['idNum']);
$conNum = htmlentities($_POST['conNum']);
$sealNum = htmlentities($_POST['sealNum']);
$ref_update=mysqli_query($link,"UPDATE container_seal SET container='$conNum',seal='$sealNum' WHERE csid='$idcon'");
    $div="
          <script>
              swal('Container number and seal number updated successfully!','','success')
          </script>
          ";
    if($ref_update){
        $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
        $message=" A container and seal number was update on $date by ";
        $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
        $out1 = mysqli_query($link,$sql1);
    }
echo $div;
?>