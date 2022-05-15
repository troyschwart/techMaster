<?php
	include('../includes/connection.php');
	$email=$_SESSION['login'];
	$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
	$check=mysqli_fetch_array($retval1);
	$uid=$check[0];

	@$counts=count($_POST['desc']);
	@$land_bl=htmlentities($_POST['land_bl']);
	@$land_size=htmlentities($_POST['land_size']);
	@$land_eta=htmlentities($_POST['land_eta']);
	@$conNo=htmlentities($_POST['conNo']);
	@$desc=$_POST['desc'];
	@$amount=$_POST['amount'];
	@$amount=str_replace(",","", $amount);

	if($land_bl==""){
 		 $div="<script>
 				swal('Please enter the BL Number!','', 'error');
	 		</script>";
		}
	else if($land_size==""){
 		 $div="<script>
 				swal('Please enter the size!','', 'error');
	 		</script>";
		}
	else if($land_eta==""){
		 $div="<script>
				swal('Please enter the E.T.A!','', 'error');
 		</script>";
	}
	else if($counts>=1){
		for($i=0;$i<$counts;$i++){
			if(trim($_POST["desc"][$i])!=""){
				$result=mysqli_query($link,"INSERT INTO tbl_costbl(bl,size,descrip,amount,postDate,eta,conNo) VALUES ('$land_bl','$land_size','$desc[$i]','$amount[$i]',now(),'$land_eta','$conNo')");
				$date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
		        $message=" A Lading cost of BL was added on $date by ";
		        $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
		        $out1 = mysqli_query($link,$sql1);

			}
		}
		if($result){
			 $div= "<script>
 				swal('Data Saved Successfully!!!','','success');
	 		</script>";
		}
	}
	else{
		 $div= "<script>
 				swal('Error Occurred in saving data!!!','','warning');
	 		</script>";
	}
	echo @$div;
?>