<?php
	include('../includes/connection.php');

	@$account_query=htmlentities($_POST['account_query']);
		$result_check=mysqli_query($link,"SELECT * FROM tbl_register WHERE  accountType='$account_query'");
		$i=0;
		if(mysqli_num_rows($result_check)>=1){
			@$div="<option value=''> Choose Name</option>";
			while($row=mysqli_fetch_array($result_check)){
				$fl=$row[2]." ".$row[3];
				@$div.="<option value='$row[0]'>$fl</option>";
				$i++;
			}
		}
		/*else{
				@$div="<option value='choose'>No name staff</option>"
		}*/
	echo @$div;
?>