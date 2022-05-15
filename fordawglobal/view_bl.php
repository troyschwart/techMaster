<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Shipping Manager" || $list=="Administrator" || $list=="Releasing Officer"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//SELECTING BL DETAILS
  // FOR SHIPPING MANAGER
//$result=mysqli_query($link,"SELECT * FROM tbl_bill ORDER BY bid DESC");
$result=mysqli_query($link,"SELECT * FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid=cn.bid ORDER BY bl.blDate");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
  $bl_date=date('d-m-Y',  strtotime($row[1]));
  $dvery=$row[14];
  $moving=$row[22];

  //VALIDATING EXPIRED DATES
  $exp_date=$row[15];
  $today_date=date('Y-m-d');
  //Converting Dates to strings
  $td=strtotime($today_date);
  $exp=strtotime($exp_date);
  //Now Comparing by using logic
  if($td==$exp){
        $diff=$td-$exp;
        $values=abs(floor($diff/(60*60*24)));
        $remDays="<i class='text-danger days'>Order expires today</i> <div class='fa fa-circle text-success wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div><i>";
    }
    else if($td>$exp){
      $diff=$td-$exp;
      $val=abs(floor($diff/(60*60*24)));
      
      if($val==1){
        $remDays="<i class='text-danger days'>$val day exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
      }
      
      else {
          $remDays="<i class='text-danger days'>$val days exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
      }
    }
    else{
        $diff=$td-$exp;
        $val=abs(floor($diff/(60*60*24)));
        
        if($val==1){
          $remDays="<i class='text-success days'>$val day Left</i>";
        }
        else {
          $remDays="<i class='text-success days'>$val days Left</i>";
        }
      }
    //CHECKING WHEN NO DATE IS ENTERED
    if($exp_date==null){
      $remDays="<i class='text-danger days'>No expire date entered</i>";
    }
    //CHECKING DELIVERY ORDER UPLOADED
    if($dvery==null){
        $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
    }
    else{
        $dery_="<a href='$row[14]' target='_blank'> view upload<i class='fa fa-check-circle text-success'></i></a>";
    }
    //CHECKING IF BL HAS BEEN MOVED
    if($moving=="0"){
      $moveStatus="<i class='fa fa-times-circle text-danger'></i>";
    }
    else{
      $moveStatus="<i class='fa fa-check-circle text-success'></i>";
    }
    @$options.="<tr>
          <td> $i</td>
          <td>$bl_date</td>
          <td>$row[2]</td>
          <td>$row[21]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
          <td>$row[5]</td>
          <td>$row[6]</td>
          <td>$row[8]</td>
          <td>$row[9]</td>
          <td>$row[10]</td>
          <td>$row[11]</td>
          <td>$row[12]</td>
          <td>$row[13]</td>
          <td>$dery_</td>
          <td>$row[15]</td>
          <td>$remDays</td>
          <td>$moveStatus</td>
          <td>$row[18]</td>
          <td><a href='view_bl?$rand1&&id=$row[0]&cid=$row[19]&$rand2' class='btn btn-warning btn-sm' role='button' id='update_trans'>Move <span class='fa fa-angle-double-right'></span></a>
          <a href='add_bl?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <a href='view_bl?$rand1&vw=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'><span class='fa fa-search-plus'>&nbsp;View</span></a>
          <a href='print_bl?$rand1&vw=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'><span class='fa fa-print'>&nbsp;Print</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
          </td>
        </tr>";
    $i++;
  }

  //FOR RELEASING OFFICER
  //$result=mysqli_query($link,"SELECT * FROM tbl_bill ORDER BY bid DESC");
  $result=mysqli_query($link,"SELECT * FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid=cn.bid ORDER BY bl.blDate");
    $j=1;
   while ($row=mysqli_fetch_array($result)) {
    $eta_date=date('d-m-Y',  strtotime($row[6]));
    $dvery=$row[14];

     //VALIDATING EXPIRED DATES
    $exp_date=$row[15];
    $today_date=date('Y-m-d');
    //Converting Dates to strings
    $td=strtotime($today_date);
    $exp=strtotime($exp_date);
    //Now Comparing by using logic
    if($td==$exp){
          $diff=$td-$exp;
          $values=abs(floor($diff/(60*60*24)));
          $remDays="<i class='text-danger days'>Order expires today</i> <div class='fa fa-circle text-success wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div><i>";
      }
      else if($td>$exp){
        $diff=$td-$exp;
        $val=abs(floor($diff/(60*60*24)));
        
        if($val==1){
          $remDays="<i class='text-danger days'>$val day exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
        }
        
        else {
          $remDays="<i class='text-danger days'>$val days exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
          
        }
      }
      else{
          $diff=$td-$exp;
          $val=abs(floor($diff/(60*60*24)));
          
          if($val==1){
            $remDays="<i class='text-success days'>$val day Left</i>";
          }
          else {
            $remDays="<i class='text-success days'>$val days Left</i>";
          }
        }
      if($exp_date==null){
        $remDays="<i class='text-danger days'>No expire date entered</i>";
      }
    if($dvery==null){
        $dery="Not uploaded <i class='fa fa-times-circle text-danger'></i><br><a href='delivery?$rand1&ed=$row[0]&$rand2' class='btn btn-default btn-sm' role='button'>upload</a>";
    }
    else{
        $dery="<a href='$row[14]' target='_blank'> view upload <i class='fa fa-check-circle text-success'></i></a>";
    }
    @$options1.="<tr>
          <form id='form_invoice' name='form_invoice' action='add_invoice?$rand2' method='POST'>
          <td> $j</td>
          <td><input type='hidden' id='bNo' name='bNo' value='$row[0]'><button type='submit' id='btn_inv' name='btn_inv' class='btn btn-success btn-sm'>$row[2]</button></td>
          <td>$row[21]</td>
          <td>$row[3]</td>
          <td>$row[5]</td>
          <td>$eta_date</td>
          <td>$row[13]</td>
          <td>$dery</td>
          <td>$row[15]</td>
          <td>$remDays</td>
          </form>
        </tr>";
    $j++;
  }

  //VIEWING PAGE
  if(isset($_GET['vw'])){
    $tittle="View of Full Details of Bill of Lading";
    $vID="print";
    //$vw=$_SESSION['vw'];
    $vw=$_GET['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE bid='$vw'");
    $resultVal=mysqli_fetch_array($result);
    $dvery=$resultVal[14];

    //VALIDATING EXPIRED DATES
    $exp_date=$resultVal[15];
    $today_date=date('Y-m-d');
    //Converting Dates to strings
    $td=strtotime($today_date);
    $exp=strtotime($exp_date);
    //Now Comparing by using logic
    if($td==$exp){
          $diff=$td-$exp;
          $values=abs(floor($diff/(60*60*24)));
          $remDays1="<i class='text-danger days'>Order expires today</i> <div class='fa fa-circle text-success wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div><i>";
      }
      else if($td>$exp){
        $diff=$td-$exp;
        $val=abs(floor($diff/(60*60*24)));
        
        if($val==1){
          $remDays1="<i class='text-danger days'>$val day exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
        }
        
        else {
          $remDays1="<i class='text-danger days'>$val days exceeded</i> <div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
          
        }
      }
      else{
          $diff=$td-$exp;
          $val=abs(floor($diff/(60*60*24)));
          
          if($val==1){
            $remDays1="<i class='text-success days'>$val day Left</i>";
          }
          else {
            $remDays1="<i class='text-success days'>$val days Left</i>";
          }
        }
      if($dvery==null){
        $derys="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
      }
      else{
          $derys="<a href='$resultVal[14]' target='_blank'> view upload <i class='fa fa-check-circle text-success'></i></a>";
      }
      //GETTING THE CONTAINER NUMBERS
      $results=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$vw'");
        $i=1;
       while ($rowCon=mysqli_fetch_array($results)) {
          @$viewCon.="<label class='form-control'><span class='text-danger'>Container No. $i:</span> <b>$rowCon[2]</b></label>";
          $i++;
       }
  }
  else{
    $tittle="Bill of Lading";
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_bill where bid='$id'");
      mysqli_query($link,"DELETE FROM tbl_containers WHERE bid='$id'");
      $div="
      <script>
          swal('Bill of Lading has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_bl?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A Bill of Landing was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

    //CHECKING WITH DATE
    if(isset($_POST['check_bl_date'])){
        $datefrom=htmlentities($_POST['date_bl_from']);
        $dateto=htmlentities($_POST['date_bl_to']);
        $_SESSION['Dfrom']=$datefrom;
        $_SESSION['Dto']=$dateto;
        header("location:print_bl?$rand2&date_checker&$rand1");
    }
    if(isset($_GET['null'])){
    $div="<script>
          swal('Nothing to print for now','Try Again','warning')
          setTimeout(function(){
            window.location.href='view_bl?$rand2&'
          },5000)
      </script>";
  }
  //COPYING TO THE PROGRSSIVE TABLE
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $cid=$_GET['cid'];
    $sql_copy=mysqli_query($link,"INSERT INTO tbl_prog (datee,blNo,conNo,size,customerName,typeGoods,consig,eta,releas,paar,terminal,postDate) SELECT bl.blDate,bl.blNo,cn.containerNo,bl.size,bl.customerName,bl.debitNote,bl.consign,bl.eta,bl.releaseStatus,bl.paar,bl.placeExam,bl.postDate FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid='$id' AND cn.sid='$cid'");
          if($sql_copy){
            @$div="<script>
                      swal('Successfully moved to progressive report','','success')
                      setTimeout(function(){
                        window.location='view_bl?$rand1&success&$rand2'
                        },3000)
                  </script>";
              $ref_update=mysqli_query($link,"UPDATE tbl_containers SET status='1' WHERE sid='$cid'");
      }
   }
?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <style type="text/css">
      .days{
        font-weight: bold;
      }
    </style>
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center mt--5">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">View Bill of Lading Page</h2>
            <button type="button" id="print_bl" name="print_bl" class="btn btn-success" data-toggle='modal' data-target='#modal_bl' <?php if($list=="Releasing Officer" | ($list=="Administrator" & isset($_GET['1']))){echo "style='display:none;'";}?>><span class="fa fa-print"></span> Print BL's</button>
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
                  <h3 class="mb-0"><?php if($list=="Releasing Officer" | ($list=="Administrator" & isset($_GET['1']))){echo "BL Numbers Details";}else{echo $tittle;}?></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
              <h4 class="row" <?php if($list=="Releasing Officer" | ($list=="Administrator" & isset($_GET['1']))){}else{echo "style='display:none;'";}?>><div class="col-xs-1 col-md-1 text-danger" style="font-size:1.5rem;">*</div> <div class="col-xs-9 col-md-9 ml--5">Please click on the BL Numbers to insert invoices amount on it. <span class="fa fa-chalkboard-teacher"></span></div></h4>
              <!-- SEARCH BL NUMBER -->
                  <label class="form-control-label" for="search_text">Search for a container using a BL number </label>
                  <div class="form-row mb-5">
                    <div class="input-group">
                    <input type="text" id="search_bl" name="search_bl" class="form-control text-uppercase col-4" placeholder="Enter BL Number here">
                      <div class="input-group-append">
                      <button type="button" name="search_btn_bl" id="search_btn_bl" class="btn btn-info"><i class='fa fa-search'></i></button>
                      </div>
                      <button type="button" class="btn btn-warning ml-5" onclick="window.location='view_bl?ref=<?=$rand1?>&'"> Refresh <span class="fa fa-sync"></span> </button>
                    </div>
                  </div>
                  <div id="success_"></div>
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <h5 class="row"><div class="col-xs-1 col-md-1 text-danger" style="font-size:1.5rem;">*</div> <div class="col-xs-9 col-md-9 ml--5">Open Delivery Order by clicking on the pdf file &raquo;</div></h5>
                  <form method="POST" name="view_bl" id="view_bl" action="">
                  <div class="row text-uppercase">
                  <div class="col-md-6">
                    <label class="form-control"><span class="text-danger">Serial No:</span> <b><?=$resultVal[0];?><input type="hidden" name="bid" value="<?=$resultVal[0];?>"></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Bill Date:</span> <b><?=$resultVal[1];?></b></label>
                    <label class="form-control"><span class="text-danger">Customer Name:</span> <b><?=$resultVal[4];?></b></label>
                    <label class="form-control"><span class="text-danger">BL Number:</span> <b><?=$resultVal[2];?></b></label>
                    <?=@$viewCon;?>
                    <label class="form-control"><span class="text-danger">Consignee's Name:</span> <b><?=$resultVal[12];?></b></label>
                    <label class="form-control"><span class="text-danger">Container Size: </span> <b><?=$resultVal[3];?></b></label>
                    <label class="form-control"><span class="text-danger">Bill of Lading Status:</span> <b><?=$resultVal[5];?></b></label>
                    <label class="form-control"><span class="text-danger">Exact Time of Arrival:</span> <b><?=$resultVal[6];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">PAAR:</span> <b><?=$resultVal[8];?></b></label>
                  </div>

                  <div class="col-md-6">
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Type of item(goods):</span> <b><?=$resultVal[9];?></b></label>
                    <label class="form-control"><span class="text-danger">Place of Examination:</span> <b><?=$resultVal[10];?></b></label>
                     <label class="form-control"><span class="text-danger">Port of Discharge:</span> <b><?=$resultVal[11];?></b></label>
                    <label class="form-control"><span class="text-danger">Release Status:</span> <b><?=$resultVal[13];?></b></label>
                    <label class="form-control"><span class="text-danger">Delivery Order:</span> <b><?=$derys;?></b></label>
                    <label class="form-control"><span class="text-danger">Delivery Expiration:</span> <b><?=$resultVal[15];?></b></label>
                    <label class="form-control"><span class="text-danger">Delivery Status:</span> <b><?=$remDays1;?></b></label>
                    <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[18];?></b></label>
                    <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_bl?<?=$rand1?>';"><span class="fa fa-angle-double-left"></span> Back</button>
                    <button type="button" id="print_bl" name="print_bl" class="btn btn-success" onclick="window.location='print_bl?<?=$rand?>&vw=<?=$vw?>&<?=$rand1?>'">   Proceed to Print</button>
                  </div>
                </div>
              </form>
              </div>
              <?php break; default:;?>
                <div id="tab2" <?php if($list=="Releasing Officer" | ($list=="Administrator" & isset($_GET['1']))){echo "style='display:none;'";}else{}?>>
                  <button type="button" class="btn btn-warning btn-sm" id="" name="" onclick="window.location='add_bl?<?=$rand1?>'" <?php if($list!="Administrator"){echo "style='display:none'";} ?>><span class="fa fa-plus"></span> Add New BL</button>
                  <h3 class="text-uppercase"><i class="fa fa-asterisk text-danger"></i> Click on move button to move BL to progressive report</h3>
                  <div class="text-center text-uppercase"><h2>List of BL's Added</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Date of bill</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Container Size</th>
                      <th>customer Name</th>
                      <th>Bill of lading Status</th>
                      <th>E.T.A</th>
                      <th>PAAR</th>
                      <th>Type of items/goods</th>
                      <th>Place of Exam</th>
                      <th>Port of discharge</th>
                      <th>Consignee</th>
                      <th>Release Status</th>
                      <th>Delivery Order</th>
                      <th>Delivery Expiration</th>
                      <th>Expiration Status</th>
                      <th>Move Status</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE2 DETAILS -->
                <div id="tab3" <?php if($list=="Releasing Officer" | ($list=="Administrator" & isset($_GET['1']))){}else{echo "style='display:none;'";}?>>
                  
                  <div class="text-center text-uppercase" id="ex"><h2>List of BL's Numbers</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive ex" width="100%" id="example2">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Size</th>
                      <th>Document Status</th>
                      <th>E.T.A</th>
                      <th>Release Status</th>
                      <th>Delivery Order</th>
                      <th>Delivery Expiration</th>
                      <th>Expiration Status</th>
                    </thead>
                    <?= @$options1;?>
                  </table>
                </div><!-- END TABLE3 DETAILS -->
              <?php }?>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>