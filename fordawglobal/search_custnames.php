<?php
	include('../includes/connection.php');

	@$search_text=htmlentities($_POST['search_text']);
		$result_check=mysqli_query($link,"SELECT * FROM tbl_cus1 WHERE cusName LIKE '%$search_text%'");
		
		@$div="<table class='table table-hover table-striped table-bordered text-black text-uppercase table-responsive' width='100%' id=''>
                <th>S/N</th>
                <th>Customer Name</th>
                <th>Opening Balance</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Closing Balance</th>
                <th>Actions</th>";
            $i=1;
		if(mysqli_num_rows($result_check)>=1){
			while($row=mysqli_fetch_array($result_check)){
				@$div.="<tr>
		              <td> $i</td>
		              <td>$row[2]</td>
		              <td>".number_format($row[3],2)."</td>
		              <td>".number_format($row[4],2)."</td>
		              <td>".number_format($row[5],2)."</td>
		              <td>".number_format($row[6],2)."</td>
		              <td>
		              <a href='cust-acc?$rand1&cs=$row[1]&$rand2' class='btn btn-default btn-sm' role='button'>View <span class='fa fa-chalkboard-teacher'></span></a>
		              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
		              </td>
		            </tr>";
				$i++;
			}
		}
		else{
			@$div.="<tr><td class='text-center' colspan='7'>NO DATA AVAILABLE IN TABLE</td></tr></table>";
		}
	echo @$div;
?>