<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Transport Manager" || $list=="Administrator" || $list=="Accountant" | $list=="Manager"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_confee WHERE eid='$id'");
      $rowt=mysqli_fetch_array($result);
  }
  //AUTO GETTING BL AND CONTAINERS
  $result=mysqli_query($link,"SELECT * FROM tp_container");
      while($row_=mysqli_fetch_array($result)){
          @$optCon.="<option value='$row_[2]'>$row_[2]</option>";
  }

  //SELECTING Container Cost DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_confee ORDER BY aid DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
          <td><a href='tp-cost?$rand1&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <a href='tp-cost?$rand1&vw=$row[1]&$rand2' class='btn btn-default btn-sm' role='button' id='update_trans'><span class='fa fa-cart-plus'>&nbsp;View</span></a>
          </td>
        </tr>";
    $i++;
  }
  //ADDING MORE BALANCE
  if(isset($_GET['vw'])){
      $id=$_GET['vw'];
      $result=mysqli_query($link,"SELECT * FROM tbl_confee WHERE conNo='$id' ORDER BY aid DESC");
      $res=mysqli_fetch_array($result);
      $amt=$res[2];
      $bals=$res[4];
      if($bals!=0){
          //GETTING THE TOTAL DEPOSIT
          $prevBal="<label class='form-control-label' for='prevbal'>Previous Balance</label>
          <input type='text' id='prevbal' name='prevbal' class='form-control text-uppercase' value='$res[4]' style='pointer-events:none;'>";
      }
      else{
        //GETTING THE TOTAL DEPOSIT
          $prevBal="
          <input type='text' id='prevbal' name='prevbal' class='form-control text-uppercase' value='$res[4]' style='pointer-events:none;display:none;'>";
      }
      $rdepo=mysqli_query($link,"SELECT SUM(deposit) as depose FROM tbl_confee WHERE conNo='$id'");
      $resd=mysqli_fetch_array($rdepo);
      $tdeposit="$resd[depose]";
      if($amt==$tdeposit){
          $tdeposit="<label class='form-control-label text-success'>Balance is completed successfully! <i class='fa fa-check-circle text-success'></i> </label>";
      }
      else{
         $tdeposit="<label class='form-control-label'>Total Deposit : <i class='text-danger'><s style='text-decoration-style:double;'>N</s>".number_format($tdeposit,2)."</i></label>";
      }
      $result=mysqli_query($link,"SELECT * FROM tbl_confee WHERE conNo='$id' ORDER BY aid DESC");
      $i=1;
      $submit_btn="<button type='submit' id='submit_btn' name='submit_btn' class='btn btn-primary'>Save</button>";
      while ($row=mysqli_fetch_array($result)) {
        @$opt.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span> Delete</button>
              </td>
            </tr>";
        $i++;
      }
  }
  //UPDATING TRANSIRE
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $conID = htmlentities($_POST['conID']);
    $amount = htmlentities($_POST['amount']);
    $paid = htmlentities($_POST['paid']);
    $paid=str_replace(",","", $paid);
    $bal = htmlentities($_POST['bal']);
    $bal=str_replace(",","", $bal);
    
    $ref_update=mysqli_query($link,"UPDATE tbl_confee SET conID='$conID', amount='$amount', deposit='$paid', balance='$bal' WHERE aid='$id'");
   
    $div="<script>
            swal('Container Cost updated successfully!','','success')
            setTimeout(function(){
          window.location.href='tp-cost?$rand1&eup=$rand2'
          },3000)
        </script>
        ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A container cost was updated on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
  }

  //INSERT INTO EXPENSES
  if(isset($_POST['btn_exam'])){
    $conID = htmlentities($_POST['conID']);
    $amount = htmlentities($_POST['amount']);
    $paid = htmlentities($_POST['paid']);
    $paid=str_replace(",","", $paid);
    $bal = htmlentities($_POST['bal']);
    $bal=str_replace(",","", $bal);
    if($conID==""){
        $div="<script>
              swal('Please select the container number','','error')
          </script>";
    }
    else if($amount==''){
        $div="<script>
              swal('Please enter the amount','','error')
          </script>";
    }
    else if($paid==''){
        $div="<script>
              swal('Please enter the amount paid','','error')
          </script>";
    }
    else{
        $sqls = "INSERT INTO tbl_confee (conNo,amount,deposit,balance,postDate) VALUES ('$conID','$amount','$paid','$bal',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
          $div="<script>
                      swal('Container charges added successfully!','','success')
                      setTimeout(function(){
                          window.location.href='tp-cost?e=$rand1'
                      },3000)
                  </script>
                  ";
          $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
          $message=" A container charge was added on $date by ";
          $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
          $out1 = mysqli_query($link,$sql1);
        }
     }
  }

  //INSERT INDIVIDUAL EXPENSES
  if(isset($_POST['submit_btn'])){
    $id=$_GET['vw'];
    $conID = htmlentities($_POST['conID2']);
    $amount = htmlentities($_POST['amount2']);
    $paid = htmlentities($_POST['paid2']);
    $paid=str_replace(",","", $paid);
    $bal = htmlentities($_POST['bal']);
    $bal=str_replace(",","", $bal);
    if($conID==""){
        $div="<script>
              swal('Please select the container number','','error')
          </script>";
    }
    else if($amount==''){
        $div="<script>
              swal('Please enter the amount','','error')
          </script>";
    }
    else if($paid==''){
        $div="<script>
              swal('Please enter the amount paid','','error')
          </script>";
    }
    else{
        $sqls = "INSERT INTO tbl_confee (conNo,amount,deposit,balance,postDate) VALUES ('$conID','$amount','$paid','$bal',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
          $div="<script>
                      swal('Information saved successfully!','','success')
                      setTimeout(function(){
                          window.location.href='tp-cost?e=$rand1&vw=$id&$rand2'
                      },3000)
                  </script>
                  ";
          $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
          $message=" A container charge was added on $date by ";
          $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
          $out1 = mysqli_query($link,$sql1);
        }
     }
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $result=mysqli_query($link,"DELETE FROM tbl_confee WHERE aid='$id'");
      $div="<script>
          swal('Container cost removed successfully','','success')
          setTimeout(function(){
          window.location.href='tp-cost?$rand1&'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A container charge was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
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
            <h2 class="display-2 text-white">Container Cost Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="tp-cost?<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Container Fee</a>
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
                  <h3 class="mb-0"><?=$list?> </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_tp" name="form_tp" action="" method="POST">
                <div class="text-center text-uppercase"><h2>Container  Expenses</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="form-row">
                    <!-- <div class="col-4">
                        <label class="form-control-label" for="e_bl">BL Number</label>
                        <input type="text" id="e_bl" name="e_bl" class="form-control text-uppercase" placeholder="Enter BL Number" value="<?php if(isset($_GET['ed'])){echo $rowt[1];}else{echo @$e_bl;} ?>">
                    </div> -->
                     <!-- CONTAINER NUMBER -->
                    <div class="col-4">
                        <div <?php if(!isset($_GET['ed'])){echo "style='display:none'";} if(isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="conID1">Container Number</label>
                        <input type="text" id="conID1" name="conID1" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];} ?>">
                      </div>
                      <div <?php if(!isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="conID2">Container Number</label>
                        <input type="text" id="conID2" name="conID2" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="<?php if(isset($_GET['vw'])){echo $res[1];} ?>">
                      </div>
                      <div <?php if(isset($_GET['ed'])){echo "style='display:none'";} if(isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="conID">Container Number</label>
                        <select class="form-control" name="conID" id="conID">
                            <option value="">Select the container here</option>
                            <?=@$optCon;?>
                        </select>
                      </div>    
                    </div>
                     <!-- AMOUNT CHARGED -->
                    <div class="col-4" <?php if(isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="amount">Amount Charged</label>
                        <input type="text" id="amount" name="amount" class="form-control text-uppercase" placeholder="Enter amount" value="<?php if(isset($_GET['ed'])){echo $rowt[2];}else{echo @$amount;} ?>">
                    </div>
                    <div class="col-4" <?php if(!isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="amount2">Amount Charged</label>
                        <input type="text" id="amount2" name="amount2" class="form-control text-uppercase" placeholder="Enter amount" value="<?php if(isset($_GET['vw'])){echo $res[2];}else{echo @$amount2;} ?>" style='pointer-events:none;'>
                    </div>
                    <!-- DEPOSIT -->
                    <div class="col-4" <?php if(isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="paid">Deposit</label>
                        <input type="text" id="paid" name="paid" class="form-control text-uppercase" placeholder="Enter Amount Deposited" value="">
                    </div>
                    <div class="col-4" <?php if(!isset($_GET['vw'])){echo "style='display:none'";}?>>
                        <label class="form-control-label" for="paid2">Deposit</label>
                        <input type="text" id="paid2" name="paid2" class="form-control text-uppercase" placeholder="Enter Amount Deposited" value="">
                    </div>
                     <!-- BALANCE -->
                    <div class="col-4">
                        <label class="form-control-label" for="bal">Balance</label>
                        <input type="text" id="bal" name="bal" class="form-control text-uppercase" placeholder="Balance" value="<?php if(isset($_GET['ed'])){echo $rowt[4];}else{echo @$bal;} ?>" style='pointer-events:none;'>
                    </div>
                    <div class="col-4" <?php if(!isset($_GET['vw'])){echo "style='display:none'";} ?>>
                        <?=@$prevBal;?>
                    </div>
                    <div class="col-4" style="margin-top:2rem;">
                      <button type="submit" id="btn_exam" name="btn_exam" class="btn btn-default" <?php if(isset($_GET['ed'])){echo "style='display:none'";} if(isset($_GET['vw'])){echo "style='display:none'";} ?>>Submit</button>
                      <?=@$update_btn; ?>
                      <?=@$submit_btn; ?>
                    </div>
                    <div class="col-12 mt-4" <?php if(!isset($_GET['vw'])){echo "style='display:none'";} ?>>
                          <?=@$tdeposit?>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
              </form>
              <hr>
              <div  <?php if(isset($_GET['vw'])){echo "style='display:none'";} ?>>
                <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Container Number</th>
                      <th>Amount Charged</th>
                      <th>Deposit</th>
                      <th>Balance</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div>
                <div  <?php if(!isset($_GET['vw'])){echo "style='display:none'";} ?>>
                <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Container Number</th>
                      <th>Amount Charged</th>
                      <th>Deposit</th>
                      <th>Balance</th>
                      <th>Paid on</th>
                      <th>Action</th>
                    </thead>
                    <?= @$opt;?>
                  </table>
                </div>
            </div><!-- END CARD DBODY -->
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>