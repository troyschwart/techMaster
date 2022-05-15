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
      $result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE bid='$id'");
      $row=mysqli_fetch_array($result);

      //SELECTING FOR CONTAINER NUMBER
      $results=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$id'");
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
    $consign = htmlentities($_POST['bl_consignee']);
    $bl_date = htmlentities($_POST['bl_date']);
    $bl_bill = htmlentities($_POST['bl_bill']);
    @$counts=count($_POST['containerNo']);
    @$containerNo = $_POST['containerNo'];
    $bl_size = htmlentities($_POST['bl_size']);
    $cust_name = htmlentities($_POST['cust_name']);
    $bl_doc = htmlentities($_POST['bl_doc']);
    $bl_eta = htmlentities($_POST['bl_eta']);
    $eta_status = htmlentities($_POST['eta_status']);
    $bl_paar = htmlentities($_POST['bl_paar']);
    $bl_debit = htmlentities($_POST['bl_debit']);
    $bl_exam = htmlentities($_POST['bl_exam']);
    $bl_port = htmlentities($_POST['bl_port']);
    $bl_release = htmlentities($_POST['bl_release']);

    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_bill WHERE blNo='$bl_bill'");
    $row=mysqli_fetch_array($result);

   
    if($consign=='' | $bl_date==''| $bl_bill=='' | $bl_size=='' | $cust_name==''| $bl_doc=='choose' | $bl_eta=='' | $bl_paar==''| $bl_debit=='' | $bl_exam=='' | $bl_port=='' | $bl_release=='choose'){
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
          $sqls = "INSERT INTO tbl_bill (blDate,blNo,size,customerName,documentStatus,eta,etaStatus,paar,debitNote,placeExam,podischarge,consign,releaseStatus,postDate) VALUES ('$bl_date','$bl_bill','$bl_size','$cust_name','$bl_doc','$bl_eta','$eta_status','$bl_paar','$bl_debit','$bl_exam','$bl_port','$consign','$bl_release',now())" ;
        
          $outs = mysqli_query($link,$sqls);
          $lastids=mysqli_insert_id($link);
          if($counts>0){
            for($i=0;$i<$counts;$i++){
              if(trim($_POST["containerNo"][$i])!=""){
                $result=mysqli_query($link,"INSERT INTO tbl_containers (bid,containerNo) VALUES ('$lastids','$containerNo[$i]')");

                 /*$sql_pro = "INSERT INTO tbl_prog (datee,blNo,conNo,size,typeGoods,consig,eta,releas,paar,terminal,postDate,delivryStatus) VALUES ('$bl_date','$bl_bill','$containerNo[$i]','$bl_size','$bl_debit','$consign','$bl_eta','$bl_release','$bl_paar','$bl_exam',now(),'no')" ;
                 $outs_pro = mysqli_query($link,$sql_pro);*/
              }
            }
          }

          if($outs){
              $div="<script>
                          swal('New bill of lading added successfully!','','success')
                          $('#form_bl')[0].reset();
                          setTimeout(function(){
                            window.location.href='view_bl?$rand1&'
                            },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A bill of lading was added on $date by ";
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
    $consign = htmlentities($_POST['bl_consignee']);
    $bl_date = htmlentities($_POST['bl_date']);
    $bl_bill = htmlentities($_POST['bl_bill']);
    $bl_size = htmlentities($_POST['bl_size']);
    $cust_name = htmlentities($_POST['cust_name']);
    $bl_doc = htmlentities($_POST['bl_doc']);
    $bl_eta = htmlentities($_POST['bl_eta']);
    $eta_status = htmlentities($_POST['eta_status']);
    $bl_paar = htmlentities($_POST['bl_paar']);
    $bl_debit = htmlentities($_POST['bl_debit']);
    $bl_exam = htmlentities($_POST['bl_exam']);
    $bl_port = htmlentities($_POST['bl_port']);
    $bl_release = htmlentities($_POST['bl_release']);
    //UPDATING DOCUMENT STATUS
    if($bl_doc=="choose"){
        $bl_doc=$row[5];
    }
    else{
        $bl_doc=$bl_doc;
    }
    //UPDATING RELEASE STATUS
    if($bl_release=="choose"){
        $bl_release=$row[12];
    }
    else{
        $bl_release=$bl_release;
    }
    
    if($bl_bill!=null){
        $ref_update=mysqli_query($link,"UPDATE tbl_bill SET blDate='$bl_date',blNo='$bl_bill',size='$bl_size',customerName='$cust_name',documentStatus='$bl_doc',eta='$bl_eta',etaStatus='$eta_status',paar='$bl_paar',debitNote='$bl_debit',placeExam='$bl_exam',podischarge='$bl_port',releaseStatus='$bl_release',postDate=now(),consign='$consign' WHERE bid='$id'");
        
        $div="<script>
                      swal('The BL was updated successfully!','','success')
                      setTimeout(function(){
                    window.location.href='view_bl?$rand1&&updated=successful'
                    },3000)
                  </script>
                  ";
            if($ref_update){
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A Bill of Lading update was made on $date by ";
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
            <h2 class="display-2 text-white">Add Bill of Lading Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="view_bl?<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Billings</a>
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
                <div class="text-center text-uppercase"><h2>Add Bill of Lading</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- CONSIGNEE'S NAME -->
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_consignee">Consignee's Name</label>
                        <input type="text" id="bl_consignee" name="bl_consignee" class="form-control text-uppercase" placeholder="Enter Consignee name" value="<?php if(isset($_GET['ed'])){echo $row[16];}else{echo @$consign;} ?>">
                      </div>
                    </div>
                    <!-- DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_date">Date</label>
                        <input type="date" id="bl_date" name="bl_date" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$bl_date;} ?>">
                      </div>
                    </div>
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_bill">Bill of Lading</label>
                        <input type="text" id="bl_bill" name="bl_bill" class="form-control text-uppercase" placeholder="Bill of Landing" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$bl_bill;} ?>">
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
                    <div class="col-lg-12" <?php if(!isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                            <?=@$options;?>
                    </div>
                   <!-- SIZE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_size">Container Size</label>
                        <input type="text" id="bl_size" name="bl_size" class="form-control text-uppercase" placeholder="Container Size" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$bl_size;} ?>">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
               
                <!-- SECOND PART -->
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- CUSTOMER NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="cust_name">Customer Name</label>
                        <input type="text" id="cust_name" name="cust_name" class="form-control text-uppercase" placeholder="Customer Name" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$cust_name;} ?>">
                      </div>
                    </div>
                    <!-- DOCUMENT STATUS -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_doc">Bill of lading Status</label>
                          <select class="form-control text-uppercase" name="bl_doc" id="bl_doc">
                            <option value="choose">Choose Status</option>
                            <option value="draft">Draft</option>
                            <option value="telex">Telex</option>
                            <option value="Original BL">Original BL</option>
                          </select>
                        </div>
                      </div>
                    <!-- EXACT TIME OF ARRIVAL -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_eta">Exact Time of Arrival</label>
                        <input type="date" id="bl_eta" name="bl_eta" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$bl_eta;} ?>">
                      </div>
                    </div>
                    <!-- E.T.A STATUS -->
                    <div class="col-lg-6" style="display:none;">
                      <div class="form-group">
                        <label class="form-control-label" for="eta_status">E.T.A status</label>
                        <input type="text" id="eta_status" name="eta_status" class="form-control text-uppercase" placeholder="E.T.A status" value="NIL">
                      </div>
                    </div>
                    <!-- PAAR -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_paar">PAAR</label>
                        <!-- <select class="form-control text-uppercase" name="bl_paar" id="bl_paar">
                            <option value="choose">Choose Paar</option>
                            <option value="Ready">Ready</option>
                            <option value="Not Ready">Not Ready</option>
                          </select> -->
                          <input type="text" id="bl_paar" name="bl_paar" class="form-control text-uppercase" placeholder="Enter Paar" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$bl_paar;} ?>">
                      </div>
                    </div>
                    <!-- DEBIT NOTE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_debit">Type of items/goods</label>
                        <input type="text" id="bl_debit" name="bl_debit" class="form-control text-uppercase" placeholder="Type of items" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{echo @$bl_debit;} ?>">
                      </div>
                    </div>
                    <!-- PLACE OF EXAMINATION -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_exam">Place of Examination</label>
                          <input type="text" id="bl_exam" name="bl_exam" class="form-control text-uppercase" placeholder="Place of Examination" value="<?php if(isset($_GET['ed'])){echo $row[10];}else{echo @$bl_exam;} ?>">
                        </div>
                      </div>
                      <!-- PORT OF DISCHARGE -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_port">Port of Discharge</label>
                          <input type="text" id="bl_port" name="bl_port" class="form-control text-uppercase" placeholder="Port of Discharge" value="<?php if(isset($_GET['ed'])){echo $row[11];}else{echo @$bl_port;} ?>">
                        </div>
                      </div>
                      <!-- RELEASE STATUS -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_release">Release Status</label>
                          <select class="form-control text-uppercase" name="bl_release" id="bl_release">
                            <option value="choose">Choose Status</option>
                            <option value="Released">Released</option>
                            <option value="Not Released">Not Released</option>
                          </select>
                        </div>
                      </div>
                  </div><!-- END ROW -->
                </div><!-- SECOND PART -->
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn_bl" name="btn_bl" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>