<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Breverage"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//ACTIVATING THE UPDATE BUTTON
  if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $update_btn="<button type='submit' id='btn_update' name='btn_update' class='btn btn-danger'>Update</button>";
      $result=mysqli_query($link,"SELECT * FROM tbl_payment WHERE PID='$id'");
      $rows=mysqli_fetch_array($result);
      //SELECTING FOR CONTAINER NUMBER
  }
//SELECTING OUTLET NAMES
  $result=mysqli_query($link,"SELECT * FROM tbl_outlet");
  while ($row=mysqli_fetch_array($result)) {
    @$option.="<option value='$row[0]';>$row[1]</option>";
  }
  //SHOWING PAYMENT ADDED 
  $result=mysqli_query($link,"SELECT * FROM tbl_payment ORDER BY PID DESC");

  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    $id=$row[1];
    $storeName=$row[2];
    $invoiceAmt=number_format($row[3],2);
    $amount=number_format($row[8],2);
    $bal=number_format($row[9],2);
    
    $invoice_date=$row[4];
    $exp_date=$row[5];
    $today_date=date("Y-m-d");
    //Converting Dates to strings
    $td=strtotime($today_date);
    $exp=strtotime($exp_date);
    //Now Comparing by using logic
    
    $val=mysqli_query($link,"SELECT * FROM tbl_outlet WHERE outletID='$id'");
    if(mysqli_num_rows($result)>0){
    $row1=mysqli_fetch_array($val);
    if($td==$exp){
        $diff=$td-$exp;
        $values=abs(floor($diff/(60*60*24)));
        if($bal==0){
          $status=" <span class='fa fa-check-circle text-success'></span><a class='text-center text-success'> Fully Paid</a>";
          $value="<span class='fa fa-check-circle text-success'></span>";
        }
        else{
          $status="<a class='text-center text-danger'>Oweing</a> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
          $value="<i class='text-danger'>Due date reached<i>";
        }
        
    }//END IF*************************************************************************
    else if($td>$exp){
      $diff=$td-$exp;
      $val=abs(floor($diff/(60*60*24)));
      
      if($val==1){
        //CHECKING BALANCE FIRST
        if($bal==0){
          $status=" <span class='fa fa-check-circle text-success'></span><a class='text-center text-success'> Fully Paid</a>";
          $value="<span class='fa fa-check-circle text-success'></span>";
        }
        else{
          $status="<a class='text-center text-danger'> Oweing</a> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
            $value="<i class='text-danger'>$val day exceeded</i>";
        }
      }
      else {
        //CHECKING BALANCE FIRST
        if($bal==0){
          $status=" <span class='fa fa-check-circle text-success'></span><a class='text-center text-success'> Fully Paid</a>";
          $value="<span class='fa fa-check-circle text-success'></span>";
        }
        else{
          $status="<a class='text-center text-danger'> Oweing</a> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
            $value="<i class='text-danger'>$val days exceeded</i>";
        }
      }
    }
    //END ELSE IF*************************************************************************
    else{
          $diff=$td-$exp;
          $val=abs(floor($diff/(60*60*24)));
          
          if($val==1){
            //CHECKING BALANCE FIRST
            if($bal==0){
            $status=" <span class='fa fa-check-circle text-success'></span><a class='text-center text-success'> Fully Paid</a>";
            $value="<span class='fa fa-check-circle text-success'></span>";
            }
            else{
              $status="<a class='text-center text-danger'> Oweing</a> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
                $value=$val." "."day Left";
            }
          }
          else {
            //CHECKING BALANCE FIRST
            if($bal==0){
            $status=" <span class='fa fa-check-circle text-success'></span><a class='text-center text-success'> Fully Paid</a>";
            $$value="<span class='fa fa-check-circle text-success'></span>";
            }
            else{
              $status="<a class='text-center text-danger'> Oweing</a> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
                $value=$val." "."days Left";
            }
          }
        }
        //END ELSE ********************************************************

        @$options.="<tr>
              <td> $i</td>
              <td>$row1[1]</td>
              <td><a href='invoice_number?$rand1&&id_4&&num=$row[2]&&view=$row[2]'>$row[2]</a></td>
              <td>$invoiceAmt</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$amount</td>
              <td>$bal</td>
              <td>$value</td>
              <td>$status</td>
              <td>$row[10]</td>
              <td>
                <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></button>
              </td>
            </tr>";
        $i++;
      }
       else{
            header("Location:payment?$rand1&&id_1");
        }
    }
 // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $value=mysqli_query($link,"SELECT * FROM tbl_payment WHERE PID='$id'");
      $row=mysqli_fetch_array($value);
      $invoiceID=$row[2];
      mysqli_query($link,"DELETE FROM tbl_paymentinvoice WHERE invoiceNo='$invoiceID'");
      mysqli_query($link,"DELETE FROM tbl_payment WHERE PID='$id'");
      
      $div= "<script>
          swal('Payment has been removed successfully!','', 'success');
                setTimeout(function(){
                window.location.href='payment?$rand1&&id_1'
                },3000)
            </script>";
    }
    if(isset($_POST['check_bt'])){
      $outlet_1=$_POST['outlet_1'];
      if($outlet_1=="choose"){
        $div="<script>
              swal('Error!','Please choose an outlet', 'error');
            </script>";
      }
      else{
        header("location:payment_info?$rand1&&id_6&&opt=$outlet_1&&num=$outlet_1");
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
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Add payment Page</h2>
            <a href="Payments?vw=<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Payment Details</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center text-uppercase">
                <div class="col-8">
                  <h3 class="mb-0"><?=$list?> payments</h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form  method="POST" action="<?php $PHP_SELF ?>" name="form_payment" id="form_payment">
              <div class="row">
                <div class="col-md-12">
                  <div class="text-center text-uppercase mb-5"><h2>Add Payment Form</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <!-- OUTLET NAME -->
                      <label class="form-control-label">Name of Outlet</label>
                        <select class="form-control" name="outlet" id="outlet" >
                          <option value="choose">Select Outlet Name</option>
                          <?=$option ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                      <!-- INVOICE NUMBER -->
                        <label class="form-control-label">Invoice Number</label>
                        <input type="text" name="invoiceNo" id="invoiceNo" placeholder="Enter Invoice Number" class="form-control text-uppercase" value="<?= @$invoiceNo;?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <!-- INVOICE AMOUNT -->
                        <label class="form-control-label">Invoice Amount</label>
                        <input type="text" name="invoiceAmount" id="invoiceAmount" placeholder="Enter Invoice Amount" class="form-control" value="<?= @$invoiceAmount;?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <!-- DATE OF INVOICE -->
                        <label class="form-control-label">Date of Invoice</label>
                        <input type="text" name="dateInvoice" id="dateInvoice" placeholder="Enter Date of Invoice" class="form-control" value="<?= @$dateInvoice;?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <!-- INVOICE DUE DATE -->
                        <label class="form-control-label">Invoice Due Date</label>
                        <input type="text" name="dueDate" id="dueDate" placeholder="Enter Invoice Due Date" class="form-control" value="<?= @$dueDate;?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <!-- PAYMENT TYPE -->
                        <label class="form-control-label">Payment Type</label>
                        <select type="text" name="payType" id="payType" class="form-control" >
                          <option value="choose">Select Payment Type</option>
                          <option value="Full">Full</option>
                          <option value="Part">Part</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                      <!-- VALUE OF AMOUNT PAID -->
                        <label class="form-control-label">Amount paid</label>
                        <input type="text" maxlength="11" name="amountPaid" id="amountPaid" placeholder="Enter Value of Amount Paid" class="form-control" value="<?= @$amountPaid;?>" >
                    </div>
                    <div class="form-group col-md-3">
                      <!-- BALANCE -->
                        <label class="form-control-label">Balance</label>
                        <input type="text" name="balance" id="balance" placeholder="Enter Balance" class="form-control" value="0" readonly>
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                      <label>&nbsp;</label>
                      <input type="submit" name="submit_pay" class="btn btn-info form-control" id="submit_pay" value="submit">
                  </div>
                  </form>
                <h2 class="text-center">Payments Made</h2>
                
                  <table class="table table-hover table-striped table-bordered text-black text-center text-capitalize table-responsive" width="100%" id="example">
                  <thead class="th">
                    <th>S/N</th>
                    <th>Name of Outlet</th>
                    <th>Invoice Number</th>
                    <th>invoice Amount</th>
                    <th>Date of Invoice </th>
                    <th>Due Date of Invoice</th>
                    <th>Payment Mode</th>
                    <th>Payment Type</th>
                    <th>Amount Paid</th>
                    <th>Balance</th>
                    <th>Reminder</th>
                    <th>Status</th>
                    <th>Date Posted</th>
                    <th>Action</th>
                  </thead>
                  <?= $options;?>
                </table>
             
            </div><!-- END CARD BODY -->
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>