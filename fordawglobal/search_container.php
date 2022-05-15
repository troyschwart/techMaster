<?php
	include('../includes/connection.php');

	@$searchBL=htmlentities($_POST['searchBL']);

	if($searchBL!=null){
		$result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE blNo='$searchBL'");
    	//$resultVal=mysqli_fetch_array($result);
		if(mysqli_num_rows($result)==1){
			$row=mysqli_fetch_array($result);
			$vw=$row[0];
			$results=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$vw'");
		      $i=1;
		      $div="<div class='text-center text-uppercase mt-5'><h2>List of containers with BL Number</h2><h6 style='color:#888;'>Ford A.W Global (Nigeria Limited)</h6></div>";
		     while ($rowCon=mysqli_fetch_array($results)) {
		        @$div.="<div class='col-md-6 mt-3'><label class='form-control'><span class='text-danger'>Container No. $i:</span> <b>$rowCon[2]</b></label>
		        </div>";
		        $i++;
		     }
			/*$div="<script>
		          swal('$dive','Done','warning')
		      </script>";*/
		}
	}
	else{
		$div="<script>
          swal('Please enter a BL Number you want to search','Try Again','warning')
      </script>";
	}
	echo @$div;
?>