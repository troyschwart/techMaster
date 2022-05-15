<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Secretary" || $list=="Administrator" || $list=="Accountant" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
$continue=false;
//SELECTING EXPENSES DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_expen ORDER BY id DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>".number_format($row[3],2)."</td>
          <td>$row[4]</td>
          <td><a href='expenses?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_expense'>Edit <span class='fa fa-edit'></span></a>
          <a href='print_exp?$rand1&vw=$row[1]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'>Print <span class='fa fa-print'></span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }
  if(isset($_POST['btn_search_ex'])){
    $continue=true;
    @$fdate = htmlentities(date('Y-m-d',strtotime($_POST['from_date'])));
    @$tdate = htmlentities(date('Y-m-d',strtotime($_POST['to_date'])));
    $result=mysqli_query($link,"SELECT * FROM tbl_expen WHERE dates BETWEEN '$fdate' AND '$tdate'");
    $result_=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen WHERE dates BETWEEN '$fdate' AND '$tdate'");
    $row_t=mysqli_fetch_array($result_);
    $total3=$row_t['total'];
    if($fdate>$tdate){
      $div="<script>
                  swal('Please do not do that again!','Enter the dates properly','warning')
              </script>
              ";
    }
    else{
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$option1.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td><a href='expenses?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_expense'>Edit <span class='fa fa-edit'></span></a>
              <a href='print_exp?$rand1&vw=$row[1]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'>Print <span class='fa fa-print'></span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
              </td>
            </tr>";
        $i++;
      }
    }
  }
  //VIEWING PAGE
  @$_SESSION['vw']=$_GET['vw'];
  if(isset($_GET['vw'])){
    $tittle="Daily Expenses View";
    $vID="print";
    $vw=$_SESSION['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_expen WHERE id='$vw'");
    $resultVal=mysqli_fetch_array($result);
  }
  else{
    $tittle="Office Daily Expenses";
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_expen where id='$id'");
      $div="<script>
          swal('Daily expenses has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_expenses?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A daily expenses was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }
    //CALCULATING EXPENSES
     $tdates=date("Y-m-d");
      $result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen WHERE dates='$tdates'");
      $row_t=mysqli_fetch_array($result_t);
      $total=$row_t['total'];
      if($total==0){
          $total=0;
      }

    $m=date('m');
    $y=date('Y');
    $dates=cal_days_in_month(CAL_GREGORIAN, $m, $y);
    $fday="$y-$m-01";
    $tday="$y-$m-$dates";
    /*$dd=date('Y-m-d',  strtotime($fday));
    $day=date('Y-m-d',  strtotime($tday));*/
    //$dates."<br>"; echo $fday."<br>"; echo $tday."<br>";

    //CALCULATING EXPENSES
      $result_=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen WHERE dates BETWEEN '$fday' AND '$tday'");
      $row_=mysqli_fetch_array($result_);
      $total2=$row_['total'];
      if($total2==0){
          $total2=0;
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
            <h2 class="display-2 text-white">View Daily Expenses Page</h2>
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
                <div class="col-12">
                  <h3 class="mb-0"><?=$tittle;?> </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div;?>
              <div class="">
                
              </div>
              <label class="form-control col-md-5 ml-5"><b class="text-danger">Today's total expenses</b> = <b><s style='text-decoration-style:double;'> N</s><?=number_format(@$total,2)?></b></label>
               <label class="form-control col-md-5 ml-5"><b class="text-danger">Total expenses this month (<?=date('F')?>)</b> = <b><s style='text-decoration-style:double;'> N</s><?=number_format(@$total2,2)?></b></label>
               <label class="form-control col-md-5 ml-5" <?php if($continue!=true){echo "style='display:none;'";}?>><b class="text-danger">Total expenses checked for</b> = <b><s style='text-decoration-style:double;'> N</s><?=number_format(@$total3,2)?></b></label><br>
               <form method="POST" name="post_e" id="post_e" action="">
                <div class="row ml-5 mb-5">
                  <div class="col-4">
                      <label class="form-control-label" for="from_date">From Date</label>
                      <input type="date" id="from_date" name="from_date" class="form-control text-uppercase" value="">
                  </div>
                  <div class="col-4">
                      <label class="form-control-label" for="to_date">To Date</label>
                      <input type="date" id="to_date" name="to_date" class="form-control text-uppercase" value="">
                  </div>
                  <div class="col-4" style="margin-top:2rem;">
                      <button type="submit" class="btn btn-danger" id="btn_search_ex" name="btn_search_ex">Search</button>
                  </div>
                </div>
               </form>
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <form method="POST" name="view_exp" id="view_exp" action="print_exp?<?=$rand1?>">
                    <div class="row text-capitalize">
                    <div class="col-md-6">
                      <label class="form-control"><span class="text-danger">Serial No:</span> <b><?=$resultVal[0];?><input type="hidden" name="id" value="<?=$resultVal[0];?>"></b></label>
                      <label class="form-control"><span class="text-danger">Dates:</span> <b><?=$resultVal[1];?></b></label>
                      <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Description:</span> <b><?=$resultVal[2];?></b></label>
                      <label class="form-control"><span class="text-danger">Amount:</span> <b><?=$resultVal[3];?></b></label>
                      <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[4];?></b></label>
                    </div>
                    <div class="col-md-12 text-center mt-3">
                      <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_expenses?<?=$rand1?>&&op';"><span class="fa fa-angle-double-left"></span> Back</button>
                        <button type="submit" id="print_exp" name="print_exp" class="btn btn-success">   Proceed to Print</button></div>
                    </div>
                  </form>
              </div>
              <?php break; default:;?>
                <div id="tab2" <?php if($continue==true){echo "style='display:none;'";}?>>
                  <div class="text-center text-uppercase"><h2>List of Daily Expenses Added</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Dates</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Posted on</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE DETAILS -->
                <!-- TABLE SEARCH DISPLAY -->
                <div id="tab3" <?php if($continue!=true){echo "style='display:none;'";}?>>
                  <div class="text-center text-uppercase"><h2>List of Daily Expenses From <?=$fdate?> To <?=$tdate?> </h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Dates</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Posted on</th>
                      <th>Action</th>
                    </thead>
                    <?= @$option1;?>
                  </table>
                </div><!-- END TABLE DETAILS -->
              <?php }?>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>