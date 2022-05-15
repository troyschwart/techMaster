<?php
			include('../includes/connection.php');
			@$outletName=strtoupper(htmlentities($_POST['outletName']));
			@$address=strtoupper(htmlentities($_POST['address']));
			@$phone=htmlentities($_POST['phone']);
			$result=mysqli_query($link,"SELECT * FROM tbl_outlet WHERE nameOutlet='$outletName'");
				if($outletName==""){
					$div= "<script>
			 				swal('Please enter the outlet','', 'error');
				 		</script>";
				}
				else if($address==""){
					$div= "<script>
			 				swal('Please enter the address','', 'error');
				 		</script>";
				}
				else if (mysqli_num_rows($result)==1) {
					@$div= "<script>
			 				swal('This outlet name has been added before!','', 'error');
				 		</script>";
				}
				else{
					$result=mysqli_query($link,"INSERT INTO tbl_outlet (nameOutlet,address,phone,postDate) VALUES('$outletName','$address','$phone',CURRENT_TIMESTAMP)");
					if($result){
					 @$div="<script>
			 				swal({
								  title: 'Outlet Name Added Successfully!',
								  icon: 'success',
								  button: 'Close!',
								});
								setTimeout(function(){
									window.location.href='add_outlet?vw=$rand1'
								},2000)
				 		</script>";
							;
					}
				}
				echo @$div;
				
?>