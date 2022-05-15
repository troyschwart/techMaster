<?php
			include('../includes/connection.php');
	  		
				@$stockName=strtoupper(htmlentities($_POST['stockName']));
				@$product=strtoupper(htmlentities($_POST['product']));
				@$qty=htmlentities($_POST['qty']);
				@$price=htmlentities($_POST['price']);

				$result_stock=mysqli_query($link,"SELECT * FROM tbl_stock WHERE product='$product'");
				$row=mysqli_fetch_array($result_stock);
				$newQty=$row[3];

				if($stockName=="choose"){
			 		 @$div="<script>
			 				swal('Error!','Please select a stock', 'warning');
				 		</script>";
			 	}
				else if(empty($product)){
			 		 @$div="<script>
			 				swal('Error!','Please enter the name of the product', 'error');
				 		</script>";
			 	}
			 	else if($qty==""){
			 		 @$div="<script>
			 				swal('Error!','Please enter quantity', 'error');
				 		</script>";
			 	}
			 	else if($price==null){
			 		 @$div="<script>
			 				swal('Error!','Please enter price', 'warning');
				 		</script>";
			 	}
				else{
					//CHECKING PRODUCTS ADDED
					if(mysqli_num_rows($result_stock)>0){
						//$newQty1=$newQty+$qty;
						$stock_update=mysqli_query($link,"UPDATE tbl_stock SET qty=qty+$qty WHERE product='$product'");
						//SUMMING QTY
						$result_bals=mysqli_query($link,"SELECT SUM(qty) as total FROM tbl_stock WHERE product='$product'");
						$rows=mysqli_fetch_array($result_bals);
						@$totals=$rows['total'];
						
						$error_msg ="Stock Updated Succcessfully. The total stock added on $product is: $totals";
						 @$div="<script>
				 				swal({
									  title: '$error_msg',
									  icon: 'success',
									  button: 'Close!',
									})
									setTimeout(function(){
							            window.location.href='add_stock?vw=$rand1&&id_4'
							            },3000)
					 		</script>";
					}
					else{
						
						$result=mysqli_query($link,"INSERT INTO tbl_stock (CID,product,qty,price,postDate) VALUES ('$stockName','$product','$qty','$price',CURRENT_TIMESTAMP)");
						$lastID=mysqli_insert_id($link);
						$prodID=$lastID;
						$ref_update=mysqli_query($link,"UPDATE tbl_stock SET productID='$prodID' WHERE product='$product'");
					
						if($result){
							//SUMMING QTY
						$result_bals=mysqli_query($link,"SELECT SUM(qty) as total FROM tbl_stock WHERE product='$product'");
						$rows=mysqli_fetch_array($result_bals);
						@$totals=$rows['total'];
						 $error_msg ="Stock Added Succcessfully. The total stock added on $product is: $totals";
						 @$div="<script>
				 				swal({
									  title: '$error_msg!',
									  icon: 'success',
									  button: 'Close!',
									})
									 setTimeout(function(){
							            window.location.href='add_stock?vw=$rand1&&id_4'
							            },3000)
					 		</script>";
						}
					}
				}
				
				echo $div;
?>