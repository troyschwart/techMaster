<?php
include('../includes/connection.php');
$input_bill = htmlentities($_POST['input_bill']);
$input_ship_name = htmlentities($_POST['input_ship_name']);
$input_discharge = htmlentities($_POST['input_discharge']);
$input_contry = htmlentities($_POST['input_contry']);
$input_fraction = htmlentities(strtoupper($_POST['input_fraction']));
$input_contype = htmlentities($_POST['input_contype']);
@$counts=count($_POST['input_container']);
@$input_container = $_POST['input_container'];
@$input_seal = $_POST['input_seal'];
$input_import = htmlentities($_POST['input_import']);
$input_adress = htmlentities($_POST['input_adress']);
$input_desc = htmlentities($_POST['input_desc']);
$input_weight = htmlentities($_POST['input_weight']);
//CHECKING FOR BL'S ADDED
$result=mysqli_query($link,"SELECT * FROM tbl_transire WHERE bol='$input_bill'");
$row=mysqli_fetch_array($result);
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];

 if($input_bill==''| $input_ship_name==''| $input_discharge=='' | $input_contry=='' | $input_fraction==''| $input_contype=='' | $input_import=='' | $input_adress=='' | $input_desc=='' | $input_weight==''  ){
    $div=" <script>
        swal('Please make sure that all fields are field correctly!','','error')
    </script>
    ";
}
else if(mysqli_num_rows($result)==1){
    $div=" <script>
        swal('That BL have been added already! Please remove it or edit it','','warning')
    </script>
    ";
}
else{
    $sqls = "INSERT INTO tbl_transire (bol,shiprotate,portofdischarge,coo,fracNo,toc,importName,address,dogs,weight,postDate) VALUES ('$input_bill','$input_ship_name','$input_discharge','$input_contry','$input_fraction','$input_contype','$input_import','$input_adress','$input_desc','$input_weight',now())" ;
    $outs = mysqli_query($link,$sqls);
        $lastids=mysqli_insert_id($link);
        if($counts>0){
          for($i=0;$i<$counts;$i++){
            if(trim($_POST["input_container"][$i])!=""){
              $result=mysqli_query($link,"INSERT INTO container_seal (tid,container,seal) VALUES ('$lastids','$input_container[$i]','$input_seal[$i]')");
            }
          }
        }

    if($outs){
        $div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
                <button type=button class=close data-dismiss=alert><span>&times;</span></button>
                 <span class='fa fa-check-circle'></span> New transire added successfully
                </div>
                <script>
                    swal('New transire added successfully!','','success')
                    $('#form_transire')[0].reset();
                </script>
                ";
        $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
        $message=" A transire was added on $date by ";
        //$message=" A profile update has been made by $fullname on $dates";
        $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
        $out1 = mysqli_query($link,$sql1);

    }
    else{
    $div=" <script>
            swal('Error Occurred while submitting details, Try again!','','warning')
        </script>
        ";
     }
  }
echo $div;
?>