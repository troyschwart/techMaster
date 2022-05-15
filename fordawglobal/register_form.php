<?php
include('../includes/connection.php');

$account_type = htmlentities(ucwords($_POST['account_type']));
$fName = htmlentities(ucwords($_POST['fName']));
$lName = htmlentities(ucwords($_POST['lName']));
$username = htmlentities(ucwords($_POST['username']));
$phone = htmlentities($_POST['phone']);
$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$Cpassword = htmlentities($_POST['Cpassword']);
@$customCheckRegister = htmlentities($_POST['customCheckRegister']);
if(!(isset($customCheckRegister)))
{
    $div=" <script>
        swal('Please check and agree with the privacy policy before registration!','','warning')
    </script>
    ";
}
else if($account_type=='choose'| $fName==''| $lName==''| $username==''| $phone==''| strlen($phone)<11| !filter_var($email,FILTER_VALIDATE_EMAIL)| empty($email) | $password==''| strlen($password)<4){
    $div=" <script>
        swal('Please make sure that all fields are field correctly!','','error')
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
//$regs=substr($regNo,0,1);

//PASSWORD SECURE HASHING
$password=password_hash($password, PASSWORD_DEFAULT,['cost=>20']);
//PASSWORD VERIFYING
//$result=password_verify($user_password, $hash_password_db)
$result=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email' OR phone='$phone'");
if(mysqli_num_rows($result)>0){
    $div="<script>
        swal('The email or phone number you use is already used by another staff !','','error')
    </script>
                ";
}
else{
    $sqls = "INSERT INTO tbl_register (accountType,fname,lname,username,phone,email,password,postDate) VALUES ('$account_type','$fName','$lName','$username','$phone','$email','$password',now())" ;
    $outs = mysqli_query($link,$sqls);

    if($outs){
    		
        $div="<script>
                    swal('New Account Registered Successfully!','','success')
                    $('#regForm')[0].reset();
                </script>
                ";

    }
    else{
    $div=" <script>
            swal('Error Occurred while Registration, Try again!','','warning')
        </script>
        ";
     }
  }
}
echo $div;
?>