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
      $result=mysqli_query($link,"SELECT * FROM tbl_tp WHERE tid='$id'");
      $row=mysqli_fetch_array($result);

      //SELECTING FOR CONTAINER NUMBER
      /*@$options1="<input type='text' id='tp_con' name='tp_con' class='form-control text-uppercase' placeholder='BL Number' maxlength='20' value='<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$tp_con;} ?>'>";*/
         /*$i=1;
        @$options1="<label class='form-control-label text-danger' for='containerNo'><i>Click on save to update container numbers for BL:$row[2]</i></label>";
       while ($rowCon=mysqli_fetch_array($results)) {
        @$options1.="<div class='form-row mb-3'>
          <input type='hidden' name='idcon' id='idcon$i' class='form-control text-uppercase col-md-6' value='$rowCon[0]'>
          <input type='text' name='upcon' id='$i' class='form-control text-uppercase col-md-6' placeholder='Container Number' maxlength='20' value='$rowCon[2]'>
          <button type='button' class='btn btn-info ml-2' data-id='$i' id='upBtn_tp' name='upBtn_tp'>Update</button>
        </div>
        ";
        $i++;
      }*/
  }
  //ADDING THE BL
  if(isset($_POST['btn_tp'])){
    $tp_bill = htmlentities($_POST['tp_bill']);
    $tp_size = htmlentities($_POST['tp_size']);
    $tp_trans = htmlentities($_POST['tp_trans']);
    @$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];
    $tp_driver = htmlentities($_POST['tp_driver']);
    $tp_phone = htmlentities($_POST['tp_phone']);
    $tp_load = htmlentities($_POST['tp_load']);
    $tp_arrival = htmlentities($_POST['tp_arrival']);
    $tp_location = htmlentities($_POST['tp_location']);
    $tp_dep = htmlentities($_POST['tp_dep']);
    $tp_return = htmlentities($_POST['tp_return']);
    $tp_remarks = htmlentities($_POST['tp_remarks']);

    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_tp WHERE blNo='$tp_bill'");
    $row=mysqli_fetch_array($result);
    if($tp_bill=='' | $tp_size==''| $tp_trans=='' | $tp_driver=='' | $tp_phone==''| $tp_load=='' | $tp_location==''  | $tp_remarks==''){
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
                $sqls=mysqli_query($link,"INSERT INTO tbl_tp (blNo,conNo,size,trans,driver,phone,loads,arrival,location,dep,returns,remark,postDate) VALUES ('$tp_bill','$containerNo[$i]','$tp_size','$tp_trans','$tp_driver','$tp_phone','$tp_load','$tp_arrival','$tp_location','$tp_dep','$tp_return','$tp_remarks',now())");
              }
            }
            if($sqls){
              $div="<script>
                          swal('New transportation details added successfully!','','success')
                          $('#form_tp')[0].reset();
                           setTimeout(function(){
                              window.location.href='add_tp?vw=$rand1&tp'
                            },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A transportation details was added on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
              //FETCHING TRANSPORT DETAILS FROM TABLE
              $result=mysqli_query($link,"SELECT * FROM tbl_tp ORDER BY tid DESC");
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
                      <td>$row[7]</td>
                      <td>$row[8]</td>
                      <td>$row[9]</td>
                      <td>$row[10]</td>
                      <td>$return</td>
                      <td style='white-space:pre-wrap;'>$row[12]</td>
                      <td>$row[13]</td>
                      <td><a href='add_tp?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
                      <a href='print_tp?$rand1&vw=$row[0]&$rand2' class='btn btn-warning btn-sm' role='button' id='$row[0]'><span class='fa fa-print'>&nbsp;Print</span></a>
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
    $tp_size = htmlentities($_POST['tp_size']);
    $tp_trans = htmlentities($_POST['tp_trans']);
    $tp_con = htmlentities($_POST['tp_con']);
    /*@$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];*/
    $tp_driver = htmlentities($_POST['tp_driver']);
    $tp_phone = htmlentities($_POST['tp_phone']);
    $tp_load = htmlentities($_POST['tp_load']);
    $tp_arrival = htmlentities($_POST['tp_arrival']);
    $tp_location = htmlentities($_POST['tp_location']);
    $tp_dep = htmlentities($_POST['tp_dep']);
    $tp_return = htmlentities($_POST['tp_return']);
    $tp_remarks = htmlentities($_POST['tp_remarks']);
    $release_file = $_FILES['release_file']['name'];
    
    $location="../photo/".uniqid().$release_file;
    $uploadOk=1;
    $imageFileType=pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions=array('jpg','jpeg','png','pdf','doc','docx');

    if(!in_array(strtolower($imageFileType), $valid_extensions)){
        $uploadOk=0;
    }

    if($tp_bill!=null){
      if($release_file==null | empty($release_file)){
         $ref_update=mysqli_query($link,"UPDATE tbl_tp SET blNo='$tp_bill',conNo='$tp_con',size='$tp_size',trans='$tp_trans',driver='$tp_driver',phone='$tp_phone',loads='$tp_load',arrival='$tp_arrival',location='$tp_location',dep='$tp_dep',returns='$tp_return',remark='$tp_remarks',postDate=now() WHERE tid='$id'");
         
         $result=mysqli_query($link,"SELECT * FROM tbl_tp WHERE tid='$id'");
         $row=mysqli_fetch_array($result);
         $rDate=$row[11];
         if($rDate!=""){
            $ref_updates=mysqli_query($link,"UPDATE tbl_tp SET status='1' WHERE tid='$id'");
            $sql_copy=mysqli_query($link,"INSERT INTO tbl_empty (blNo,conNo,trans,driver,phone,arrival,remark,postDate) SELECT blNo,conNo,trans,driver,phone,arrival,remark,postDate FROM tbl_tp WHERE tid='$id'");
         }
         $div="<script>
                      swal('This container have been successfull moved to empty container returned!','','success')
                      setTimeout(function(){
                    window.location.href='add_tp?vw=$rand1&tp'
                    },3000)
                  </script> ";
            if($ref_update){
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A transportation details was updated on $date by ";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);
            }
      }//END FIRST IF
      else{
        if($uploadOk==0){
              $div=" <script>
                  swal('File format not supported','file should be in the format: jpg, jpeg or png','error')
              </script>";
          }
        else{
            $ref_update=mysqli_query($link,"UPDATE tbl_tp SET blNo='$tp_bill',conNo='$tp_con',size='$tp_size',trans='$tp_trans',driver='$tp_driver',phone='$tp_phone',loads='$tp_load',arrival='$tp_arrival',location='$tp_location',dep='$tp_dep',uploads='$location',remark='$tp_remarks',postDate=now() WHERE tid='$id'");
            $div="<script>
                          swal('The transport details was updated successfully!','','success')
                          setTimeout(function(){
                        window.location.href='add_tp?vw=$rand1&tp'
                        },3000)
                      </script>
                      ";
                if($ref_update){
                    $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                    $message=" A transportation details was updated on $date by ";
                    $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                    $out1 = mysqli_query($link,$sql1);
                    move_uploaded_file($_FILES['release_file']['tmp_name'],$location);
                }
              }
         }//END MAIN IF
      }
  }
   if(isset($_GET['vw'])){
      //FETCHING TRANSPORT DETAILS FROM TABLE
      $fetch=mysqli_query($link,"SELECT * FROM tbl_tp WHERE returns='' AND uploads='0' ORDER BY tid DESC");
      $numRow=mysqli_num_rows($fetch);
      $i=1;
      while ($row=mysqli_fetch_array($fetch)) {
          @$con.="<tr><td>$i</td><td>$row[1]</td><td>$row[2]</td></tr>";
          $div="<script>
            Swal.fire({
                icon:'warning',
                title:'You have $numRow container that has not been returned',
                text:'Do you want to view them',
                showCancelButton:true,
                confirmButtonText:'View Containers'
              }).then((result)=>{
                if(result.isConfirmed){
                    Swal.fire({
                    title: '<strong><h3>List of container(s) not returned</h3></strong>',
                    type: 'info',
                    html:
                      '<table width=100% border=1 class=text-left><tr style=font-weight:bold;><td>S/N</td><td>BL Number</td><td>Container Number</td></tr>'+
                      '$con</table>',
                    confirmButtonColor:'#dc3545'
                  })
                }
              })
            </script>";
            $i++;
      }

      $result=mysqli_query($link,"SELECT * FROM tbl_tp WHERE status='0' ORDER BY tid DESC");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
            $return=$row[11];
            $ups=$row[14];
            if($return==''&$ups=='0'){
               @$return="<div class='fa fa-circle text-danger wow flash' style='width:0.1rem;height:0.1rem;' data-wow-duration='10s' data-wow-iteration='infinite'></div>";
            }
            else if($return!=''&$ups=='0'){
               @$return=$row[11];
            }
            else if($return==''&$ups!='0'){
               @$return="<a href='$row[14]' target='_blank'> view upload <i class='fa fa-check-circle text-success'></i></a>";
            }
            else if($return!=''&$ups!='0'){
               @$return="$row[11] <br> <a href='$row[14]' target='_blank'> view upload <i class='fa fa-check-circle text-success'></i></a>";
            }
            else{
              @$return=$row[11];
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
              <td>$row[8]</td>
              <td>$row[9]</td>
              <td>$row[10]</td>
              <td>$return</td>
              <td style='white-space:pre-wrap;'>$row[12]</td>
              <td>$row[13]</td>
              <td><a href='add_tp?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
              <a href='print_tp?$rand1&vw=$row[0]&$rand2' class='btn btn-warning btn-sm' role='button' id='$row[0]'><span class='fa fa-print'>&nbsp;Print</span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
              </td>
            </tr>";
        $i++;
      }
   }
   // DELETE TP DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_tp where tid='$id'");
      $div="
      <script>
          swal('Transport details has been removed successfully','','success')
          setTimeout(function(){
          window.location.href='add_tp?vw=$rand1&confirm-Delete'
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
            <h2 class="display-2 text-white">Add Transport Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="add_tp?vw=<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Transport Added</a>
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
                 <div class="text-center text-uppercase"><h2>Add Transport Form</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
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
                    <!-- LOADING DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_load">Loading Date</label>
                        <input type="date" id="tp_load" name="tp_load" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$tp_load;} ?>">
                      </div>
                    </div>
                    <!-- ARRIVAL DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_arrival">Arrival Date</label>
                        <input type="date" id="tp_arrival" name="tp_arrival" class="form-control text-uppercase" placeholder="E.T.A status" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$tp_arrival;} ?>">
                      </div>
                    </div>
                    <!-- CURRENT LOCATION -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_location">Current Location & State</label>
                          <input type="text" id="tp_location" name="tp_location" class="form-control text-uppercase" placeholder="Enter Location" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{echo @$tp_location;} ?>">
                      </div>
                    </div>
                    <!-- DEPARTURE DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="tp_dep">Departure Date from Kano</label>
                        <input type="date" id="tp_dep" name="tp_dep" class="form-control text-uppercase" placeholder="Departure Date" value="<?php if(isset($_GET['ed'])){echo $row[10];}else{echo @$tp_dep;} ?>">
                      </div>
                    </div>
                    <!-- RETURN DATE -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="tp_return">Return Date</label>
                           <select class="form-control text-uppercase mb-2" name="tp_ret" id="tp_ret" <?php if(!isset($_GET['ed'])){echo "style='display:none;'";} ?>>
                            <option value="choose">Choose update type</option>
                            <option value="tpd">Update with date</option>
                            <option value="tpu">Upload a card</option>
                          </select>
                          <input type="date" id="tp_return" name="tp_return" class="form-control text-uppercase" placeholder="Return Date" value="" <?php if(isset($_GET['ed'])){echo "style='display:none;'";}?>>
                           <input type="file" class="form-control" name="release_file" id="release_file" style="display:none;">
                        </div>
                      </div>
                      <!-- REMARKS -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="tp_remarks">Remarks</label>
                          <textarea id="tp_remarks" name="tp_remarks" cols="10" rows="5" style="resize:none;white-space:pre-wrap;" class="form-control" placeholder="TYPE REMARK ..."><?php if(isset($_GET['ed'])){echo $row[12];}else{echo @$tp_remarks;} ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div><!-- SECOND PART -->
                <div class="col-12 pl-lg-4 text-right" <?php if(isset($_GET['vw'])){echo "style='display:none'";} ?>>
                  <button type="submit" id="btn_tp" name="btn_tp" class="btn btn-warning" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
              <div class="col-12" id="trans-show" <?php if(isset($_GET['vw'])){echo "style='display:block'";}else{echo "style='display:none'";} ?>>
                <div class="text-center text-uppercase"><h2>List of Added Transport</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive ex" width="100%" id="example2">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Container Size</th>
                      <th>Transporter Name</th>
                      <th>Driver Name</th>
                      <th>Driver Phone Number</th>
                      <th>Loading Date</th>
                      <th>Arrival Date</th>
                      <th>Current Location & State</th>
                      <th>Departure Date from Kano</th>
                      <th>Return Date</th>
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