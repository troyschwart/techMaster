<?php include 'menu_nav.php'; 
//SELECTING TRANSIRE DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_register WHERE keyStatus='0' ORDER BY id DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    $statuus=$row[11];
    if($statuus=='verified'){
        $btn_status="<a href='manage-users?$rand1&stat=$row[0]&$rand2' class='btn btn-success btn-sm' name='vert1' id='vert1'><span class='fa fa-check-circle'></span> verified</a>";
    }
    else{
        $btn_status="<a href='manage-users?$rand1&stat2=$row[0]&$rand2' class='btn btn-danger btn-sm' name='vert2' id='vert2'><span class='fa fa-times-circle'></span> Not verified</a>";
    }
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[4]</td>
          <td>$row[6]</td>
          <td>$btn_status</td>
          <td>$row[8]</td>
          <td><a href='manage-users?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_user'><span class='fa fa-edit'> Edit</span></a>
          <a href='manage-users?$rand1&vw=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'><span class='fa fa-search-plus'> View</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span> Delete</button>
          </td>
        </tr>";
    $i++;
  }
  //GET ONLINE USERS
  $result=mysqli_query($link,"SELECT * FROM tbl_register WHERE keyStatus='0' ORDER BY checks DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
        $online=$row[9];
        if($online=='on'){
          $online="<span class='fa fa-circle text-success'></span>";
        }
        else{
          $online="<span class='fa fa-circle text-danger'></span>";
        }
      @$options1.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[4]</td>
          <td>$online</td>
        </tr>";
        $i++;
  }
  //UPDATING ADDED USER HANDLE
  if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $update_btn="<button type='submit' id='user_update' name='user_update' class='btn btn-success mt-4'>Update User</button>";
      $input_id="<input type='hidden' id='input_id' name='input_id' value='ed'>";      
      $result=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
      $row=mysqli_fetch_array($result);
  }
  if(isset($_POST['user_update'])){
      $id=$_GET['ed'];
      $account_type = htmlentities(ucwords($_POST['account_type']));
      $fName = htmlentities(ucwords($_POST['fName']));
      $lName = htmlentities(ucwords($_POST['lName']));
      $username = htmlentities(ucwords($_POST['username']));
      $phone = htmlentities($_POST['phone']);
      $emails = htmlentities($_POST['email']);
      if(isset($_GET['id'])&$_GET['id']!=""){
      $ref_update=mysqli_query($link,"UPDATE tbl_register SET accountType='$account_type',fname='$fName',lname='$lName',username='$username',phone='$phone',email='$emails' WHERE id='$id'");
        $div="<script>
                  swal('Staff details updated successfully!','','success')
                  setTimeout(function(){
                window.location.href='manage-users?&updated$rand1&'
                },3000)
              </script>
              ";
    }
  }
  //UPDATING VERIFIED STATUS
  if(isset($_GET['stat'])){
    $id=$_GET['stat'];
    $ref_update=mysqli_query($link,"UPDATE tbl_register SET status='not verified' WHERE id='$id'");
    $div="<script>
                  swal('Verification status for that staff has been turned off successfully!','','success')
                  setTimeout(function(){
                window.location.href='manage-users?$rand1'
                },3000)
              </script>
              ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" staff account has been restricted on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
  }
  if(isset($_GET['stat2'])){
    $id=$_GET['stat2'];
    $ref_update=mysqli_query($link,"UPDATE tbl_register SET status='verified' WHERE id='$id'");
    $div="<script>
                  swal('The staff has been verified successfully!','','success')
                  setTimeout(function(){
                window.location.href='manage-users?$rand1'
                },3000)
              </script>
              ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" Staff account was verified on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
  }
  //VIEWING PAGE
  @$_SESSION['vw']=$_GET['vw'];
  if(isset($_GET['vw'])){
    $tittle="<center><h2 class='text-primary'>Staff Full Details</h2></center>";
    $vID="print";
    $vw=$_GET['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$vw'");
    $resultVal=mysqli_fetch_array($result);
    $onstat=$resultVal[9];
    if($onstat=='on'){
      $img='online.png';
      $star="Online";
    }
    else{
      $img='n_red.png';
      $star="Offline";
    }
    $c_result=mysqli_query($link,"SELECT * FROM tbl_contact WHERE uid='$vw'");
    $c_resultVal=mysqli_fetch_array($c_result);
  }
  else{
    //$tittle="Transire Manifest";
  }
    //COUNTING REGISTERED USERS
    $result1=mysqli_query($link,"SELECT * FROM tbl_register");
    $resultVal1=mysqli_num_rows($result1);
    if($resultVal1>0){
      $titu="<h2>Break down of added staff</h2>";
      $result_count=mysqli_query($link,"SELECT COUNT(*) as total_user,accountType FROM `tbl_register` WHERE `keyStatus`=0 GROUP BY accountType");
      $i=0;
      while($resultVal_co=mysqli_fetch_array($result_count)){
          if($i%6==5){
            $bgcolor="btn-success";
          }
          if($i%6==4){
            $bgcolor="btn-primary";
          }
          if($i%6==3){
            $bgcolor="btn-danger";
          }
          if($i%6==2){
            $bgcolor="btn-info";
          }
          if($i%6==1){
            $bgcolor="btn-warning";
          }
          if($i%6==0){
            $bgcolor="btn-default";
          }
          @$account_types.="<a href='manage-users?$rand1&q=$resultVal_co[1]&$rand2' class='btn $bgcolor mb-2'>$resultVal_co[1] <span class='badge badge-dark badge-pill text-white'>$resultVal_co[total_user]</span></a>";
           $i++;
        }
    }
    //RESET PASSWORD
    if(isset($_POST['reset_pass'])){
      $id=$_GET['vw'];
      $password=password_hash("fordglobal", PASSWORD_DEFAULT,['cost=>20']);
      $ref_update=mysqli_query($link,"UPDATE tbl_register SET password='$password' WHERE id='$id'");
      $div="<script>
                    swal('Password reset for this staff was successfully changed!','Default password is fordglobal','success')
                    setTimeout(function(){
                  window.location.href='manage-users?$rand1&&success'
                  },5000)
                </script>
                ";
          if($ref_update){
             $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" Staff password was reset on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
          }
    }
    // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_register where id='$id'");
      $div="<script>
          swal('Staff have been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='manage-users?$rand1'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A staff was deleted on $date by ";
      //$message=" A profile update has been made by $fullname on $dates";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }
    //FETCHING ACCOUNT TYPES
    if(isset($_GET['q'])){
        $q=$_GET['q'];
        $result1=mysqli_query($link,"SELECT * FROM tbl_register WHERE `keyStatus`=0 AND accountType='$q'");
        $i++;
        while ($row=mysqli_fetch_array($result1)) {
            $statuus=$row[11];
            if($statuus=='verified'){
                $btn_status="<a href='manage-users?$rand1&stat=$row[0]&$rand2' class='btn btn-success btn-sm' name='vert1' id='vert1'><span class='fa fa-check-circle'></span> verified</a>";
            }
            else{
                $btn_status="<a href='manage-users?$rand1&stat2=$row[0]&$rand2' class='btn btn-danger btn-sm' name='vert2' id='vert2'><span class='fa fa-times-circle'></span> Not verified</a>";
            }
            @$opt.="<tr>
                  <td> $i</td>
                  <td>$row[1]</td>
                  <td>$row[4]</td>
                  <td>$row[6]</td>
                  <td>$btn_status</td>
                  <td>$row[8]</td>
                  <td><a href='manage-users?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_user'><span class='fa fa-edit'> Edit</span></a>
                  <a href='manage-users?$rand1&vw=$row[0]&$rand2' class='btn btn-success btn-sm' role='button' id='$row[0]'><span class='fa fa-search-plus'> View</span></a>
                  <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span> Delete</button>
                  </td>
                </tr>";
            $i++;
          }
    } 
    //NEW USER ALERT POP
    if(isset($_GET['muid'])){
        $div="<script>
          swal('The email or phone number you use is already used by another staff','','warning')
          setTimeout(function(){
            window.location.href='manage-users?mu=$rand1'
          },10000)
      </script>";
    }
    else if (isset($_GET['muids'])) {
      $div="<script>
          swal('New account registered successfully for that staff!','','success')
          setTimeout(function(){
            window.location.href='manage-users?mu=$rand1'
          },5000)
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
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Manage Users Page</h2>
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
                  <h3 class="mb-0">
                    <button type="button" class="btn btn-success btn-sm mb-1" id="" name="" data-toggle='modal' data-target='#addUser'><span class="fa fa-plus"></span> Add New User</button>  
                    <button type="button" class="btn btn-default btn-sm" id="" name="" data-toggle='modal' data-target='#online-users'> View online users <span class="fa fa-circle text-success"></span> </button>  
                    <button type="button" class="btn btn-warning btn-sm" onclick="window.location='manage-users?ref <?=$rand1?>&'"> Refresh all users <span class="fa fa-sync"></span> </button> </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?><?=@$input_id;?>
              <?=@$titu;?>
              <?=@$account_types;?><hr>
              <?=@$tittle?>
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <div class="text-center mb-4 u_photo"><img src="<?=$resultVal[10];?>" class="rounded-circle" width="80" height="80" id="user_photo"></div>
                  <form method="POST" name="post_user" id="post_user" action="">
                  <div class="row">
                  <div class="col-md-6">
                     <label class="form-control"><span class="text-danger">Status:</span> <b><?=$star;?></b> <img src="../assets/img/brand/<?=$img?>" id="user_photo1" width="10" height="10"></label>
                    <label class="form-control"><span class="text-danger">Account Type:</span> <b><?=$resultVal[1];?><input type="hidden" name="id" value="<?=$resultVal[1];?>"></b></label>
                    <label class="form-control"><span class="text-danger">Full Name:</span> <b><?=$resultVal[2]." ".$resultVal[3];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Username:</span> <b><?=$resultVal[4];?></b></label>
                    <label class="form-control"><span class="text-danger">Phone Number:</span> <b><?=$resultVal[5];?></b></label>
                    <label class="form-control"><span class="text-danger">Email: </span> <b><?=$resultVal[6];?></b></label>
                    <label class="form-control"><span class="text-danger">Check:</span> <b><?=$resultVal[11];?></b></label>
                  </div>
                  <div class="col-md-6">
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Address:</span> <b><?php if($c_resultVal[2]!=""){echo $c_resultVal[2];}else{echo "Not yet updated";}?></b></label>
                    <label class="form-control"><span class="text-danger">City:</span> <b><?php if($c_resultVal[3]!=""){echo $c_resultVal[3];}else{echo "Not yet updated";}?></b></label>
                    <label class="form-control"><span class="text-danger">Country:</span> <b><?php if($c_resultVal[4]!=""){echo $c_resultVal[4];}else{echo "Not yet updated";}?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">About Me:</span> <b><?php if($c_resultVal[5]!=""){echo $c_resultVal[5];}else{echo "Not yet updated";}?></b></label>
                    <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[8];?></b></label>
                    <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='manage-users?mu=<?=$rand1?>';"><span class="fa fa-angle-double-left"></span> Back</button>
                    <button type="submit" id="reset_pass" name="reset_pass" class="btn btn-success">   Reset password</button>
                  </div>
                </div></form>
              </div>
              <?php break; default:;?>
                <div id="tab2" <?php if(!isset($_GET['q'])){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
                  <div class="text-center text-uppercase"><h2>List of Users Added</h2></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center  table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>s/no</th>
                      <th>Account Type</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Registered Date</th>
                      <th>Action</th>
                    </thead>
                    <?= $options;?>
                  </table>
                </div><!-- END TABLE DETAILS -->

                <div id="tab3" <?php if(isset($_GET['q'])){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
                  <div class="text-center text-uppercase"><h2>List of <?=$q; ?> Added</h2></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center  table-responsive" width="100%" id="example">
                    <thead class="th">
                      <th>s/no</th>
                      <th>Account Type</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Registered Date</th>
                      <th>Action</th>
                    </thead>
                    <?=$opt;?>
                  </table>
                </div><!-- END TABLE DETAILS -->

              <?php }?>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>