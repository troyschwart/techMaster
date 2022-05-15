<?php
	include('../includes/connection.php');

@$search_text=htmlentities($_POST["search-prog"]);
if($search_text!=null){
	$options="<table class='table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive' width='100%' id=''>
    <thead class='th'>
      <th>S/No.</th>
      <th>Date of bill</th>
      <th>BL Number</th>
      <th>Container no.</th>
      <th>Size</th>
      <th>Type of Goods</th>
      <th>Consignee</th>
      <th>ETA</th>
      <th>Release</th>
      <th>PAAR</th>
      <th>Import</th>
      <th>Terminal</th>
      <th>Delivered</th>
      <th>Date Posted</th>
      <th>Action</th>
    </thead>";//LIKE '%$search_text%'
	$result_check=mysqli_query($link,"SELECT * FROM tbl_prog WHERE blNo='$search_text' AND delivryStatus='no'");
	if(mysqli_num_rows($result_check)>=1){
	  $i=1;
	  while ($row=mysqli_fetch_array($result_check)) {
	    $bl_date=date('d-m-Y',  strtotime($row[1]));
	    @$options.="<tr>
	          <td> $i</td>
	          <td>$bl_date</td>
	          <td>$row[2]</td>
	          <td>$row[3]</td>
	          <td>$row[4]</td>
	          <td>$row[5]</td>
	          <td>$row[6]</td>
	          <td>$row[7]</td>
	          <td>$row[8]</td>
	          <td>$row[9]</td>
	          <td>$row[10]</td>
	          <td>$row[11]</td>
	          <td>$row[12]</td>
	          <td>$row[16]</td>
	          <td><a href='view_prog?$rand1&m=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'>Move <span class='fa fa-angle-double-right'></span></a>
	          <a href='progressive-report?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'> Edit <span class='fa fa-edit'></span></a>
	          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
	          </td>
	        </tr>";
	    $i++;
	  }
	}
	else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
echo @$options;
?>