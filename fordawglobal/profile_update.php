<?php
include('../includes/connection.php');
@$userID = htmlentities($_POST['userID']);
@$uid = htmlentities($_POST['userID']);
@$fName = htmlentities(ucwords($_POST['input_first']));
@$lName = htmlentities(ucwords($_POST['input_last']));
@$username = htmlentities(ucwords($_POST['input_username']));
@$phone = htmlentities($_POST['input_phone']);
@$input_city = htmlentities($_POST['input_city']);
@$input_country = htmlentities($_POST['input_country']);
@$input_address = htmlentities(ucwords($_POST['input_address']));
@$about_me = htmlentities($_POST['about_me']);
@$filename=$_FILES['imagefile']['name'];
@$fullname=$fName." ".$lName;

$location="../photo/".uniqid().$filename;
$uploadOk=1;
$imageFileType=pathinfo($location,PATHINFO_EXTENSION);
$valid_extensions=array('jpg','jpeg','png');

if(!in_array(strtolower($imageFileType), $valid_extensions)){
    $uploadOk=0;
}
if($userID=='' | $fName==''| $lName==''| $username==''| $phone==''| strlen($phone)<11| $input_city=='' | $input_country=='' | $input_address=='' | $about_me==''){
    $div=" <script>
        swal('Please make sure that all fields are field correctly!','','error')
    </script>
    ";
}
else{
    $result=mysqli_query($link,"SELECT * FROM tbl_contact WHERE uid='$userID'");
    if(mysqli_num_rows($result)==1){
        if($filename==null | empty($filename)){
            $location="../photo/user.png";
                $ref_update=mysqli_query($link,"UPDATE tbl_register SET fname='$fName',lname='$lName',username='$username',phone='$phone' WHERE ID='$userID'");
                $ref_contact=mysqli_query($link,"UPDATE tbl_contact SET address='$input_address',city='$input_city',country='$input_country',aboutme='$about_me',postDate=now(),update_pro='yes' WHERE uid='$userID'");
                $div=" <script>
                    swal('Profile update made successfully','','success')
                    setTimeout(function(){
                        window.location='profile?my profile=<?=$rand1;?>'
                    },3000);
                </script>
                ";
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A profile update was made on $date by";
                //$message=" A profile update has been made by $fullname on $dates";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);
        }
        else{
            if($uploadOk==0){
                $div=" <script>
                    swal('Image format not supported','file should be in the format: jpg, jpeg or png','error')
                </script>";
            }
            else{
                $ref_update=mysqli_query($link,"UPDATE tbl_register SET fname='$fName',lname='$lName',username='$username',phone='$phone',photo='$location' WHERE ID='$userID'");
                $ref_contact=mysqli_query($link,"UPDATE tbl_contact SET address='$input_address',city='$input_city',country='$input_country',aboutme='$about_me',postDate=now(),update_pro='yes' WHERE uid='$userID'");
                $div=" <script>
                    swal('Profile update made successfully','','success')
                    setTimeout(function(){
                        window.location='profile?my profile=<?=$rand1;?>'
                    },3000);
                </script>
                ";
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A profile update was made on $date by";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);

                move_uploaded_file($_FILES['imagefile']['tmp_name'],$location);

            }
        }
        
    }//END MAIN IF
    else{
        if($filename==null | empty($filename)){
            $location="../photo/user.png";
            $ref_update=mysqli_query($link,"UPDATE tbl_register SET fname='$fName',lname='$lName',username='$username',phone='$phone' WHERE ID='$userID'");
                $sqls = "INSERT INTO tbl_contact (uid,address,city,country,aboutme,postDate) VALUES ('$userID','$input_address','$input_city','$input_country','$about_me',now())" ;
                $outs = mysqli_query($link,$sqls);

                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A profile update was made on $date by";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);

                if($outs){
                    $error_msg="New Account Updated Successfully!";
                        
                    $div="<div class='alert text-center alert-info alert-dismissible col-lg-12 col-lg-push-0'>
                            <button type=button class=close data-dismiss=alert><span>&times;</span></button>
                             $error_msg
                            </div>
                            <script>
                                swal('New Account Updated Successfully!','','success')
                                setTimeout(function(){
                                    window.location='profile?my profile=<?=$rand1;?>'
                                },3000);
                            </script>
                            ";
                           // move_uploaded_file($_FILES['imagefile']['tmp_name'],$location);

                }
        }
        else{
            if($uploadOk==0){
                $div=" <script>
                    swal('Image format not supported','file should be in the format: jpg, jpeg or png','error')
                </script>";
            }
            else{
                $ref_update=mysqli_query($link,"UPDATE tbl_register SET fname='$fName',lname='$lName',username='$username',phone='$phone',photo='$location' WHERE ID='$userID'");
                $sqls = "INSERT INTO tbl_contact (uid,address,city,country,aboutme,postDate,update_pro) VALUES ('$userID','$input_address','$input_city','$input_country','$about_me',now(),'yes')" ;
                $outs = mysqli_query($link,$sqls);

                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A profile update was made on $date by";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);

                if($outs){
                    $error_msg="New Account Updated Successfully!";
                        
                    $div="<div class='alert text-center alert-info alert-dismissible col-lg-12 col-lg-push-0'>
                            <button type=button class=close data-dismiss=alert><span>&times;</span></button>
                             $error_msg
                            </div>
                            <script>
                                swal('New Account Updated Successfully!','','success')
                                setTimeout(function(){
                                    window.location='profile?my profile=<?=$rand1;?>'
                                },3000);
                            </script>
                            ";
                            move_uploaded_file($_FILES['imagefile']['tmp_name'],$location);

                }
             }
        }
    }
}
echo @$div;
?>