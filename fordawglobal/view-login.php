<?php include 'menu_nav.php'; 
//SELECTING TRANSIRE DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_logins ORDER BY id DESC");
  //$rows=mysqli_fetch_array($result);

  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    $status=$row[3];
    if($status=='1'){
        $btn_status="Successfully Login <span class='text-success fa fa-check-circle'></span> ";
    }
    else{
        $btn_status="Login Failed <span class='text-danger fa fa-times-circle'></span> ";
    }
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$btn_status</td>
          <td>$row[4]</td>
        </tr>";
    $i++;
  }
    //DELETING ALL FROM TABLE
  if(isset($_POST['btn_deletepay'])){
      mysqli_query($link,"TRUNCATE TABLE tbl_logins");
      $div="<script>
                swal('All Login cleared Successfully','','success');
                setTimeout(function(){
                window.location.href='view-login?$rand1&&$rand2'
                },3000)
            </script>";
    }
?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center mt--6">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">View Users Login</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--9">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center text-uppercase">
                <div class="col-12">
                  <h3 class="mb-0"><button type="submit" class="btn btn-primary btn-sm" id="clear_log" name="clear_log" data-toggle='modal' data-target='#delete_payment'><span class="fa fa-plus"></span> Clear Logins</button> </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
                <div id="tab2">
                  <div class="text-center text-uppercase"><h2>List of user login details</h2></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center" width="100%" id="example">
                    <thead class="th">
                      <th>s/no</th>
                      <th>Account Type</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Login Date</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE DETAILS -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>