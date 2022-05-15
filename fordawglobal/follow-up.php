<?php include 'menu_nav.php'; 
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
//ACTIVATING THE UPDATE BUTTON
  if(isset($_GET['ed'])){
      $id=$_GET['ed'];
      $update_btn="<button type='submit' id='btn_update' name='btn_update' class='btn btn-danger'>Update</button>";
      $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE bid='$id'");
      $row=mysqli_fetch_array($result);

      //SELECTING FOR CONTAINER NUMBER
      $results=mysqli_query($link,"SELECT * FROM follow_con WHERE bid='$id'");
        $i=1;
         @$options="<label class='form-control-label text-danger' for='containerNo'><i>Click on save to update container numbers for BL:$row[2]</i></label>";
       while ($rowCon=mysqli_fetch_array($results)) {
        @$options.="<div class='form-row mb-3'>
          <input type='hidden' name='idcon' id='idcon$i' class='form-control text-uppercase col-md-6' value='$rowCon[0]'>
          <input type='text' name='upcon' id='$i' class='form-control text-uppercase col-md-6' placeholder='Container Number' maxlength='20' value='$rowCon[2]'>
          <button type='button' class='btn btn-primary ml-2' data-id='$i' id='upBtn' name='upBtn'>Save</button>
        </div>
        ";
        $i++;
      }
  }
  //ADDING THE BL
  if(isset($_POST['btn_bl'])){
    $bl_bill = htmlentities($_POST['bl_bill']);
    @$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];
    $cust_name = htmlentities($_POST['cust_name']);
    $bl_eta = htmlentities($_POST['bl_eta']);
    $bl_exam = htmlentities($_POST['bl_exam']);
    $bl_port = htmlentities($_POST['bl_port']);
    $bl_size = htmlentities($_POST['bl_size']);
    $bl_tp = htmlentities($_POST['bl_tp']);

    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_follow WHERE blNo='$bl_bill'");
    $row=mysqli_fetch_array($result);

   
    if($bl_bill=='' | $cust_name=='' | $bl_eta=='' | $bl_exam=='' | $bl_port=='' | $bl_size=='' | $bl_tp==''){
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

          $sqls = "INSERT INTO tbl_follow (blNo,customerName,eta,placeExam,podischarge,size,tdo,postDate) VALUES ('$bl_bill','$cust_name','$bl_eta','$bl_exam','$bl_port','$bl_size','$bl_tp',now())" ;
          
          $outs = mysqli_query($link,$sqls);
          $lastids=mysqli_insert_id($link);
          if($counts>0){
            for($i=0;$i<$counts;$i++){
              if(trim($_POST["containerNo"][$i])!=""){
                $result=mysqli_query($link,"INSERT INTO follow_con (bid,conNo) VALUES ('$lastids','$containerNo[$i]')");
              }
            }
          }

          if($outs){
              $div="<script>
                          swal('New follow up added successfully!','','success')
                          $('#form_bl')[0].reset();
                          setTimeout(function(){
                            window.location.href='view_follow?$rand1&&updated=successful'
                          },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A follow up was added on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);

          }
          else{
          $div=" <script>
                  swal('Error Occurred while submitting details, Try again!','','error')
              </script>
              ";
           }
      }//END MAIN ELSE
  }
  //UPDATING BL
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $bl_bill = htmlentities($_POST['bl_bill']);
   /* @$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];*/
    $containerNo = htmlentities($_POST['containerNo']);
    $cust_name = htmlentities($_POST['cust_name']);
    $bl_eta = htmlentities($_POST['bl_eta']);
    $bl_exam = htmlentities($_POST['bl_exam']);
    $bl_port = htmlentities($_POST['bl_port']);
    $bl_size = htmlentities($_POST['bl_size']);
    $bl_tp = htmlentities($_POST['bl_tp']);

    if($bl_bill!=null){
        $ref_update=mysqli_query($link,"UPDATE tbl_follow SET blNo='$bl_bill',containerNo='$containerNo',customerName='$cust_name',eta='$bl_eta',placeExam='$bl_exam',podischarge='$bl_port',size='$bl_size',tdo='$bl_tp' WHERE bid='$id'");
        
        $div="<script>
                      swal('The follow up was updated successfully!','','success')
                      setTimeout(function(){
                        window.location.href='view_follow?$rand1&&updated=successful'
                      },3000)
                  </script>
                  ";
            if($ref_update){
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A follow up update was made on $date by ";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);
            }
      }
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
            <h2 class="display-2 text-white">Add Follow up Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="view_follow?<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Follow up</a>
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
              <form id="form_bl" name="form_bl" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <div class="text-center text-uppercase"><h2>Add Follow up</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_bill">BL Number</label>
                        <input type="text" id="bl_bill" name="bl_bill" class="form-control text-uppercase" placeholder="BL Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$bl_bill;} ?>">
                      </div>
                    </div>
                     <!-- CONTAINER NUMBER -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="containerNo">Container Number</label>
                        <input type="text" id="containerNo" name="containerNo" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$containerNo;} ?>">
                      </div>
                    </div>
                    <!-- CONTAINER NUMBER -->
                    <!-- <div class="col-lg-12 mb-3" <?php if(isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                      <p class="small text-muted">Click on the plus sign to add more container numbers</p>
                        <label class="form-control-label" for="containerNo">Container Number</label>
                      <div class="form-row">
                        <input type="text" id="c" name="containerNo[]" class="form-control text-uppercase col-md-6" placeholder="Container Number" maxlength="20" value="">
                        <button type="button" class="btn btn-primary ml-2" id="plusBtn" name="plusBtn">+</button>
                        <div class="col-lg-12" id="addContainer"></div>
                      </div>
                    </div>
                    <div class="col-lg-12" <?php if(!isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                            <?=@$options;?>
                    </div> -->
                </div>
                  <div class="row">
                    <!-- CUSTOMER NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="cust_name">Customer Name</label>
                        <input type="text" id="cust_name" name="cust_name" class="form-control text-uppercase" placeholder="Customer Name" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$cust_name;} ?>">
                      </div>
                    </div>
                    
                    <!-- EXACT TIME OF ARRIVAL -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_eta">Exact Time of Arrival</label>
                        <input type="date" id="bl_eta" name="bl_eta" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$bl_eta;} ?>">
                      </div>
                    </div>
                    <!-- PLACE OF EXAMINATION -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_exam">Place of Examination</label>
                          <input type="text" id="bl_exam" name="bl_exam" class="form-control text-uppercase" placeholder="Place of Examination" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$bl_exam;} ?>">
                        </div>
                      </div>
                      <!-- PORT OF DISCHARGE -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_port">Port of Discharge</label>
                          <input type="text" id="bl_port" name="bl_port" class="form-control text-uppercase" placeholder="Port of Discharge" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$bl_port;} ?>">
                        </div>
                      </div>
                    <!-- SIZE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_size">Container Size</label>
                        <input type="text" id="bl_size" name="bl_size" class="form-control text-uppercase" placeholder="Container Size" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$bl_size;} ?>">
                      </div>
                    </div>
                    <!-- SIZE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_tp">Transport Delivery Order</label>
                        <input type="text" id="bl_tp" name="bl_tp" class="form-control text-uppercase" placeholder="Transport Delivery Status" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$bl_tp;} ?>">
                      </div>
                    </div>
                    <div class="col-6 pl-lg-4" style="margin-top:2rem;">
                      <button type="submit" id="btn_bl" name="btn_bl" class="btn btn-default" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                      <?=@$update_btn; ?>
                    </div>
                  </div>
                </div><!-- END ROW -->
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>