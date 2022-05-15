<?php
	include('../includes/connection.php');

	@$outlet=htmlentities($_POST['outlet']);
	$val=mysqli_query($link,"SELECT * FROM tbl_outlet WHERE outletID='$id'");
	$outletName=$val[1];
	$code=substr($outletName, 0,2);
	@$div="$code";
/*$result=mysqli_query($link,"SELECT * FROM tbl_cus1 ORDER BY id DESC");
  $rowval=mysqli_fetch_array($result);
  $id=$rowval[0];
  $id1=$rowval[8];
  $doc=$rowval[1];
  if($doc==null){
    $ids="1";
    $cusID="CUS001";
  }
  else if($id<10){
    $ids=$id+1;
    $ID=$id1+1;
    $cusID="CUS00".$ID;
  }
  elseif($id<100){
    $ids=$id+1;
    $ID=$id1+1;
    $cusID="CUS0".$ID;
  }
  else{
    $ids=$id+1;
    $ID=$id1+1;
    $cusID="CUS".$ID;
  }*/
	/*if($outlet!=null){
		$result_check=mysqli_query($link,"SELECT * FROM tbl_payment");
		if(mysqli_num_rows($result_check)==1){
			$row=mysqli_fetch_array($result_check);
			$div=$row[1];
		}
	}*/
	echo @$div;
?>