<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Shipping Manager" || $list=="Administrator" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}

      //AUTO GETTING BL AND CONTAINERS
      $g_total=0;
      $results=mysqli_query($link,"SELECT * FROM tbl_bill");
      while($row_=mysqli_fetch_array($results)){
          @$optBl.="<option value='$row_[2]'>$row_[2]</option>";
      }

      $result=mysqli_query($link,"SELECT * FROM tbl_containers");
      while($row_=mysqli_fetch_array($result)){
          @$optCon.="<option value='$row_[2]'>$row_[2]</option>";
      }
      //ACTIVATING THE UPDATE BUTTON
      if(isset($_GET['ed'])){
        $id=$_GET['ed'];
        $update_btn="<button type='submit' id='btn_update' name='btn_update' class='btn btn-danger'>Update</button>";
        $result=mysqli_query($link,"SELECT * FROM tbl_term WHERE invoiceID='$id'");
        $row=mysqli_fetch_array($result);
         $invAmt=$row[4];
         $denAmt=$row[6];
         @$gtotal=$invAmt+$denAmt;
      }
      //FETCHING TERMINAL JOBS
      $result=mysqli_query($link,"SELECT * FROM tbl_term");
      $i=1;
      while ($rows=mysqli_fetch_array($result)) {
         $invAmt=$rows[4];
         $denAmt=$rows[6];
         @$gtotal=$invAmt+$denAmt;
        @$options1.="<tr>
              <td> $i</td>
              <td>$rows[1]</td>
              <td>$rows[2]</td>
              <td>$rows[3]</td>
              <td>".number_format($rows[4],2)."</td>
              <td>$rows[5]</td>
              <td>".number_format($rows[6],2)."</td>
              <td>".number_format($gtotal,2)."</td>
              <td>$rows[7]</td>
              <td><a href='add_terminal?$rand1&&ed=$rows[0]&$rand2' class='btn btn-info btn-sm' role='button' id='bl-id' value='$rows[0]'>Edit <span class='fa fa-edit'></span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$rows[0]'> Delete <span class='fa fa-trash'></span></button>
              </td>
            </tr>";
        $i++;
      }

  //ADDING THE INVOICE
  if(isset($_POST['btn-inv'])){
    $bl_bill = htmlentities(ucwords($_POST['bl_bill']));
    $conID = htmlentities($_POST['conID']);
    $bl_import = htmlentities($_POST['bl_import']);
    $bl_amount = htmlentities($_POST['bl_amount']);
    $bl_amount=str_replace(",","", $bl_amount);
    $bl_dent = htmlentities($_POST['bl_dent']);
    $bl_amt = htmlentities($_POST['bl_amt']);
    $bl_amt=str_replace(",","", $bl_amt);
    $ship=$bl_amount+$bl_amt;
     //CHECKING RECORD ON INVEST TABLE
    /*$result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$bl_bill' AND conNo='$conID'");*/
    //CHECKING RECORD ON INVOICE TABLE
    $result1=mysqli_query($link,"SELECT * FROM tbl_term WHERE blNo='$bl_bill' AND  conNo='$conID'");
    if(mysqli_num_rows($result)==1){
        /*$ref_update=mysqli_query($link,"UPDATE tbl_invest SET ship='$ship' WHERE blNo='$bl_bill' AND conNo='$conID'");
          $div="<script>
                swal('Shipping invoices updated on the record successfully!','','success')
                setTimeout(function(){
                    window.location.href='examination?e=$rand1'
                },3000)
            </script>
            ";
            if(mysqli_num_rows($result1)==0){
                 $sqls = "INSERT INTO tbl_invoice (blNo,conNo,invNo,invAmt,denInv,denAmt,postDate) VALUES ('$bl_bill','$conID','$bl_import','$bl_amount','$bl_dent','$bl_amt',now())" ;
                 $outs = mysqli_query($link,$sqls);
            }*/
      $div="<script>
          Swal.fire({
              title: 'There is an ongoing terminal transaction on that BL Number and container Number!',
              text: 'If you want to update that information, go to view page and edit it ?',
              icon: 'warning',
              confirmButtonColor:'#007bff',
              confirmButtonText: 'Close'
            })
      </script>";
    }
    else if($bl_bill==''| $conID=='' | $bl_import==''| $bl_amount==''| $bl_dent==''| $bl_amt==''){
        $div=" <script>
            swal('Please make sure that all fields are field correctly!','','error')
        </script>
        ";
    }
    else{ 
        $sqls = "INSERT INTO tbl_term (blNo,conNo,terInv,terAmt,wav,wavAmt,postDate) VALUES ('$bl_bill','$conID','$bl_import','$bl_amount','$bl_dent','$bl_amt',now())" ;
        $outs = mysqli_query($link,$sqls);
        /*$sqls1 = "INSERT INTO tbl_invest (blNo,ship,postDate,conNo) VALUES ('$bl_bill','$ship',now(),'$conID')" ;
        $outs = mysqli_query($link,$sqls1);*/
        if($outs){
            $div="<script>
                        swal('Save successfully!','','success');
                        setTimeout(function(){
                            window.location.href='add_terminal?t=$rand1&'
                        },3000)
                    </script>
                    ";
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A terminal job was sent on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
        else{
        $div=" <script>
                swal('Error Occurred while submitting details, Try again!','','warning')
            </script>
            ";
         }
    }
  }
  //UPDATING INVOICE
if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $bl_bill = htmlentities(ucwords($_POST['bl_bill1']));
    $conID = htmlentities($_POST['conID1']);
    $bl_import = htmlentities($_POST['bl_import']);
    $bl_amount = htmlentities($_POST['bl_amount']);
    $bl_amount=str_replace(",","", $bl_amount);
    $bl_dent = htmlentities($_POST['bl_dent']);
    $bl_amt = htmlentities($_POST['bl_amt']);
    $bl_amt=str_replace(",","", $bl_amt);
    //$ship=$bl_amount+$bl_amt;

    if($bl_bill==''| $conID=='' | $bl_import==''| $bl_amount==''| $bl_dent==''| $bl_amt==''){
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
      $ref_update=mysqli_query($link,"UPDATE tbl_term SET blNo='$bl_bill',conNo='$conID',terInv='$bl_import',terAmt='$bl_amount',wav='$bl_dent',wavAmt='$bl_amt' WHERE invoiceID='$id'");
      /*$ref_update1=mysqli_query($link,"UPDATE tbl_invest SET ship='$gtotal' WHERE blNo='$bl_bill' AND conNo='$conID'");*/

      $div="<script>
          Swal.fire({
              title: 'Updated Successfully',
              text: '',
              icon: 'success',
              showConfirmButton:false
            })
            setTimeout(function(){
                  window.location='add_terminal?t=update=$rand1'
              },3000);
      </script>";
       $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" An update on terminal jobs was made on $date by ";
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
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Add Terminal Jobs Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="add_terminal?<?=$rand1?>&t=<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Terminal Jobs</a>
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
                  <h3 class="mb-0" ><?php echo $list; ?></h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div;?>
              <form id="form_bl" name="form_bl" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8" <?php if(isset($_GET['t'])){echo "style='display:none'";} ?>>
                <h6 class="heading-small text-muted mb-4"></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <div <?php if(!isset($_GET['ed'])){echo "style='display:none'";}?>>
                          <label class="form-control-label" for="bl_bill1">Bill of Lading</label>
                          <input type="text" id="bl_bill1" name="bl_bill1" class="form-control text-uppercase" placeholder="Bill of Landing" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];} if(!isset($_GET['ed'])){echo "style='display:none'";} ?>" style="pointer-events: none;">
                        </div>
                        <div <?php if(isset($_GET['ed'])){echo "style='display:none'";}?>>
                          <label class="form-control-label" for="bl_bill">Bill of Lading</label>
                          <select class="form-control" name="bl_bill" id="bl_bill">
                              <option value="">Select the BL here</option>
                              <?=@$optBl;?>
                          </select>
                       </div>
                      </div>
                    </div>
                    <!-- CONTAINER NUMBER -->
                    <div class="col-lg-6">
                      <div <?php if(!isset($_GET['ed'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="conID1">Container Number</label>
                        <input type="text" id="conID1" name="conID1" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];} ?>" style="pointer-events: none;">
                      </div>
                      <div <?php if(isset($_GET['ed'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="conID">Container Number</label>
                        <select class="form-control" name="conID" id="conID">
                            <option value="">Select the container here</option>
                            <?=@$optCon;?>
                        </select>
                      </div>    
                    </div>
                    <!-- IMPORT INVOICE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_import">Terminal Invoice</label>
                        <input type="text" id="bl_import" name="bl_import" class="form-control text-uppercase" placeholder="Enter Terminal Invoice" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$importInvoice;} ?>">
                      </div>
                    </div>
                    <!-- AMOUNT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_amount">Amount</label>
                        <input type="text" id="bl_amount" name="bl_amount" class="form-control cal-inv" placeholder="Enter amount" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$amount;} ?>">
                        <input type="hidden" id="bl_amount1" name="bl_amount1">
                      </div>
                    </div>
                    <!-- DETENTION INVOICE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_dent">Container Deposit / Waver</label>
                        <input type="text" id="bl_dent" name="bl_dent" class="form-control text-uppercase" placeholder="Enter Container Deposit / Waver" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$detenInvoice;} ?>">
                      </div>
                    </div>
                    <!-- AMOUNT 2-->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_amt">Amount</label>
                        <input type="text" id="bl_amt" name="bl_amt" class="form-control cal-inv" placeholder="Enter amount" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$bl_amt;} ?>">
                        <input type="hidden" id="bl_amt1" name="bl_amt1">
                      </div>
                    </div>
                    <!-- GRAND TOTAL 2-->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="g_total">Grand Total</label>
                        <input type="text" id="g_total" name="g_total" class="form-control" value="<?php if(isset($_GET['ed'])){echo @$gtotal;}else{echo @$gtotal;} ?>" style="pointer-events: none;">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn-inv" name="btn-inv" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Send</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
              <div id="tab" <?php if(isset($_GET['t'])){echo "style='display:block'";}else{echo "style='display:none'";} ?>>
                  <div class="text-center text-uppercase"><h2>Terminal Jobs Added</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Terminal Invoice</th>
                      <th>Terminal Amount</th>
                      <th>Container Deposit / Waver</th>
                      <th>Deposit Amount</th>
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