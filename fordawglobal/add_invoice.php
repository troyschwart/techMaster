<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Releasing Officer" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}

  //SELECTING THE CONTAINERS BASE ON THE BL NUMBER
      $g_total=0;
      @$blid=$_POST['bNo'];
      $result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE bid='$blid'");
      $row_r=mysqli_fetch_array($result);
      $blNo=$row_r[2];
      $result=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$blid'");
      $i++;
      while($row_=mysqli_fetch_array($result)){
          @$opt.="<option value='$row_[2]'>$row_[2]</option>";
          $i++;
      }

  //ADDING THE INVOICE
  if(isset($_POST['btn-inv'])){
    $bl_bill = htmlentities(ucwords($_POST['bl_bill']));
    $conID = htmlentities($_POST['conID']);
    $conDep = htmlentities($_POST['conDep']);
    $bl_import = htmlentities($_POST['bl_import']);
    $bl_amount = htmlentities($_POST['bl_amount']);
    $bl_amount=str_replace(",","", $bl_amount);
    $bl_dent = htmlentities($_POST['bl_dent']);
    $bl_amt = htmlentities($_POST['bl_amt']);
    $bl_amt=str_replace(",","", $bl_amt);
    $ship=$bl_amount+$bl_amt;
     //CHECKING RECORD ON INVEST TABLE
    $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$bl_bill' AND conNo='$conID'");
    //CHECKING RECORD ON INVOICE TABLE
    $result1=mysqli_query($link,"SELECT * FROM tbl_invoice WHERE blNo='$bl_bill' AND  conNo='$conID'");
    
    if($bl_bill==''| $conID=='' | $bl_import==''| $bl_amount==''| $bl_dent==''| $bl_amt==''){
        $div=" <script>
            swal('Please make sure that all fields are field correctly!','','error')
        </script>
        ";
    }
    else if(mysqli_num_rows($result)==1){
        $ref_update=mysqli_query($link,"UPDATE tbl_invest SET ship='$ship' WHERE blNo='$bl_bill' AND conNo='$conID'");
          $div="<script>
                swal('Shipping invoices updated on the record successfully!','','success')
                setTimeout(function(){
                    window.location.href='examination?e=$rand1'
                },3000)
            </script>
            ";
            if(mysqli_num_rows($result1)==0){
                 $sqls = "INSERT INTO tbl_invoice (blNo,conNo,invNo,invAmt,denInv,denAmt,postDate,condep) VALUES ('$bl_bill','$conID','$bl_import','$bl_amount','$bl_dent','$bl_amt',now(),'$conDep')" ;
                 $outs = mysqli_query($link,$sqls);
            }
    }
    else{ 
        $sqls = "INSERT INTO tbl_invoice (blNo,conNo,invNo,invAmt,denInv,denAmt,postDate,condep) VALUES ('$bl_bill','$conID','$bl_import','$bl_amount','$bl_dent','$bl_amt',now(),'$conDep')" ;
        $outs = mysqli_query($link,$sqls);
        $sqls1 = "INSERT INTO tbl_invest (blNo,ship,postDate,conNo) VALUES ('$bl_bill','$ship',now(),'$conID')" ;
        $outs = mysqli_query($link,$sqls1);
        if($outs){
            $div="<script>
                        swal('Send successfully!','','success');
                        setTimeout(function(){
                            window.location.href='view-transactions?$rand1&'
                        },3000)
                    </script>
                    ";
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A BL Number & invoice was sent on $date by ";
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
            <h2 class="display-2 text-white">Add Invoices Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="view-transactions?<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Invoices</a>
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
              <form id="form_bl" name="form_bl" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <h6 class="heading-small text-muted mb-4"></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_bill">Bill of Lading</label>
                        <input type="text" id="bl_bill" name="bl_bill" class="form-control text-uppercase" placeholder="Bill of Landing" maxlength="20" value="<?php echo @$blNo; ?>" style="pointer-events: none;">
                      </div>
                    </div>
                    <!-- CONTAINER NUMBER -->
                    <div class="col-lg-6">
                      <label class="form-control-label" for="conID">Container Number</label>
                      <select class="form-control text-uppercase" name="conID" id="conID">
                          <option value="">Select the container here</option>
                          <?=@$opt;?>
                      </select>
                    </div>
                    <!-- CONTAINER DEPOSIT -->
                    <div class="col-lg-6">
                      <label class="form-control-label" for="bl_con">Container Deposit / Waiver</label>
                      <input type="text" id="bl_con" name="bl_con" class="form-control text-uppercase" placeholder="Enter Container Deposit" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$bl_con;} ?>">
                    </div>
                    <!-- IMPORT INVOICE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_import">Import Invoice</label>
                        <input type="text" id="bl_import" name="bl_import" class="form-control text-uppercase" placeholder="Enter Import Invoice" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$importInvoice;} ?>">
                      </div>
                    </div>
                    <!-- AMOUNT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_amount">Amount</label>
                        <input type="text" id="bl_amount" name="bl_amount" class="form-control text-uppercase cal-inv " placeholder="Enter amount" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$amount;} ?>">
                        <input type="hidden" id="bl_amount1" name="bl_amount1">
                      </div>
                    </div>
                    <!-- DETENTION INVOICE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_dent">Detention Invoice</label>
                        <input type="text" id="bl_dent" name="bl_dent" class="form-control text-uppercase" placeholder="Enter Detention Invoice" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$detenInvoice;} ?>">
                        
                      </div>
                    </div>
                    <!-- AMOUNT 2-->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_amt">Amount</label>
                        <input type="text" id="bl_amt" name="bl_amt" class="form-control text-uppercase cal-inv" placeholder="Enter amount" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$bl_amt;} ?>">
                        <input type="hidden" id="bl_amt1" name="bl_amt1">
                      </div>
                    </div>
                    <!-- GRAND TOTAL 2-->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="g_total">Grand Total</label>
                        <input type="text" id="g_total" name="g_total" class="form-control" value="" style="pointer-events: none;">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn-inv" name="btn-inv" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Send</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>