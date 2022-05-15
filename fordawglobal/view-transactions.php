<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Administrator" || $list=="Releasing Officer" || $list=="Accountant" || $list=="Shipping Manager" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//SELECTING TRANSIRE DETAILS
  // FOR RELEASING OFFICER
//$result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE bid IN (SELECT bid FROM tbl_invoice WHERE bid=tbl_bill.bid)");
 $result=mysqli_query($link,"SELECT * FROM tbl_invoice");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
     $invAmt=$row[4];
     $denAmt=$row[6];
     @$gtotal=$invAmt+$denAmt;
    @$options1.="<tr>
          <td> $i<input type='hidden' id='uid$row[0]' value='$row[0]'></td>
          <td>$row[1]<input type='hidden' id='bn$row[0]' value='$row[1]'></td>
          <td>$row[2]<input type='hidden' id='cn$row[0]' value='$row[2]'></td>
          <td>$row[8]<input type='hidden' id='conDep$row[0]' value='$row[8]'></td>
          <td>$row[3]<input type='hidden' id='inNo$row[0]' value='$row[3]'></td>
          <td>".number_format($row[4],2)."<input type='hidden' id='inAm$row[0]' value='$row[4]'></td>
          <td>$row[5]<input type='hidden' id='dinv$row[0]' value='$row[5]'></td>
          <td>".number_format($row[6],2)."<input type='hidden' id='damt$row[0]' value='$row[6]'></td>
          <td>".number_format($gtotal,2)."</td>
          <td>$row[7]</td>
          <td><a href='javascript:void(0)' class='btn btn-info btn-sm' role='button' id='bl-id' value='$row[0]'>Update <span class='fa fa-edit'></span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'> Delete <span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }
  // DELETE DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $result=mysqli_query($link,"SELECT * FROM tbl_invoice WHERE invoiceID='$id'");
      $rowd=mysqli_fetch_array($result);
      mysqli_query($link,"DELETE FROM tbl_invoice where invoiceID='$id'");
      $ref_update=mysqli_query($link,"UPDATE tbl_invest SET ship='0' WHERE blNo='$rowd[1]' AND conNo='$rowd[2]'");
      $div="<script>
          swal('Transaction details has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view-transactions?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A transaction details was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

//UPDATING INVOICE
if(isset($_POST['btn_update_bl'])){
    $uid = htmlentities(ucwords($_POST['uid']));
    $bl_bill = htmlentities(ucwords($_POST['bl_bill']));
    $conID = htmlentities($_POST['conID']);
    $conDep = htmlentities($_POST['conDep']);
    $bl_import = htmlentities($_POST['bl_import']);
    $bl_amount = htmlentities($_POST['bl_amount']);
    $bl_amount=str_replace(",","", $bl_amount);
    $bl_dent = htmlentities($_POST['bl_dent']);
    $bl_amt = htmlentities($_POST['bl_amt']);
    $bl_amt=str_replace(",","", $bl_amt);
    @$gtotal=$bl_amount+$bl_amt;

    if($bl_bill==''| $conID=='' | $bl_import=='' | $bl_amount=='' | $bl_dent=='' | $bl_amt==''){
       $div=" <script>
            Swal.fire({
              title: 'Please make sure that all fields are field correctly!',
              text: '',
              icon: 'warning',
              confirmButtonColor:'#dc3545'
            })
        </script> ";
    }
    else{ 
      $ref_update=mysqli_query($link,"UPDATE tbl_invoice SET blNo='$bl_bill',conNo='$conID',invNo='$bl_import',invAmt='$bl_amount',denInv='$bl_dent',denAmt='$bl_amt',condep='$conDep' WHERE invoiceID='$uid'");
      $ref_update1=mysqli_query($link,"UPDATE tbl_invest SET ship='$gtotal' WHERE blNo='$bl_bill' AND conNo='$conID'");
      $div="<script>
          Swal.fire({
              title: 'Updated Successfully',
              text: '',
              icon: 'success',
              showConfirmButton:false
            })
            setTimeout(function(){
                  window.location='view-transactions?update=$rand1'
              },3000);
      </script>";
       $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" An update on invoice transaction was made on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
    }
}
?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center mt--5">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">View Invoices Page</h2>
            <button type="button" id="print_bl" name="print_bl" class="btn btn-success" data-toggle='modal' data-target='#modal_bl'><span class="fa fa-print"></span> Print BL's</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center text-uppercase">
                <div class="col-12">
                  <h3 class="mb-0"><?php echo "BL Numbers with transaction";?></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?><?=@$input_id;?>
                <div id="tab3">
                  <div class="text-center text-uppercase"><h2>Transaction on BL's Numbers</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Container Deposit/Waiver</th>
                      <th>Invoice Number</th>
                      <th>Invoice Amount</th>
                      <th>Detention Invoice</th>
                      <th>Detention Amount</th>
                      <th>Grand Total</th>
                      <th>Date & Time of Transaction</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options1;?>
                  </table>
                </div><!-- END TABLE3 DETAILS -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>