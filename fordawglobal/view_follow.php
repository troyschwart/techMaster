<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Shipping Manager" || $list=="Administrator" | $list=="Releasing Officer" | $list=="Transport Manager" | $list=="Manager" | $list=="Accountant"){?>
  
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
  //$result=mysqli_query($link,"SELECT * FROM tbl_follow ORDER BY bid DESC");
  /*$result=mysqli_query($link,"SELECT * FROM tbl_follow as f,follow_con as cn WHERE f.bid=cn.bid AND f.loadStatus='no' AND cn.loadStatus='no' ORDER BY f.bid ");*/
  //SELECTING PROGRESSIVE REPORT DETAILS
if(isset($_GET['vr'])){
    $heading="List of Release Status";
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE releaseStatus='yes' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
      if($list=='Transport Manager'){
          $move_btn="<a href='view_follow?$rand1&mr=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>
          <a href='follow-up?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>";
        }
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>$move_btn</td>
            </tr>";
        $i++;
      }
  }
    else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
else if(isset($_GET['vt'])){
    $heading="List of TDO Status";
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE tdoStatus='yes' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
      if($list=='Transport Manager'){
          $move_btn="<a href='view_follow?$rand1&mt=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>
          <a href='follow-up?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>";
        }
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>$move_btn</td>
            </tr>";
        $i++;
      }
  }
    else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
else if(isset($_GET['vl'])){
    $heading="List of Load Status";
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE loadStatus='yes' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
      if($list=='Transport Manager'){
          $move_btn="<a href='view_follow?$rand1&ml=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>
          <a href='follow-up?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>";
        }
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>$move_btn</td>
            </tr>";
        $i++;
      }
  }
    else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
else if(isset($_GET['va'])){
    $heading="List of Arrival Status";
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE arrivalStatus='yes' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
      if($list=='Accountant'){
          $move_btn="<a href='view_follow?$rand1&ma=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>
          <a href='follow-up?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>";
        }
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>$move_btn</td>
            </tr>";
        $i++;
      }
  }
    else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
else if(isset($_GET['vd'])){
    $heading="List of Delivered Jobs";
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE delivryStatus='yes' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>Delivered <span class='fa fa-check-circle text-success'></span></td>
            </tr>";
        $i++;
      }
  }
  else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}
else{
  $heading="List of follow up report";
  $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE progStatus='no' ORDER BY bid DESC");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
      $dvery=$row[8];
      if($list=='Releasing Officer'){
          $move_btn="<a href='view_follow?$rand1&m=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>
          <a href='follow-up?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[11]'><span class='fa fa-trash'></span>&nbsp;Delete</button>";
        }
        //CHECKING DELIVERY ORDER UPLOADED
        if($dvery==null){
            $dery_="Not uploaded <i class='fa fa-times-circle text-danger'></i>";
        }
        else{
            $dery_="<a href='$row[8]' target='_blank'> view <i class='fa fa-check-circle text-success'></i></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$dery_</td>
              <td>$row[9]</td>
              <td>$row[15]</td>
              <td>$move_btn</td>
            </tr>";
        $i++;
      }
  }
  else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }
}

