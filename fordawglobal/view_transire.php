<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Secretary" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//SELECTING TRANSIRE DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_transire ORDER BY tid DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[4]</td>
          <td>$row[6]</td>
          <td style='white-space:pre-line'>$row[7]</td>
          <td style='white-space:pre-line'>$row[9]</td>
          <td><a href='add_transire?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <a href='view_transire?$rand1&vw=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'><span class='fa fa-search-plus'>&nbsp;View</span></a>
          <a href='print_trans?$rand1&vw=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]'><span class='fa fa-print'>&nbsp;Print</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
          </td>
        </tr>";
    $i++;
    /*<td>$row[7]</td>
          <td>$row[8]</td>*/
  }

  //VIEWING PAGE
  @$_SESSION['vw']=$_GET['vw'];
  if(isset($_GET['vw'])){
    $tittle="Transire Manifest View";
    $vID="print";
    $vw=$_SESSION['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$vw'");
    $resultVal=mysqli_fetch_array($result);
    //GETTING THE CONTAINER NUMBERS
    $results=mysqli_query($link,"SELECT * FROM container_seal WHERE tid='$vw'");
      $i=1;
     while ($rowCon=mysqli_fetch_array($results)) {
        @$viewCon.="<label class='form-control'><span class='text-danger'>Container No. $i:</span> <b>$rowCon[2]</b></label>
        <label class='form-control'><span class='text-danger'>Seal No. $i:</span> <b>$rowCon[3]</b></label>";
        $i++;
     }
  }
  else{
    $tittle="Transire Manifest";
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_transire where tid='$id'");
      mysqli_query($link,"DELETE FROM container_seal where tid='$id'");
      $div="<script>
          swal('Transire has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_transire?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A transire was deleted on $date by ";
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
            <h2 class="display-2 text-white">View Transire Page</h2>
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
              <!--input type="text" name="idView" id="idView"-->
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <form method="POST" name="post_trans" id="post_transire" action="print_trans?<?=$rand1?>">
                  <div class="row text-capitalize">
                  <div class="col-md-6">
                    <label class="form-control"><span class="text-danger">Serial No:</span> <b><?=$resultVal[0];?><input type="hidden" name="tid" value="<?=$resultVal[0];?>"></b></label>
                    <label class="form-control"><span class="text-danger">Bill of lading:</span> <b><?=$resultVal[1];?></b></label>
                    <?=@$viewCon;?>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Name of ship rotation no. & Date:</span> <b><?=$resultVal[2];?></b></label>
                    <label class="form-control"><span class="text-danger">Port of discharge:</span> <b><?=$resultVal[3];?></b></label>
                    <label class="form-control"><span class="text-danger">Country of origin:</span> <b><?=$resultVal[4];?></b></label>
                    <label class="form-control"><span class="text-danger">Fractional Numbering: </span> <b><?=$resultVal[5];?></b></label>
                    <label class="form-control"><span class="text-danger">Type of cont. 20/40:</span> <b><?=$resultVal[6];?></b></label>
                    <!-- <label class="form-control"><span class="text-danger">Container No.:</span> <b><?=$resultVal[7];?></b></label> -->
                  </div>
                  <div class="col-md-6"><!-- 
                    <label class="form-control"><span class="text-danger">Seal No:</span> <b><?=$resultVal[8];?></b></label> -->
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Importers Name:</span> <b><?=$resultVal[7];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Address:</span> <b><?=$resultVal[8];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Description of goods:</span> <b><?=$resultVal[9];?></b></label>
                    <label class="form-control"><span class="text-danger">Weight Net (KG):</span> <b><?=$resultVal[10];?></b></label>
                    <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[11];?></b></label>
                    <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_transire?<?=$rand1?>&&op';"><span class="fa fa-angle-double-left"></span> Back</button>
                    <button type="submit" id="print_trans" name="print_trans" class="btn btn-success">   Proceed to Print</button>
                  </div>
                </div></form>
              </div>
              <?php break; default:;?>
                <div id="tab2">
                  <div class="text-center text-uppercase"><h2>List of Transire Manfiest Added</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase  table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>bill of lading</th>
                      <th>country of origin</th>
                      <th>type of cont. 20/40</th>
                      <th>Importers Name</th>
                      <th>description of goods</th>
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