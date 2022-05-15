<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Transport Manager" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//ACTIVATING THE UPDATE BUTTON
  if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $update_btn="<button type='submit' id='btn_update' name='btn_update' class='btn btn-danger'>Update</button>";
      $result=mysqli_query($link,"SELECT * FROM tbl_empty WHERE tid='$id'");
      $row=mysqli_fetch_array($result);
  }
  //ADDING THE BL
  if(isset($_POST['btn_tp'])){
    $tp_bill = htmlentities($_POST['tp_bill']);
    $tp_trans = htmlentities($_POST['tp_trans']);
    @$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];
    $tp_driver = htmlentities($_POST['tp_driver']);
    $tp_phone = htmlentities($_POST['tp_phone']);
    $tp_arrival = htmlentities($_POST['tp_arrival']);
    $tp_remarks = htmlentities($_POST['tp_remarks']);

    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_empty WHERE blNo='$tp_bill'");
    $row=mysqli_fetch_array($result);
    if($tp_bill=='' | $tp_trans=='' | $tp_driver=='' | $tp_phone=='' | $tp_remarks==''){
        $div=" <script>
            swal('Please make sure that all fields are filled correctly!','','error')
        </script>
        ";
    }
    else if(mysqli_num_rows($result)==1){
        $div=" <script>
            swal('That BL have been added already! Please remove it or edit it','','warning')
        </script>
        ";
    }
    else{
          if($counts>0){
            for($i=0;$i<$counts;$i++){
              if(trim($_POST["containerNo"][$i])!=""){
                $sqls=mysqli_query($link,"INSERT INTO tbl_empty (blNo,conNo,trans,driver,phone,arrival,remark,postDate) VALUES ('$tp_bill','$containerNo[$i]','$tp_trans','$tp_driver','$tp_phone','$tp_arrival','$tp_remarks',now())");
              }
            }
          if($sqls){
              $div="<script>
                          swal('Empty container return added successfully!','','success')
                          $('#form_tp')[0].reset();
                           setTimeout(function(){
                              window.location.href='empty-con?vw=$rand1&tp'
                            },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A transportation details was added on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
              //FETCHING TRANSPORT DETAILS FROM TABLE
              $result=mysqli_query($link,"SELECT * FROM tbl_empty ORDER BY tid DESC");
              $i=1;
              while ($row=mysqli_fetch_array($result)) {
                  @$options.="<tr>
                      <td> $i</td>
                      <td>$row[1]</td>
                      <td>$row[2]</td>
                      <td>$row[3]</td>
                      <td>$row[4]</td>
                      <td>$row[5]</td>
                      <td>$row[6]</td>
                      <td style='white-space:pre-wrap;'>$row[7]</td>
                      <td>$row[8]</td>
                      <td><a href='empty-con?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
                      <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
                      </td>
                    </tr>";
                $i++;
              }
          }
          else{
          $div=" <script>
                  swal('Error Occurred while submitting details, Try again!','','error')
              </script>
              ";
           }
         }
      }//END MAIN ELSE
  }
  //UPDATING BL
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $tp_bill = htmlentities($_POST['tp_bill']);
    $tp_trans = htmlentities($_POST['tp_trans']);
    $tp_con = htmlentities($_POST['tp_con']);
    $tp_driver = htmlentities($_POST['tp_driver']);
    $tp_phone = htmlentities($_POST['tp_phone']);
    $tp_arrival = htmlentities($_POST['tp_arrival']);
    $tp_remarks = htmlentities($_POST['tp_remarks']);
    
      $ref_update=mysqli_query($link,"UPDATE tbl_empty SET blNo='$tp_bill',conNo='$tp_con',trans='$tp_trans',driver='$tp_driver',phone='$tp_phone',arrival='$tp_arrival',remark='$tp_remarks' WHERE tid='$id'");

      $div="<script>
                    swal('The empty container returned has been updated successfully!','','success')
                    setTimeout(function(){
                  window.location.href='empty-con?vw=$rand1&tp'
                  },3000)
                </script>
                ";
          if($ref_update){
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A transportation details was updated on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
          }
  }
   if(isset($_GET['vw'])){
      //FETCHING TRANSPORT DETAILS FROM TABLE
      $result=mysqli_query($link,"SELECT * FROM tbl_empty ORDER BY tid DESC");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
          @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td style='white-space:pre-wrap;'>$row[7]</td>
              <td>$row[8]</td>
              <td><a href='empty-con?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
              </td>
            </tr>";
        $i++;
      }
   }
   // DELETE TP DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_empty where tid='$id'");
      $div="
      <script>
          swal('Transport details has been removed successfully','','success')
          setTimeout(function(){
          window.location.href='empty-con?vw=$rand1&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A transport details was deleted on $date by ";
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
            <h2 class="display-2 text-white">Add Empty Container Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="empty-con?vw=<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Empty containers Returned</a>
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
                  <h3 class="mb-0" ><?php echo $list; ?></h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_tp" name="form_tp" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="pl-lg-4" <?php if(isset($_GET['vw'])){echo "style='display:none'";} ?>>
                 <div class="text-center text-uppercase"><h2>Add Empty Containers Return Form</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <div class="row">
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_bill">BL Number</label>
                        <input type="text" id="tp_bill" name="tp_bill" class="form-control text-uppercase" placeholder="BL Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$tp_bill;} ?>">
                      </div>
                    </div>
                    <!-- CONTAINER NUMBER -->
                    <div class="col-lg-12 mb-3" <?php if(isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                      <p class="small text-muted">Click on the plus sign to add more container numbers</p>
                        <label class="form-control-label" for="containerNo">Container Number</label>
                      <div class="form-row">
                        <input type="text" id="c" name="containerNo[]" class="form-control text-uppercase col-md-6" placeholder="Container Number" maxlength="20" value="">
                        <button type="button" class="btn btn-primary ml-2" id="plusBtn" name="plusBtn">+</button>
                        <div class="col-lg-12" id="addContainer"></div>
                      </div>
                    </div>
                    <div class="col-lg-6" <?php if(!isset($_GET['ed'])){ echo "style='display:none;'";} ?>>
                          <div class="form-group">
                            <label class="form-control-label" for="tp_con">Container Number</label>
                            <input type="text" id="tp_con" name="tp_con" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];} ?>">
                          </div>
                    </div>
                   <!-- SIZE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_size">Container Size</label>
                        <input type="text" id="tp_size" name="tp_size" class="form-control text-uppercase" placeholder="Container Size" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$tp_size;} ?>">
                      </div>
                    </div>
                 
                  <!-- TRANSPORTER NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_trans">Transporter Name</label>
                        <input type="text" id="tp_trans" name="tp_trans" class="form-control text-uppercase" placeholder="Enter Transporter name" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$tp_trans;} ?>">
                      </div>
                    </div>
                    <!-- DRIVER NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_driver">Driver Name</label>
                        <input type="text" id="tp_drive" name="tp_driver" class="form-control text-uppercase" placeholder="Driver Name" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$tp_driver;} ?>">
                      </div>
                    </div>
                    <!-- DRIVER PHONE NUMBER -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_phone">Driver Phone Number</label>
                        <input type="text" id="tp_phone" name="tp_phone" class="form-control text-uppercase" placeholder="Phone Number" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$tp_phone;} ?>" maxlength='11'>
                      </div>
                    </div>
                    <!-- ARRIVAL DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_arrival">Arrival Date</label>
                        <input type="date" id="tp_arrival" name="tp_arrival" class="form-control text-uppercase" placeholder="E.T.A status" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$tp_arrival;} ?>">
                      </div>
                    </div>
                      <!-- REMARKS -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="tp_remarks">Remarks</label>
                          <textarea id="tp_remarks" name="tp_remarks" cols="10" rows="5" style="resize:none;white-space:pre-wrap;" class="form-control" placeholder="TYPE REMARK ..."><?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$tp_remarks;} ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div><!-- SECOND PART -->
                <div class="col-12 pl-lg-4" <?php if(isset($_GET['vw'])){echo "style='display:none'";} ?>>
                  <button type="submit" id="btn_tp" name="btn_tp" class="btn btn-primary" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
              <div class="col-12" id="trans-show" <?php if(isset($_GET['vw'])){echo "style='display:block'";}else{echo "style='display:none'";} ?>>
                <div class="text-center text-uppercase"><h2>List of Empty Container Returned details</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive ex" width="100%" id="example2">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Transporter Name</th>
                      <th>Driver Name</th>
                      <th>Driver Phone Number</th>
                      <th>Arrival Date</th>
                      <th>Remarks</th>
                      <th>Posted on</th>
                      <th>Actions</th>
                    </thead>
                    <?=@$options;?>
                  </table>
              </div>
            </div><!-- END CARD -->
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>