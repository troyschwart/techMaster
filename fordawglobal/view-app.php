<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Administrator" || $list=="Accountant"  | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
 //SELECTING  APPROVAL DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_approval ORDER BY apid DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    $app=$row[4];
    $sendID=$row[3];
    $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$sendID'");
    $getName=mysqli_fetch_array($retval1);
    if($list=="Manager" | $list=="Administrator"){
        if($app==0){
        $app="<a href='view-app?u=$row[0]&$rand2&s=$row[4]' class='btn btn-warning btn-sm' name='app-btn' id='app-btn'>Pending <span class='fa fa-times-circle'></span> </a>";
        }
        else{
          $app="<a href='view-app?u=$row[0]&$rand2&s=$row[4]' class='btn btn-success btn-sm' name='app-btn' id='app-btn'>Approved <span class='fa fa-check-circle'></span></a>";
        }
    }
    else{
      if($app==0){
        $app="<span class='fa fa-times-circle text-warning'> Pending approval</span> ";
        }
        else{
          $app=" <span class='fa fa-check-circle text-success'> Approved </span> ";
        }
    }
    
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td style='white-space:pre;'>$row[2]</td>
          <td>$getName[4]</td>
          <td>$app</td>
          <td>$row[5]</td>
          <td>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }
  //APPROVING THE MESSAGES
  if(isset($_GET['u'])){
      $ui=$_GET['u'];
      $s=$_GET['s'];
      if($s==0){
          $ref_update=mysqli_query($link,"UPDATE tbl_approval SET status='1' WHERE apid='$ui'");
          $div="<script>
                    swal('Request have been approved successfully!','','success')
                    setTimeout(function(){
                  window.location.href='view-app?$rand1'
                  },3000)
                </script>
                ";
          if($ref_update){
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" Request was approved on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
          }
      }
      else{
          $ref_update=mysqli_query($link,"UPDATE tbl_approval SET status='0' WHERE apid='$ui'");
          $div="<script>
                    swal('Request not approved!','','success')
                    setTimeout(function(){
                  window.location.href='view-app?$rand1'
                  },3000)
                </script>
                ";
          if($ref_update){
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" Request was set on pending on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
          }
      }
  }

  // DELETE DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $result=mysqli_query($link,"SELECT * FROM tbl_approval WHERE apid='$id'");
      $div="<script>
          swal('Request has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view-app?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A Request details was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

    $ref_update=mysqli_query($link,"UPDATE tbl_approval SET notify='1'");
?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center mt--5">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">View Approval's Page</h2>
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
              <div id="success_msg"></div><?=@$div?><?=@$input_id;?>
                <div id="tab3">
                  <div class="text-center text-uppercase"><h2>List of Approvals</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>Account Type</th>
                      <th>Message</th>
                      <th>Sender</th>
                      <th>Status</th>
                      <th>Sent on</th>
                      <th>Action</th>
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