<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Accountant" || $list=="Administrator"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_customer WHERE id='$id'");
      $row=mysqli_fetch_array($result);
  }
  //FETCHING FROM CUSTOMER TABLE
   if(isset($_GET['%v%'])){
      $result=mysqli_query($link,"SELECT * FROM tbl_customer ORDER BY id DESC");
      //$result=mysqli_query($link,"SELECT *,SUM(deb) as total FROM tbl_customer GROUP BY cid ORDER BY id DESC");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$option.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>".number_format($row[3],2)."</td>
              <td>".number_format($row[4],2)."</td>
              <td>
              <a href='cust-acc?$rand1&cs=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'>View <span class='fa fa-search-plus'></span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
              </td>
            </tr>";
          $i++;
        }
  }

  //FETCHING INDIVIDUAL ACCOUNT FROM CUSTOMER TABLE
   if(isset($_GET['cs'])){
      $id=$_GET['cs'];
      $result=mysqli_query($link,"SELECT * FROM tbl_customer1 WHERE cid='$id' ORDER BY id DESC");
      $result_val=mysqli_query($link,"SELECT * FROM tbl_customer1 WHERE cid='$id' ORDER BY id DESC");
      $row_val=mysqli_fetch_array($result_val);
      //GETTING NAME FROM CUSTOMER TABLE
      $result_vals=mysqli_query($link,"SELECT * FROM tbl_customer WHERE id='$id' ORDER BY id DESC");
      $row_vals=mysqli_fetch_array($result_vals);

      $i=1;
      while ($row=mysqli_fetch_array($result)) {
         //GETTING NAME FROM CUSTOMER TABLE
        $result_name=mysqli_query($link,"SELECT * FROM tbl_customer WHERE id='$id'");
        $rowName=mysqli_fetch_array($result_name);
        @$option1.="<tr>
              <td> $i</td>
              <td>$rowName[2]</td>
              <td>".number_format($row[2],2)."</td>
              <td>".number_format($row[3],2)."</td>
              <td>".number_format($row[4],2)."</td>
              <td>".number_format($row[5],2)."</td>
              <td>$row[6]</td>
              <td>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
              </td>
            </tr>";
          $i++;
        }
  }

  //ADDING THE ACCOUNT
  if(isset($_POST['btn_cust'])){
    $sid = htmlentities(ucwords($_POST['sID']));
    $cid = htmlentities(ucwords($_POST['custID']));
    $custName = htmlentities(ucwords($_POST['custName']));
    $open_bal = htmlentities($_POST['open_bal']);
    $open_bal=str_replace(",","", $open_bal);
    $debit = htmlentities($_POST['debit']);
    $debit=str_replace(",","", $debit);
    $credit = htmlentities($_POST['credit']);
    $credit=str_replace(",","", $credit);
    $close_bal = htmlentities($_POST['close_bal']);
    $close_bal=str_replace(",","", $close_bal);

    if($custName==''){
        $div=" <script>
            swal('Please enter a customer name!','','error')
        </script>
        ";
    }
    else{
          $result_bals=mysqli_query($link,"SELECT * FROM tbl_customer1 WHERE cid='$sid'");
          if(mysqli_num_rows($result_bals)>=1){
            @$div="
              <script>
              Swal.fire({
                  title: 'Please you cannot add that customer again with that customer ID: $cid.',
                  text:'Customer Name exist or is added already',
                  icon: 'error',
                  button: 'OK!',
                });
              </script>";
          }
          else{
          $result=mysqli_query($link,"SELECT * FROM tbl_customer ORDER BY id DESC");
          $rowval=mysqli_fetch_array($result);
          $id=$rowval[5]+1;
          $outs = mysqli_query($link,"INSERT INTO tbl_customer (cid,custName,closeBal,postDate,nid) VALUES ('$cid','$custName','$close_bal',now(),'$id')");
          $lastids=mysqli_insert_id($link);
          $outs = mysqli_query($link,"INSERT INTO tbl_customer1 (cid,openBal,deb,cred,closeBal,postDate) VALUES ('$lastids','$open_bal','$debit','$credit','$close_bal',now())");
          $lastid=mysqli_insert_id($link);
          $sqls=mysqli_query($link,"UPDATE tbl_customer1 SET cid='$lastids' WHERE id='$lastid'");
          if($outs){
              $div="<script>
                          swal('New customer account created successfully!','','success')
                          setTimeout(function(){
                            window.location.href='cust-acc?$rand1&%v%&$rand%'
                          },3000)
                          $('#for_customer')[0].reset();
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A new customer account was added on $date by ";
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
  }
  //ADDING INDIVIDUAL ACCOUNT
  if(isset($_POST['btn_cust1'])){
    $id=$_GET['cs'];
    $custName = htmlentities(ucwords($_POST['custName']));
    $open_bal1 = htmlentities($_POST['open_bal1']);
    $open_bal1=str_replace(",","", $open_bal1);
    $debit1 = htmlentities($_POST['debit1']);
    $debit1=str_replace(",","", $debit1);
    $credit1 = htmlentities($_POST['credit1']);
    $credit1=str_replace(",","", $credit1);
    $close_bal1 = htmlentities($_POST['close_bal1']);
    $close_bal1=str_replace(",","", $close_bal1);
          $sqls1=mysqli_query($link,"UPDATE tbl_customer SET closeBal='$close_bal1' WHERE id='$id'");
          $sqls = "INSERT INTO tbl_customer1 (cid,openBal,deb,cred,closeBal,postDate) VALUES ('$id','$open_bal1','$debit1','$credit1','$close_bal1',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
                        swal('Customer details successfully saved!','','success')
                        setTimeout(function(){
                          window.location.href='cust-acc?$rand1&cs=$id&$rand2%'
                        },3000)
                        $('#for_customer')[0].reset();
                    </script>
                    ";
            

            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A customer account details was updated on $date by ";
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

  //UPDATING CUSTOMER ACCOUNT
  /*if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $custName = htmlentities(ucwords($_POST['custName']));
    $open_bal = htmlentities(ucwords($_POST['open_bal']));
    $debit = htmlentities($_POST['debit']);
    $credit = htmlentities(ucwords($_POST['credit']));
    $close_bal = htmlentities($_POST['close_bal']);
    if($custName==''){
        $div=" <script>
            swal('Please enter a customer name!','','error')
        </script>
        ";
    }
    else{
      $sqls=mysqli_query($link,"UPDATE tbl_customer SET custName='$custName',openBal='$open_bal',deb='$debit',cred='$credit',closeBal='$close_bal' WHERE cid='$id'");
        if($sqls){
            $div="<script>
                        swal('Customer account updated successfully!','','success')
                        setTimeout(function(){
                          window.location.href='cust-acc?$rand1&%v%&$rand2%'
                        },3000)
                        $('#for_customer')[0].reset();
                    </script>";
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A Customer account was updated on $date by ";
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
  }*/
  
  // DELETing CUSTOMER ACCOUNT DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_customer where id='$id'");
      mysqli_query($link,"DELETE FROM tbl_customer1 where cid='$id'");
      $div="
      <script>
          swal('Customer account has been Removed Successfully','','success')
          setTimeout(function(){
            window.location.href='cust-acc?$rand1&true&%v%&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A customer account was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

    //GENERATING CUSTOMER ID
    //FETCHING DOCUMENT NUMBER
  $result=mysqli_query($link,"SELECT * FROM tbl_customer ORDER BY id DESC");
  $rowval=mysqli_fetch_array($result);
  $id=$rowval[0];
  $id1=$rowval[5];
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
            <h2 class="display-2 text-white">Add Customer Account Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="cust-acc?<?=$rand1?>&%v%&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-search"></span> View Added Accounts</a>
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
                  <h3 class="mb-0" ><?php echo $list."'s Page"; ?></h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div;?>
              <a href="cust-acc?<?=$rand2?>" class="btn btn-info mb-3" style="float: right;z-index: 99;">Add Account</a>
              <div class="row" <?php if(isset($_GET['%v%'])){echo "style='display:none;'";} if(isset($_GET['cs'])){echo "style='display:none;'";}?>>
              <form id="form_customer" name="form_customer" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="pl-lg-4">
                    <!-- SEARCH NAME -->
                      <label class="form-control-label" for="search_text">Search by Customer Full Name to get customer ID</label>
                      <div class="form-row">
                        <div class="input-group">
                        <input type="text" id="search_text" name="search_text" class="form-control text-uppercase col-4" placeholder="Enter Customer Full Name">
                          <div class="input-group-append">
                            <!-- <span class="input-group-text"><i class='fa fa-search'></i></a></span> -->
                          <button type="button" name="search_btn" id="search_btn" class="btn btn-default"><i class='fa fa-search'></i></button>
                          </div>
                        </div>
                      </div>
                    <div class="col-md-12"><hr></div>
                  <div class="row">
                    <!-- SERIAL ID -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="custID">Serial ID</label>
                        <input type="text" id="sID" name="sID" class="form-control text-uppercase" value="<?php if(isset($_GET['ed'])){echo $row[0];}else{echo @$ids;} ?>" readonly>
                      </div>
                    </div>
                    <!-- CUSTOMER ID -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custID">Customer ID</label>
                        <input type="text" id="custID" name="custID" class="form-control text-uppercase" placeholder="Enter Customer ID" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$cusID;} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                    <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custName">Customer Full Name</label>
                        <input type="text" id="custName" name="custName" class="form-control text-uppercase" placeholder="Enter Customer Full Name" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$custName;} ?>">
                      </div>
                    </div>
                    <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custName">Customer Full Name</label>
                        <input type="text" id="custName" name="custName" class="form-control text-uppercase" placeholder="Enter Customer Full Name" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$custName;} ?>">
                      </div>
                    </div>
                    <!-- OPENING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="open_bal">Opening Balance</label>
                        <input type="text" id="open_bal" name="open_bal" class="form-control text-uppercase" placeholder="Enter Opening Balance" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo "0";} ?>">
                        <input type="hidden" id="open_bals" name="open_bals" class="form-control" maxlength="20">
                      </div>
                    </div>
                   <!-- DEBIT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="debit">Debit</label>
                        <input type="text" id="debit" name="debit" class="form-control text-uppercase" placeholder="Enter Debit" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo "0";} ?>">
                        <input type="hidden" id="debits" name="debits" class="form-control" maxlength="20">
                      </div>
                    </div>
                    <!-- CREDIT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="credit">Credit</label>
                        <input type="text" id="credit" name="credit" class="form-control text-uppercase" placeholder="Enter Credit" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo "0";} ?>">
                        <input type="hidden" id="credits" name="credits" class="form-control" maxlength="20">
                      </div>
                    </div>
                    <!-- CLOSING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="close_bal">Closing Balance</label>
                        <input type="text" id="close_bal" name="close_bal" class="form-control text-uppercase" placeholder="Enter Closing Balance" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo "0";} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                    <!-- DEBIT BALANCE -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="deb_bal">Debit Balance</label>
                        <input type="text" id="deb_bal" name="deb_bal" class="form-control text-uppercase" placeholder="Debit Amount" value="0" readonly>
                      </div>
                    </div>
                    <!-- CREDIT BALANCE -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="cred_bal">Credit Balance</label>
                        <input type="text" id="cred_bal" name="cred_bal" class="form-control text-uppercase" placeholder="Credit Amount" value="0" readonly>
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn_cust" name="btn_cust" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Save Details</button>
                  <?=@$update_btn; ?>
                </div>
              </form><!-- END FORM -->
              </div>

              <!-- DISPLAYING CUSTOMER ACCOUNT DETAIL -->
              <div <?php if(!isset($_GET['%v%'])){echo "style='display:none;'";}?>>
                <h2 class="text-center">Customers Account Added</h2>
                  <table class="table table-hover table-striped table-bordered text-black text-uppercase table-responsive" width="100%" id="example">
                      <th>S/N</th>
                      <th>Customer ID</th>
                      <th>Customer Name</th>
                      <th>Closing Balance</th>
                      <th>Updated On</th>
                      <th>Actions</th>
                    <?=@$option;?>
                  </table>
                  <!--th>S/N</th>
                      <th>Customer Name</th>
                      <th>Opening Balance</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Closing Balance</th>
                      <th>Post Date</th>
                      <th>Actions</th-->
              </div><!-- END DISPLAY -->

              <!-- DISPLAYING INDIVIDUAL ACCOUNT -->
              <div class="col-12" <?php if(!isset($_GET['cs'])){echo "style='display:none;'";}?>>
                <h2 class="col-md-12 text-center"><?=$row_vals[2];?> Full Account Details</h2>
              <form id="form_customers" name="form_customers" action="" method="POST">
                <br>
                <h3 class="heading-small text-muted mb-4 text-center">Last Transactions Made</h3>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custName">Customer Full Name</label>
                        <input type="text" id="custName" name="custName" class="form-control text-uppercase" placeholder="Enter Customer Full Name" maxlength="30" value="<?php if(isset($_GET['cs'])){echo $row_vals[2];}else{echo @$custName;} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                    <!-- OPENING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="open_bal1">Opening Balance</label>
                        <input type="text" id="open_bal1" name="open_bal1" class="form-control" placeholder="Enter Opening Balance" maxlength="20" value="<?php if(isset($_GET['cs'])){echo $row_val[5];}else{echo @$open_bal1;} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                   <!-- DEBIT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="debit1">Debit</label>
                        <input type="text" id="debit1" name="debit1" class="form-control" placeholder="Enter Debit" value="0">
                        <input type="hidden" id="debit1s" name="debit1s" class="form-control" value="0">
                      </div>
                    </div>
                    <!-- CREDIT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="credit1">Credit</label>
                        <input type="text" id="credit1" name="credit1" class="form-control" placeholder="Enter Credit" value="0">
                        <input type="hidden" id="credit1s" name="credit1s" class="form-control" value="0">
                      </div>
                    </div>
                    <!-- CLOSING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="close_bal1">Closing Balance</label>
                        <input type="text" id="close_bal1" name="close_bal1" class="form-control" placeholder="Enter Closing Balance" value="<?php if(isset($_GET['cs'])){echo $row_val[5];}else{echo @$open_bal1;} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                    <!-- DEBIT BALANCE -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="deb_bal1">Debit Balance</label>
                        <input type="text" id="deb_bal1" name="deb_bal1" class="form-control" placeholder="Debit Amount" value="<?php if(isset($_GET['cs'])){echo $row_val[5];}else{echo @$open_bal1;} ?>" readonly>
                      </div>
                    </div>
                    <!-- CREDIT BALANCE -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="cred_bal1">Credit Balance</label>
                        <input type="text" id="cred_bal1" name="cred_bal1" class="form-control" placeholder="Credit Amount" value="<?php if(isset($_GET['cs'])){echo $row_val[5];}else{echo @$open_bal1;} ?>" readonly>
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn_cust1" name="btn_cust1" class="btn btn-warning" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Save Information</button>
                  <button type="submit" id="btn_print" form="print-acc" name="btn_print" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Print Customer Detail</button>
                  <?=@$update_btn; ?>
                </div>
                <hr>
                <div id="" class="col-md-12">
                  <table class="table table-hover table-striped table-bordered text-black text-uppercase table-responsive" width="100%" id="example">
                      <th>S/N</th>
                      <th>Customer Name</th>
                      <th>Opening Balance</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Closing Balance</th>
                      <th>Updated On</th>
                      <th>Actions</th>
                    <?=@$option1;?>
                  </table>
              </div>
              </form>
              <form id="print-acc" name="print-acc" action="print_acc" method="POST">
                <input type="hidden" name="cusid" id="cusid" value="<?php if(isset($_GET['cs'])){echo $row_val[1];} ?>">
              </form>
              <!-- END FORM -->
              </div><!-- END INDIVIDUAL ACCOUNT -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>