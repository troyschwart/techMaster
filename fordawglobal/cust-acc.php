<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Accountant" || $list=="Administrator" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
$amt_cha=$credit=$bal=0;
//ACTIVATING THE UPDATE BUTTON
  if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $update_btn="<button type='submit' id='btn_update' name='btn_update' class='btn btn-danger'>Update</button>";
      $result=mysqli_query($link,"SELECT * FROM tbl_cus WHERE id='$id'");
      $row=mysqli_fetch_array($result);
  }
  //FETCHING FROM CUSTOMER TABLE
   if(isset($_GET['%v%'])){
      //$result=mysqli_query($link,"SELECT * FROM tbl_cus1 as c1,tbl_cus as c WHERE c1.cusid=c.cusid ORDER BY c.id DESC");
      $result=mysqli_query($link,"SELECT * FROM tbl_cus1 ORDER BY id DESC");
      $result1=mysqli_query($link,"SELECT SUM(openBal) as ob,SUM(debit) as db,SUM(cred) as cd,SUM(closeBal) as bl FROM tbl_cus1");
      $rows=mysqli_fetch_array($result1);
      $ob=number_format($rows['ob'],2);
      $db=number_format($rows['db'],2);
      $cd=number_format($rows['cd'],2);
      $bl=number_format($rows['bl'],2);
      //$result1=mysqli_query($link,"SELECT * FROM tbl_cus");
      //$result=mysqli_query($link,"SELECT *,SUM(deb) as total FROM tbl_cus GROUP BY cid ORDER BY id DESC");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$option.="<tr>
              <td> $i</td>
              <td>$row[2]</td>
              <td>".number_format($row[3],2)."</td>
              <td>".number_format($row[4],2)."</td>
              <td>".number_format($row[5],2)."</td>
              <td>".number_format($row[6],2)."</td>
              <td>
              <a href='cust-acc?$rand1&cs=$row[1]&$rand2' class='btn btn-default btn-sm' role='button'>View <span class='fa fa-chalkboard-teacher'></span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[1]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
              </td>
            </tr>";
          $i++;
        }
        $option.="<tr><td></td><td><b>TOTALS </b></td><td>$ob</td><td>$db</td><td>$cd</td><td>$bl</td><td></td></tr>";
  }

  //FETCHING INDIVIDUAL ACCOUNT FROM CUSTOMER TABLE
   if(isset($_GET['cs'])){
      $id=$_GET['cs'];
      //GETTING NAME FROM CUSTOMER TABLE
      $result1=mysqli_query($link,"SELECT * FROM tbl_cus WHERE cusid='$id' ORDER BY id DESC");
      $row_=mysqli_fetch_array($result1);
      $prevBal="<label class='form-control-label' for='prevbal' style='display:none;'>Previous Balance</label>
      <input type='text' id='prevbal' name='prevbal' class='form-control text-uppercase' value='$row_[10]' style='pointer-events:none;display:none;'>";
      $submit_btn="<button type='submit' id='submit_btn' name='submit_btn' class='btn btn-danger'>Submit</button>";
      $credBal="<input type='text' id='credBal' name='credBal' class='form-control' maxlength='20' value='$row_[9]' style='display:none;'>";
      $result2=mysqli_query($link,"SELECT *, SUM(amount_cha) as ac,SUM(credits) as cd FROM tbl_cus WHERE cusid='$id'");
      $rows=mysqli_fetch_array($result2);
      $ob=number_format($rows['ac'],2);
      $cd=number_format($rows['cd'],2);
      
      $result3=mysqli_query($link,"SELECT * FROM tbl_cus WHERE cusid='$id' ORDER BY id DESC");
      $rows3=mysqli_fetch_array($result3);
      $bl=number_format($rows3[10],2);
      if($bl>0){
        $bl="<span class='text-success'><b>$bl</b></span>";
      }
      else if($bl<0){
        $bl="<span class='text-danger'><b>$bl</b></span>";
      }
      else{
        $bl=$bl;
      }
      $result=mysqli_query($link,"SELECT * FROM tbl_cus WHERE cusid='$id'");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$option1.="<tr>
              <td> $i</td>
              <td>$row[2]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>".number_format($row[8],2)."</td>
              <td>".number_format($row[9],2)."</td>
              <td>".number_format($row[10],2)."</td>
              <td>
               <a href='cust-acc?$rand1&cs=$row[1]&id=$row[0]&$rand2' class='btn btn-danger btn-sm' role='button'>Delete <span class='fa fa-trash'></span></a>
              </td>
            </tr>";
          $i++;
        }
        $option1.="<tr><td colspan='6' class='text-center'><b>TOTALS </b></td><td>$ob</td><td>$cd</td><td>$bl</td><td></td></tr>";
  }

  //ADDING THE ACCOUNT
  if(isset($_POST['btn_cust'])){
    $sid = htmlentities(ucwords($_POST['sID']));
    $cid = htmlentities($_POST['custID']);
    $tdate = htmlentities($_POST['tdate']);
    $custName = htmlentities(ucwords($_POST['custName']));
    $descr = htmlentities($_POST['descr']);
    $eta = htmlentities($_POST['eta']);
    $size = htmlentities($_POST['size']);
    $tof = htmlentities($_POST['tof']);
    $amt_cha = htmlentities($_POST['amt_cha']);
    $amt_cha=str_replace(",","", $amt_cha);
    $credit = htmlentities($_POST['credit']);
    $credit=str_replace(",","", $credit);
    $bal = htmlentities($_POST['bal']);
    $bal=str_replace(",","", $bal);
    if($tdate==''){
        $div=" <script>
            swal('Please select transaction date!','','error')
        </script>
        ";
    }
    else if($custName==''){
        $div=" <script>
            swal('Please enter a customer name!','','error')
        </script>
        ";
    }
    else if($descr==''){
        $div=" <script>
            swal('Please enter the description!','','error')
        </script>
        ";
    }
    else if($eta==''){
        $div=" <script>
            swal('Please select eta!','','error')
        </script>
        ";
    }
    else if($size==''){
        $div=" <script>
            swal('Please enter the container size!','','error')
        </script>
        ";
    }
    else if($tof==''){
        $div=" <script>
            swal('Please enter type of goods!','','error')
        </script>
        ";
    }
    else{
          $result=mysqli_query($link,"SELECT * FROM tbl_cus1 ORDER BY id DESC");
          $rowval=mysqli_fetch_array($result);
          $id=$rowval[8]+1;
          $res=mysqli_query($link,"SELECT * FROM tbl_cus1 WHERE cusid='$cid'");

          if(mysqli_num_rows($res)==0){
              $outs = mysqli_query($link,"INSERT INTO tbl_cus (cusid,tdate,cusName,descr,eta,size,tof,amount_cha,credits,bal,postDate) VALUES ('$cid','$tdate','$custName','$descr','$eta','$size','$tof','$amt_cha','$credit','$bal',now())"); 
              //$lastids=mysqli_insert_id($link);
              $outs1 = mysqli_query($link,"INSERT INTO tbl_cus1 (cusid,cusName,openBal,cred,closeBal,postDate,nid) VALUES ('$cid','$custName','$credit','$amt_cha','$bal',now(),'$id')");
              if($outs){
                  $div="<script>
                              swal('Customer details saved successfully!','','success')
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
            }//END IF
            else{
                  $outs = mysqli_query($link,"INSERT INTO tbl_cus (cusid,tdate,cusName,descr,eta,size,tof,amount_cha,credits,bal,postDate) VALUES ('$cid','$tdate','$custName','$descr','$eta','$size','$tof','$amt_cha','$credit','$bal',now())"); 
                  $lastids=mysqli_insert_id($link);
                  $sqls=mysqli_query($link,"UPDATE tbl_cus1 SET openBal='$credit',cred='$amt_cha',closeBal='$bal' WHERE cusid='$cid'");
                  if($outs){
                      $div="<script>
                                  swal('Customer details saved successfully!','','success')
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
             
            }//END OF ELSE
      }
  }
  //INDIVIDUAL SUBMITTING
  if(isset($_POST['submit_btn'])){
    $sid = htmlentities(ucwords($_POST['sID']));
    $cid = htmlentities($_POST['custID']);
    $tdate = htmlentities($_POST['tdate']);
    $custName = htmlentities(ucwords($_POST['custName']));
    $descr = htmlentities($_POST['descr']);
    $eta = htmlentities($_POST['eta']);
    $size = htmlentities($_POST['size']);
    $tof = htmlentities($_POST['tof']);
    $amt_cha = htmlentities($_POST['amt_chas']);
    $amt_cha=str_replace(",","", $amt_cha);
    $credit = htmlentities($_POST['credits']);
    $credit=str_replace(",","", $credit);
    $credBal = htmlentities($_POST['credBal']);
    $credBal=str_replace(",","", $credBal);
    $bal = htmlentities($_POST['bal']);
    $bal=str_replace(",","", $bal);
    if($tdate==''){
        $div=" <script>
            swal('Please select transaction date!','','error')
        </script>
        ";
    }
    else if($custName==''){
        $div=" <script>
            swal('Please enter a customer name!','','error')
        </script>
        ";
    }
    else if($descr==''){
        $div=" <script>
            swal('Please enter the description!','','error')
        </script>
        ";
    }
    else if($eta==''){
        $div=" <script>
            swal('Please select eta!','','error')
        </script>
        ";
    }
    else if($size==''){
        $div=" <script>
            swal('Please enter the container size!','','error')
        </script>
        ";
    }
    else if($tof==''){
        $div=" <script>
            swal('Please enter type of goods!','','error')
        </script>
        ";
    }
    else if($amt_cha==''){
          $amt_cha="0";
    }
    else if($credit==''){
        $credit="0";
    }
    else if($credBal==''){
        $credBal="0";
    }
    else{
          $outs = mysqli_query($link,"INSERT INTO tbl_cus (cusid,tdate,cusName,descr,eta,size,tof,amount_cha,credits,bal,postDate) VALUES ('$cid','$tdate','$custName','$descr','$eta','$size','$tof','$amt_cha','$credit','$bal',now())"); 
          $lastids=mysqli_insert_id($link);
          $sqls=mysqli_query($link,"UPDATE tbl_cus1 SET openBal='$credBal',cred='$amt_cha',closeBal='$bal' WHERE cusid='$cid'");
          if($outs){
              $div="<script>
                          swal('Customer details saved successfully!','','success')
                          setTimeout(function(){
                            window.location.href='cust-acc?$rand1&cs=$cid&$rand2'
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

  // DELETing CUSTOMER ACCOUNT DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_cus WHERE cusid='$id'");
      mysqli_query($link,"DELETE FROM tbl_cus1 WHERE cusid='$id'");
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
    //REMOVING CUSTOMERS FROM INDIVIDUAL ACCOUNT
    if(isset($_GET['id'])){
      $id=$_GET['id'];
      $cs=$_GET['cs'];
      mysqli_query($link,"DELETE FROM tbl_cus WHERE id='$id'");
      $div="
      <script>
          swal('This details has been Removed Successfully','','success')
          setTimeout(function(){
            window.location.href='cust-acc?$rand1&true&cs=$cs&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A customer details was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }
    //REMOVING CUSTOMERS WITH ZERO ACCOUNT DETAILS
    if(isset($_POST['btn_remove'])){
      mysqli_query($link,"DELETE FROM tbl_cus1 WHERE openBal='0' AND closeBal='0'");
      $div="
      <script>
          swal('Customer with zero account details has been Removed Successfully','','success')
          setTimeout(function(){
            window.location.href='cust-acc?$rand1&true&%v%&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A customer details was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

    //GENERATING CUSTOMER ID
    //FETCHING DOCUMENT NUMBER
  $result=mysqli_query($link,"SELECT * FROM tbl_cus1 ORDER BY id DESC");
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
            <a href="cust-acc?<?=$rand1?>&%v%&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-search"></span> View Daily Customer Account Balances</a>
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
              <div class="row" <?php if(isset($_GET['%v%'])){echo "style='display:none;'";}?>>
                <div  class="col-12" <?php if(!isset($_GET['cs'])){echo "style='display:none;'";}?>>
                  <h2 class="col-md-12 text-center"><?=$row_[3];?> Full Account Details</h2>
                  <h3 class="heading-small text-muted mb-4 text-center">Last Transactions Made</h3>
                </div>
              <form id="form_customer" name="form_customer" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="pl-lg-4">
                    <!-- SEARCH NAME -->
                    <!--div <?php if(isset($_GET['cs'])){echo "style='display:none;'";}?>>
                      <label class="form-control-label" for="search_text">Search by Customer Full Name to get customer ID</label>
                      <div class="form-row">
                        <div class="input-group">
                        <input type="text" id="search_text" name="search_text" class="form-control text-uppercase col-4" placeholder="Enter Customer Full Name">
                          <div class="input-group-append">
                          <button type="button" name="search_btn" id="search_btn" class="btn btn-default"><i class='fa fa-search'></i></button>
                          </div>
                        </div>
                      </div>
                    </div-->
                  <div class="row mt-5">
                    <!-- SERIAL ID -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="custID">Serial ID</label>
                        <input type="text" id="sID" name="sID" class="form-control text-uppercase" value="<?php if(isset($_GET['ed'])){echo $row[0];}else if(isset($_GET['cs'])){echo $row_[0];}else{echo @$ids;} ?>" readonly>
                      </div>
                    </div>
                    <!-- CUSTOMER ID -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custID">Customer ID</label>
                        <input type="text" id="custID" name="custID" class="form-control text-uppercase" placeholder="Enter Customer ID" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];} else if(isset($_GET['cs'])){echo $row_[1];}else{echo @$cusID;} ?>" style='pointer-events:none;'>
                      </div>
                    </div>
                    <!-- DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tdate">Transaction Date</label>
                        <input type="date" id="tdate" name="tdate" class="form-control text-uppercase" placeholder="Enter Description" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else if(isset($_GET['cs'])){echo $row_[2];}else{echo @$tdate;} ?>">
                      </div>
                    </div>
                    <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="custName">Customer Full Name</label>
                        <input type="text" id="custName" name="custName" class="form-control text-uppercase" placeholder="Enter Customer Full Name" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[3];}else if(isset($_GET['cs'])){echo $row_[3];}else{echo @$custName;} ?>">
                      </div>
                    </div>
                     <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="descr">Description</label>
                        <input type="text" id="descr" name="descr" class="form-control text-uppercase" placeholder="Enter Description" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[4];}else if(isset($_GET['cs'])){echo $row_[4];}else{echo @$descr;} ?>">
                      </div>
                    </div>
                     
                     <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="eta">ETA</label>
                        <input type="date" id="eta" name="eta" class="form-control text-uppercase" placeholder="Enter E.T.A" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[5];}else if(isset($_GET['cs'])){echo $row_[5];}else{echo @$eta;} ?>">
                      </div>
                    </div>
                     <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="size">Container Size</label>
                        <input type="text" id="size" name="size" class="form-control text-uppercase" placeholder="Enter Size" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[6];}else if(isset($_GET['cs'])){echo $row_[6];}else{echo @$size;} ?>">
                      </div>
                    </div>
                     <!-- CUSTOMER FULL NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tof">Type of Goods</label>
                        <input type="text" id="tof" name="tof" class="form-control text-uppercase" placeholder="Enter Type of Goods" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[7];}else if(isset($_GET['cs'])){echo $row_[7];}else{echo @$tof;} ?>">
                      </div>
                    </div>
                    <!-- OPENING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="amt_cha">Amount Charged</label>
                        <input type="text" id="amt_cha" name="amt_cha" class="form-control text-uppercase" placeholder="Enter Amount Charged" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo "0";}?>" <?php if(isset($_GET['cs'])){echo "style='display:none;'";}?>>
                        <input type="text" id="amt_chas" name="amt_chas" class="form-control" maxlength="20" value="0" <?php if(!isset($_GET['cs'])){echo "style='display:none;'";}?>>
                      </div>
                    </div>
                    <!-- CREDIT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="credit">Credit</label>
                        <input type="text" id="credit" name="credit" class="form-control text-uppercase" placeholder="Enter Credit" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{echo "0";}?>" <?php if(isset($_GET['cs'])){echo "style='display:none;'";}?>>
                        <input type="text" id="credits" name="credits" class="form-control" maxlength="20" value="0" <?php if(!isset($_GET['cs'])){echo "style='display:none;'";}?>>
                       <?=@$credBal; ?>
                      </div>
                    </div>
                    <!-- CLOSING BALANCE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bal">Balance</label>
                        <input type="text" id="bal" name="bal" class="form-control text-uppercase" placeholder="Balance" value="<?php if(isset($_GET['ed'])){echo $row[10];}else{echo "0";} ?>" style='pointer-events:none;'>
                        <?=@$prevBal; ?>
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn_cust" name="btn_cust" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} if(isset($_GET['cs'])){echo "style='display:none;'";} ?>>Save Details</button>
                  <button type="submit" id="btn_print" form="print-acc" name="btn_print" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} if(!isset($_GET['cs'])){echo "style='display:none;'";} ?>>Print Customer Detail</button>
                  <?=@$update_btn; ?>
                  <?=@$submit_btn; ?>
                </div>
              </form><!-- END FORM -->
              </div>
              <!-- DISPLAYING INDIVIDUAL ACCOUNT -->
              <div class="col-12 mt-5" <?php if(!isset($_GET['cs'])){echo "style='display:none;'";}?>>
                  <form id="form_customers" name="form_customers" action="" method="POST">
                      <table class="table table-hover table-striped table-bordered text-black text-uppercase table-responsive" width="100%" id="example">
                          <th>S/N</th>
                          <th>Date</th>
                          <th>Description</th>
                          <th>ETA</th>
                          <th>Size</th>
                          <th>Type of Goods</th>
                          <th>Amount Charged</th>
                          <th>Credit</th>
                          <th>Balance</th>
                          <th>Actions</th>
                        <?=@$option1;?>
                      </table>
                  </form>
                  <form id="print-acc" name="print-acc" action="print_acc" method="POST">
                    <input type="hidden" name="cuid" id="cuid" value="<?php if(isset($_GET['cs'])){echo $row_[1];} ?>">
                  </form><!-- END FORM -->
              </div><!-- END INDIVIDUAL ACCOUNT -->

              <!-- DISPLAYING DAILY CUSTOMER ACCOUNT DETAIL -->
              <div <?php if(!isset($_GET['%v%'])){echo "style='display:none;'";}?>>
                <!-- SEARCH NAME -->
                 <form id="form_cus" method="POST">
                    <label class="form-control-label" for="search_text">Search by Customer Full Name to get customer details</label>
                    <div class="form-row mb-5">
                      <div class="input-group">
                      <input type="text" id="search_text" name="search_text" class="form-control col-4" placeholder="Enter Customer Full Name">
                        <div class="input-group-append">
                        <button type="button" name="search_btn" id="search_btn" class="btn btn-default"><i class='fa fa-search'></i></button>
                        </div>
                      </div>
                    </div>
                    </form>
                    <h2 class="text-center">Daily Customers Account Balances as at <?=date("d-m-Y");?></h2>
                  <div id="cus-search">
                    <table class="table table-hover table-striped table-bordered text-black text-uppercase table-responsive" width="100%" id="example">
                        <th>S/N</th>
                        <th>Customer Name</th>
                        <th>Opening Balance</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Closing Balance</th>
                        <th>Actions</th>
                      <?=@$option;?>
                    </table>
                  </div>
                  <div id="cus-search1"></div>
                  <button type="submit" id="btn_remove" name="btn_remove" class="btn btn-danger mt-3" style="display:none;">Remove customers with zero account</button>
              </div><!-- END DISPLAY -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>