<?php
			include('../includes/connection.php');

				@$outlet=htmlentities($_POST['outlet']);
				@$invoiceNo=strtoupper(htmlentities($_POST['invoiceNo']));
				@$invoiceAmount=htmlentities($_POST['invoiceAmount']);
				@$dateInvoic=htmlentities($_POST['dateInvoice']);
				@$dateInvoice=date('Y-m-d',  strtotime($dateInvoic));
				@$dueDat=htmlentities($_POST['dueDate']);
				@$dueDate=date('Y-m-d',  strtotime($dueDat));
				@$payMode=htmlentities($_POST['payMode']);
				@$payType=htmlentities($_POST['payType']);
				@$amountPaid=htmlentities($_POST['amountPaid']);
				@$balance=htmlentities($_POST['balance']);
				@$postDate=date('Y-m-d',  strtotime($_POST['postDate']));
				
				if($outlet=="choose"){
			 		  @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please Select Outlet Name</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please select outlet', 'error');
				 		</script>";
			 			
			 	}
				else if(empty($invoiceNo)){
			 		  @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter invoice number</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter invoice number', 'error');
				 		</script>";
			 			
			 	}
			 	else if($invoiceAmount==""){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter invoice amount</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter invoice amount', 'error');
				 		</script>";
			 	}
			 	else if($dateInvoice=="1970-01-01"){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter date of invoice</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter date of invoice', 'error');
				 		</script>";
			 	}
			 	else if($dueDate=="1970-01-01"){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter invoice due date</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter invoice due date', 'error');
				 		</script>";
			 	}
			 	else if($payMode=="choose"){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter mode of payment</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter mode of payment', 'error');
				 		</script>";
			 	}
			 	else if($payType=="choose"){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter payment type</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter payment type', 'error');
				 		</script>";
			 	}
			 	else if($amountPaid==""){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter amount paid</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter amount paid', 'error');
				 		</script>";
			 	}
			 	else if($postDate=="1970-01-01"){
			 		 @$div="<div class='alert alert-danger text-center alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
		         			<i class='fa fa-times-circle'></i> <b>Please enter post Date</b>
			 			</div>
			 			<script>
			 				swal('Error!','Please enter post Date', 'error');
				 		</script>";
			 	}
				else{
					$result_bals=mysqli_query($link,"SELECT * FROM tbl_paymentinvoice WHERE invoiceNo='$invoiceNo'");
					if(mysqli_num_rows($result_bals)>=1){
					 	@$div="<div class='alert text-center alert-danger alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
							 Please you cannot perform that action again on this invoice $invoiceNo.
							</div>
							<script>
			 				swal({
								  title: 'Please you cannot perform that action again on this invoice $invoiceNo.',
								  icon: 'warning',
								  button: 'OK!',
								});
				 			</script>";
					}
					else{
						$result=mysqli_query($link,"INSERT INTO tbl_payment (outletID,invoiceNo,invoiceAmount,dateInvoice,	dueDate,paymentMode,paymentType,amountPaid,balance,postDate) VALUES ('$outlet','$invoiceNo','$invoiceAmount','$dateInvoice','$dueDate','$payMode','$payType','$amountPaid','$balance','$postDate')");

						$result=mysqli_query($link,"INSERT INTO tbl_paymentinvoice (outletID,invoiceNo,invoiceAmount,dateInvoice,	dueDate,paymentMode,paymentType,amountPaid,balance,postDate) VALUES ('$outlet','$invoiceNo','$invoiceAmount','$dateInvoice','$dueDate','$payMode','$payType','$amountPaid','$balance','$postDate')");
					
					if($result){
					 @$div="<div class='alert text-center alert-success alert-dismissible col-lg-12 col-lg-push-0'>
							<button type=button class=close data-dismiss=alert><span>&times;</span></button>
							 Payment has just been confirmed Successfully!
							</div>
							<script>
			 				swal({
								  title: 'Payment has just been confirmed Successfully!',
								  icon: 'success',
								  button: 'Close!',
								});
								setTimeout(function(){
									window.location.href='payment?$rand1&id_1'
								},2000)
				 		</script>";
						}
					}
				}
				echo @$div;
?>