//MOVING STATUS TO YES
if(isset($_GET['m'])){
    $id=$_GET['m'];
    $ref_update=mysqli_query($link,"UPDATE tbl_follow SET progStatus='x', releaseStatus='yes' WHERE bid='$id'");
    $div="<script>
          Swal.fire({
              title: 'Good Job Done!!!',
              text: 'The BL has been move to the next stage, Click on the release status to view details',
              icon: 'success',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Okay',
            })
            setTimeout(function(){
              window.location.href='view_follow?vp=$rand2'
            },5000)
      </script>";
}
if(isset($_GET['mr'])){
    $id=$_GET['mr'];
    $ref_update=mysqli_query($link,"UPDATE tbl_follow SET releaseStatus='x',tdoStatus='yes' WHERE bid='$id'");
    $div="<script>
          Swal.fire({
              title: 'Good Job Done!!!',
              text: 'The BL has been move to the next stage, Click on the TDO status to view details',
              icon: 'success',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Okay',
            })
            setTimeout(function(){
              window.location.href='view_follow?vr=$rand2'
            },5000)
      </script>";
    //}
}
if(isset($_GET['mt'])){
    $id=$_GET['mt'];
    $ref_update=mysqli_query($link,"UPDATE tbl_follow SET tdoStatus='x',loadStatus='yes' WHERE bid='$id'");
    $div="<script>
          Swal.fire({
              title: 'Good Job Done!!!',
              text: 'The BL has been move to the next stage, Click on the load status to view details',
              icon: 'success',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Okay',
            })
            setTimeout(function(){
              window.location.href='view_follow?vr=$rand2'
            },5000)
      </script>";
    //}
}
if(isset($_GET['ml'])){
    $id=$_GET['ml'];
    $ref_update=mysqli_query($link,"UPDATE tbl_follow SET loadStatus='x',arrivalStatus='yes' WHERE bid='$id'");
    $div="<script>
          Swal.fire({
              title: 'Good Job Done!!!',
              text: 'The BL has been move to the next stage, Click on the arrival status to view details',
              icon: 'success',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Okay',
            })
            setTimeout(function(){
              window.location.href='view_follow?vl=$rand2'
            },5000)
      </script>";
}
if(isset($_GET['ma'])){
    $id=$_GET['ma'];
   
    $ref_update=mysqli_query($link,"UPDATE tbl_follow SET arrivalStatus='x',delivryStatus='yes' WHERE bid='$id'");
    $div="<script>
          Swal.fire({
              title: 'Good Job Done!!!',
              text: 'Jobs delivered Successfully',
              icon: 'success',
              confirmButtonColor:'#dc3545',
              confirmButtonText: 'Okay',
            })
            setTimeout(function(){
              window.location.href='view_follow?va=$rand2'
            },5000)
      </script>";
}

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_follow WHERE bid='$id'");
      $div="
      <script>
          swal('follow up has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_follow?$rand1&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A follow up was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }
    //POPING OUT DATE AGAINST 1 WEEK TIME
    $one_week=date('Y-m-d',strtotime("-7 days"));
    $result1=mysqli_query($link,"SELECT * FROM tbl_follow WHERE releaseStatus='no' AND eta='$one_week' ORDER BY bid DESC");
    $result2=mysqli_query($link,"SELECT count(*) as onWeeks FROM tbl_follow WHERE releaseStatus='no' AND eta='$one_week' ORDER BY bid DESC");
    $row2=mysqli_fetch_array($result2);
    $checkWeek=$row2['onWeeks'];
      if(mysqli_num_rows($result1)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result1)) {
          //VALIDATING ONE WEEK TIME DATES
            @$con.="<tr><td>$i</td><td>$row[1]</td><td>$row[2]</td><td>$row[4]</td></tr>";
            $div="<script>
              Swal.fire({
                  icon:'warning',
                  title:'You have $checkWeek containers that have stayed for 1 week that have not been moved to release status',
                  text:'Do you want to view them',
                  showCancelButton:true,
                  confirmButtonText:'View Details'
                }).then((result)=>{
                  if(result.isConfirmed){
                      Swal.fire({
                      title: '<strong><h3>List of container(s)</h3></strong>',
                      type: 'info',
                      html:
                        '<table width=100% border=1 class=text-left><tr style=font-weight:bold;><td>S/N</td><td>BL Number</td><td>Container Number</td><td>ETA</td></tr>'+
                        '$con</table>',
                      confirmButtonColor:'#dc3545'
                    })
                  }
                })
              </script>";
              $i++;
      }
  }
    /*//MOVING THE FOLLOW UP
    if(isset($_GET['stat'])){
        $id=$_GET['stat'];
        $fid=$_GET['cn'];
        $ref_update=mysqli_query($link,"UPDATE tbl_follow as f,follow_con as cn  SET cn.loadStatus='yes' WHERE f.bid='$id' AND cn.fid='$fid'");

        $div="<script> 
              swal('follow up has been moved to loaded Successfully','','success')
              setTimeout(function(){
                 window.location.href='view_follow?&$rand1&lf&confirm-Delete'
                 },3000)
              </script>";
    }*/
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
            <a href="view_follow?<?=$rand1?>&vd&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Delivered Jobs</a>
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
                  <h3 class="mb-0">Monitor follow up report</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
              <div id="success_"></div>
              <h6 class="heading-small text-muted mb-4">
                <div <?php if(isset($_GET['vd'])){echo "style='display:none'";}?>>
                  <a href="view_follow?vp=<?=$rand2?>" class="btn btn-primary btn-sm">Follow up List</a>
                  <a href="view_follow?vr=<?=$rand2?>" class="btn btn-warning  btn-sm">Release Status</a>
                  <a href="view_follow?vt=<?=$rand2?>" class="btn btn-info btn-sm">TDO Status</a>
                  <a href="view_follow?vl=<?=$rand2?>" class="btn btn-success btn-sm">Load Status</a>
                  <a href="view_follow?va=<?=$rand2?>" class="btn btn-danger btn-sm">Arrival Status</a> 
                </div>
              </h6>
                <div id="tab1" <?php if(isset($_GET['vd'])){ echo "style=display:none;";} ?>>
                  <div class="text-center text-uppercase"><h2><?=$heading;?></h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>customer Name</th>
                      <th>E.T.A</th>
                      <th>Place of Exam</th>
                      <th>Port of discharge</th>
                      <th>Container Size</th>
                      <th>Delivery Order</th>
                      <th>Transport Delivery Order</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE1 DETAILS -->

                <div id="tab2" <?php if(!isset($_GET['vd'])){ echo "style=display:none;";} ?>>
                  <div class="text-center text-uppercase"><h2><?=$heading;?></h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>customer Name</th>
                      <th>E.T.A</th>
                      <th>Place of Exam</th>
                      <th>Port of discharge</th>
                      <th>Container Size</th>
                      <th>Delivery Order</th>
                      <th>Transport Delivery Order</th>
                      <th>Date Posted</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div><!-- END TABLE2 DETAILS -->
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>