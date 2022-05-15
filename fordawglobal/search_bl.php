<?php
	include('../includes/connection.php');

@$search_text=htmlentities($_POST['search-txt']);
if($search_text!=null){
	$options="<table class='table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive' width='100%' id='example'>
                    <thead class='th'>
                      <th>S/No.</th>
                      <th>Date of bill</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Container Size</th>
                      <th>customer Name</th>
                      <th>Bill of lading Status</th>
                      <th>E.T.A</th>
                      <th>PAAR</th>
                      <th>Type of items/goods</th>
                      <th>Place of Exam</th>
                      <th>Port of discharge</th>
                      <th>Release Status</th>
                      <th>Consignee</th>
                      <th>Delivery Order</th>
                      <th>Delivery Expiration</th>
                      <th>Expiration Status</th>
                      <th>Date Posted</th>
                    </thead>";
	$result_check=mysqli_query($link,"SELECT * FROM tbl_bill WHERE blNo='$search_text'");
	if(mysqli_num_rows($result_check)==1){
		$row=mysqli_fetch_array($result_check);
		$printID=$row[0];
	  //SELECTING BL DETAILS
		$results=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$printID'");
	     while ($rowCon=mysqli_fetch_array($results)) {
	        @$viewCon.="<table border='1' class='text-center' width='100%'><tr><td>$rowCon[2]</td></tr></table>";
	     }
	     $result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE bid='$printID'");
	  $i=1;
	  while ($row=mysqli_fetch_array($result)) {
	  $bl_date=date('d-m-Y',  strtotime($row[1]));
	  $dvery=$row[13];

	  //VALIDATING EXPIRED DATES
	  $exp_date=$row[17];
	  $today_date=date('Y-m-d');
	  //Converting Dates to strings
	  $td=strtotime($today_date);
	  $exp=strtotime($exp_date);
	  //Now Comparing by using logic
	  if($td==$exp){
	        $diff=$td-$exp;
	        $values=abs(floor($diff/(60*60*24)));
	        $remDays="<i class='text-danger days'>Order expires today</i> <div class='fa fa-circle text-success wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div><i>";
	    }
	    else if($td>$exp){
	      $diff=$td-$exp;
	      $val=abs(floor($diff/(60*60*24)));
	      
	      if($val==1){
	        $remDays="<i class='text-danger days'>$val day exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
	      }
	      
	      else {
	          $remDays="<i class='text-danger days'>$val days exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
	        
	      }
	    }
	    else{
	        $diff=$td-$exp;
	        $val=abs(floor($diff/(60*60*24)));
	        
	        if($val==1){
	          $remDays="<i class='text-success days'>$val day Left</i>";
	        }
	        else {
	          $remDays="<i class='text-success days'>$val days Left</i>";
	        }
	      }
	    //CHECKING WHEN NO DATE IS ENTERED
	    if($exp_date==null){
	      $remDays="<i class='text-danger days'>No expire date entered</i>";
	    }
	    //CHECKING DELIVERY ORDER UPLOADED
	    if($dvery==null){
	        $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
	    }
	    else{
	        $dery_="<a href='$row[13]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
	    }
	    @$options.="<tr>
	          <td> $i</td>
	          <td>$bl_date</td>
	          <td>$row[2]</td>
	          <td>$viewCon</td>
	          <td>$row[3]</td>
	          <td>$row[4]</td>
	          <td>$row[5]</td>
	          <td>$row[6]</td>
	          <td>$row[8]</td>
	          <td>$row[9]</td>
	          <td>$row[10]</td>
	          <td>$row[11]</td>
	          <td>$row[12]</td>
	          <td>$row[16]</td>
	          <td>$dery_</td>
	          <td>$row[17]</td>
	          <td>$remDays</td>
	          <td>$row[15]</td>
	        </tr>";
	    $i++;
	  }
	}
}
echo @$options;
?>