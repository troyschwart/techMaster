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
//SELECTING TRANSIRE DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_invest ORDER BY sn DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[21]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
          <td>$row[5]</td>
          <td>$row[6]</td>
          <td>$row[7]</td>
          <td>$row[8]</td>
          <td>$row[9]</td>
          <td>$row[10]</td>
          <td>$row[11]</td>
          <td>$row[12]</td>
          <td>".number_format($row[13],2)."</td>
          <td>".number_format($row[14],2)."</td>
          <td>".number_format($row[15],2)."</td>
          <td>".number_format($row[16],2)."</td>
          <td>".number_format($row[17],2)."</td>
          <td>$row[18]</td>
          <td>".number_format($row[19],2)."</td>
          <td>$row[20]</td>
          <td><a href='add_invest?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'>Edit <span class='fa fa-edit'></span></a>
          <a href='view_invest?$rand1&vw=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'>View <span class='fa fa-search-plus'></span></a>
          <a href='print_invest?$rand1&vw=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'>Print <span class='fa fa-print'></span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }

  //VIEWING PAGE
  @$_SESSION['vw']=$_GET['vw'];
  if(isset($_GET['vw'])){
    $tittle="Outstanding Jobs View";
    $vID="print";
    $vw=$_SESSION['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE sn='$vw'");
    $resultVal=mysqli_fetch_array($result);

    //USING BL TO GET CONTAINER NUMBER
    /*$result1=mysqli_query($link,"SELECT * FROM tbl_invest WHERE sn='$vw'");
    $res=mysqli_fetch_array($result1);
    //GETTING THE CONTAINER NUMBERS
    $results=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$res[1]'");
      $i=1;
     while ($rowCon=mysqli_fetch_array($results)) {
        @$viewCon.="<label class='form-control'><span class='text-danger'>Container No. $i:</span> <b>$rowCon[2]</b></label>";
        $i++;
     }*/
  }
  else{
    $tittle="Outstanding Jobs";
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_invest where sn='$id'");
      $div="<script>
          swal('Amount investment has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_invest?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" An amount investment was deleted on $date by ";
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
            <h2 class="display-2 text-white">View Amount Investment Page</h2>
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
              <div id="success_msg"></div><?=@$div?>
                <div class="col-md-12 text-center">
                  <form method="POST" id="checks" name="checks" action="print_invest?<?=$rand1?>"><button type="submit" id="print_invest_btn" name="print_invest_btn" class="btn btn-danger mb-5">   Print investment sheet <i class="fa fa-print"></i></button></form></div>
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <form method="POST" name="print_invest" id="print_invest" action="print_invest?<?=$rand1?>">
                  <div class="row text-capitalize">
                  <div class="col-md-6">
                    <label class="form-control"><span class="text-danger">Serial No:</span> <b><?=$resultVal[0];?></b><input type="hidden" name="sn" value="<?=$resultVal[0];?>"></label>
                    <label class="form-control"><span class="text-danger">BL Number:</span> <b><?=$resultVal[1];?></b></label>
                    <label class="form-control"><span class="text-danger">Container Number:</span> <b><?=$resultVal[21];?></b></label>
                    <!-- <?=@$viewCon;?> -->
                    <label class="form-control"><span class="text-danger">Size:</span> <b><?=$resultVal[2];?></b></label>
                    <label class="form-control"><span class="text-danger">E.T.A:</span> <b><?=$resultVal[3];?></b></label>
                    <label class="form-control"><span class="text-danger">Registration Date:</span> <b><?=$resultVal[4];?></b></label>
                    <label class="form-control"><span class="text-danger">Type of Goods: </span> <b><?=$resultVal[5];?></b></label>
                    <label class="form-control"><span class="text-danger">Customer Name:</span> <b><?=$resultVal[6];?></b></label>
                    <label class="form-control"><span class="text-danger">Advice:</span> <b><?=$resultVal[7];?></b></label>
                    <label class="form-control"><span class="text-danger">Container Deposit:</span> <b><?=$resultVal[8];?></b></label>
                    <label class="form-control"><span class="text-danger">Shipping:</span> <b><?=$resultVal[9];?></b></label>
                    <label class="form-control"><span class="text-danger">Terminal:</span> <b><?=$resultVal[10];?></b></label>
                  </div>
                  <div class="col-md-6">
                    <label class="form-control"><span class="text-danger">Transport:</span> <b><?=$resultVal[11];?></b></label>
                    <label class="form-control"><span class="text-danger">PAAR:</span> <b><?=$resultVal[12];?></b></label>
                    <label class="form-control"><span class="text-danger">CPC/DTI:</span> <b><?=number_format($resultVal[13],2);?></b></label>
                    <label class="form-control"><span class="text-danger">Duty Payable:</span> <b><?=number_format($resultVal[14],2);?></b></label>
                    <label class="form-control"><span class="text-danger">Settlement:</span> <b><?=number_format($resultVal[15],2);?></b></label>
                    <label class="form-control"><span class="text-danger">NAFDAC:</span> <b><?=number_format($resultVal[16],2);?></b></label>
                    <label class="form-control"><span class="text-danger">SON:</span> <b><?=number_format($resultVal[17],2);?></b></label>
                    <label class="form-control"><span class="text-danger">Others:</span> <b><?=$resultVal[18];?></b></label>
                    <label class="form-control"><span class="text-danger">Totals:</span> <b><?=number_format($resultVal[19],2);?></b></label>
                    <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[20];?></b></label>
                    <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_invest?<?=$rand1?>&&op';"><span class="fa fa-angle-double-left"></span> Back</button>
                    <!-- <button type="submit" id="print_invest" name="print_invest" class="btn btn-success">   Proceed to Print</button> -->
                    <!-- <form id="print-acc" name="print-acc" action="print_acc" method="POST">
                      <input type="hidden" name="cusid" id="cusid" value="<?php if(isset($_GET['cs'])){echo $row_val[1];} ?>">
                    </form> -->
                  </div>
                </div></form>
              </div>
              <?php break; default:;?>
                <div id="tab2">
                  <div class="text-center text-uppercase"><h2>List of Amount Investment Added</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase  table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container No</th>
                      <th>Size</th>
                      <th>E.T.A</th>
                      <th>Registration Date</th>
                      <th>Type of Goods</th>
                      <th>Customer Name</th>
                      <th>Advice</th>
                      <th>Container Deposit</th>
                      <th>Shipping</th>
                      <th>Terminal</th>
                      <th>Transport</th>
                      <th>Paar</th>
                      <th>CPC/DTI</th>
                      <th>Duty Payable</th>
                      <th>Settlement</th>
                      <th>NAFDAC</th>
                      <th>SON</th>
                      <th>Others</th>
                      <th>Totals</th>
                      <th>Posted on</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE DETAILS -->
              <?php }?>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>