<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Shipping Manager" || $list=="Administrator"){?>
  
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
$result=mysqli_query($link,"SELECT * FROM tbl_cusexam ORDER BY cid DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
        $cpc=$row[3];
        $duty=$row[4];
        $settle=$row[5];
        $port=$row[6];
        $naf=$row[7];
        $son=$row[8];
        $other=$row[9];
        @$total=$cpc+$duty+$settle+$port+$naf+$son+$other;
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>".number_format($row[3],2)."</td>
          <td>".number_format($row[4],2)."</td>
          <td>".number_format($row[5],2)."</td>
          <td>".number_format($row[6],2)."</td>
          <td>".number_format($row[7],2)."</td>
          <td>".number_format($row[8],2)."</td>
          <td>$row[9]</td>
          <td>".number_format($row[10],2)."</td>
          <td>".number_format($total,2)."</td>
          <td>$row[11]</td>
          <td><a href='custom-exam?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
          </td>
        </tr>";
    $i++;
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $result=mysqli_query($link,"SELECT * FROM tbl_cusexam WHERE cid='$id'");
      $rowd=mysqli_fetch_array($result);
      mysqli_query($link,"DELETE FROM tbl_cusexam WHERE cid='$id'");
      $ref_update=mysqli_query($link,"UPDATE tbl_invest SET cpc='0',duty='0',settle='0',term='0',naf='0',son='0',typeGood='',others='0' WHERE blNo='$rowd[1]' AND conNo='$rowd[2]'");
      $div="<script>
          swal('details inserted on Amount invested has been Reset to zero (0) Successfully','','success')
          setTimeout(function(){
          window.location.href='view_ce?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" Custom examination was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
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
            <h2 class="display-2 text-white">View Custom Examination Page</h2>
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
                  <h3 class="mb-0"><?php echo $list;?></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
                <div id="tab3">
                  <div class="text-center text-uppercase" id="ex"><h2>List of Custom Examination</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive ex" width="100%" id="example2">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>CPC/DTI</th>
                      <th>Duty Payable</th>
                      <th>Custom Settlement</th>
                      <th>Port Service Charges</th>
                      <th>NAFDAC</th>
                      <th>SON</th>
                      <th>Type of Goods</th>
                      <th>Others</th>
                      <th>Total</th>
                      <th>Posted on</th>
                      <th>Actions</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE3 DETAILS -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>