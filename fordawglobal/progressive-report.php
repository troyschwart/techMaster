<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Administrator" | $list=="Shipping Manager"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_prog WHERE pid='$id'");
      $row=mysqli_fetch_array($result);
      $blno=$row[2];
      //AUTO FETCHING CONTAINER NUMBER FROM BL NUMBER
      $results=mysqli_query($link,"SELECT * FROM tbl_bill WHERE blNo='$blno'");
      $rowBl=mysqli_fetch_array($results);
      $bid=$rowBl[0];
      $res=mysqli_query($link,"SELECT * FROM tbl_containers WHERE bid='$bid'");
      while($row_=mysqli_fetch_array($res)){
          @$optCon.="<option value='$row_[2]'>$row_[2]</option>";
      }
  }
  //ADDING THE BL
  if(isset($_POST['btn_prog'])){
    $bl_date = htmlentities($_POST['bl_date']);
    $bl_bill = htmlentities($_POST['bl_bill']);
    $containerNo = htmlentities($_POST['containerNo']);
    $bl_size = htmlentities($_POST['bl_size']);
    $typegoods = htmlentities($_POST['typegoods']);
    $bl_consignee = htmlentities($_POST['bl_consignee']);
    $bl_eta = htmlentities(ucwords($_POST['bl_eta']));
    $bl_release = htmlentities(ucwords($_POST['bl_release']));
    $bl_paar = htmlentities($_POST['bl_paar']);
    $bl_import = htmlentities(ucwords($_POST['bl_import']));
    $bl_term = htmlentities($_POST['bl_term']);
    $bl_deliv = htmlentities($_POST['bl_deliv']);
    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_prog WHERE blNo='$bl_bill'");
    $row=mysqli_fetch_array($result);

    if($bl_date=='' | $bl_bill==''| $containerNo=='' | $bl_size==''){
        $div=" <script>
            swal('Please make sure that all fields are field correctly!','','error')
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
          $sqls = "INSERT INTO tbl_prog (datee,blNo,conNo,size,typeGoods,consig,eta,releas,paar,impot,terminal,delivered,postDate) VALUES ('$bl_date','$bl_bill','$containerNo','$bl_size','$typegoods','$bl_consignee','$bl_eta','$bl_release','$bl_paar','$bl_import','$bl_term','$bl_deliv',now())" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
                        swal('Progressive report added successfully!','','success')
                        $('#form_prog')[0].reset();
                    </script> 
                    ";
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A progressive report was made on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
        else{
        $div=" <script>
                swal('Could not submit details, Try again!','','warning')
            </script>
            ";
         }
    }//END MAIN ELSE
}
  //UPDATING BL
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $bl_date = htmlentities($_POST['bl_date']);
    $bl_bill = htmlentities($_POST['bl_bill']);
    $containerNo = htmlentities($_POST['containerNo']);
    $bl_size = htmlentities($_POST['bl_size']);
    $bl_cusname = htmlentities($_POST['bl_cusname']);
    $typegoods = htmlentities($_POST['typegoods']);
    $bl_consignee = htmlentities($_POST['bl_consignee']);
    $bl_eta = htmlentities(ucwords($_POST['bl_eta']));
    $bl_release = htmlentities(ucwords($_POST['bl_release']));
    $bl_paar = htmlentities($_POST['bl_paar']);
    $bl_import = htmlentities(ucwords($_POST['bl_import']));
    $bl_term = htmlentities($_POST['bl_term']);
    $bl_deliv = htmlentities($_POST['bl_deliv']);
    //UPDATING PAAR
    if($bl_paar==""){
        $bl_paar=$row[9];
    }
    else{
        $bl_paar=$bl_paar;
    }
    //UPDATING RELEASE STATUS
    if($bl_release==""){
        $bl_release=$row[8];
    }
    else{
        $bl_release=$bl_release;
    }
        $ref_update=mysqli_query($link,"UPDATE tbl_prog SET datee='$bl_date',blNo='$bl_bill',conNo='$containerNo',size='$bl_size',customerName='$bl_cusname',typeGoods='$typegoods',consig='$bl_consignee',eta='$bl_eta',releas='$bl_release',paar='$bl_paar',impot='$bl_import',terminal='$bl_term',delivered='$bl_deliv' WHERE pid='$id'");

        $div="<script>
                      swal('The progressive report was updated successfully!','','success')
                      setTimeout(function(){
                    window.location.href='view_prog?$rand1&&updated=successful'
                    },3000)
                  </script>
                  ";
            if($ref_update){
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A progressive report update was made on $date by ";
                $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
                $out1 = mysqli_query($link,$sql1);
            }
   }
   if(!isset($_GET['ed'])){
      @$div="<script>
            setTimeout(function(){
              window.location='view_prog?$rand1&vc&$rand2'
              })
        </script>
        ";
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
            <h2 class="display-2 text-white">Progressive Report Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="view_prog?<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Reports</a>
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
              <form id="form_prog" name="form_prog" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <!-- <h6 class="heading-small text-muted mb-4">
                  <a href="view_prog?vp=<?=$rand2?>" class="btn btn-primary btn-sm">Progressive Report</a>
                  <a href="view_prog?vr=<?=$rand2?>" class="btn btn-warning  btn-sm">Release Status</a>
                  <a href="view_prog?vl=<?=$rand2?>" class="btn btn-success btn-sm">Load Status</a>
                  <a href="view_prog?va=<?=$rand2?>" class="btn btn-danger btn-sm">Arrival Status</a>
                  <a href="view_prog?vd=<?=$rand2?>" class="btn btn-info btn-sm">Delivered Jobs</a> 
                </h6> -->
                <div class="pl-lg-4">
                  <div class="row">
                     <!-- DATE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_date">Date</label>
                        <input type="date" id="bl_date" name="bl_date" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$bl_date;} ?>">
                      </div>
                    </div>
                    <!-- BILLING OF LANDING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_bill">Bill of Lading</label>
                        <input type="text" id="bl_bill" name="bl_bill" class="form-control text-uppercase" placeholder="Enter Bill of Lading" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$bl_bill;} ?>">
                      </div>
                    </div>
                    <!-- CONTAINER NUMBER -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="containerNo">Container Number</label>
                        <input type="text" id="containerNo" name="containerNo" class="form-control text-uppercase" placeholder="Enter Bill of Lading" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$containerNo;} ?>">
                        <!-- <select class="form-control" name="containerNo" id="containerNo">
                            <option value="">Select the container here</option>
                            <?=@$optCon;?>
                        </select> -->
                      </div>
                    </div>
                    <!-- SIZE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_size">Size</label>
                        <input type="text" id="bl_size" name="bl_size" class="form-control text-uppercase" placeholder="Enter Size" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$bl_size;} ?>">
                      </div>
                    </div>
                     <!-- CUSTOMER NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bL_cusname">Customer Name</label>
                        <input type="text" id="bl_cusname" name="bl_cusname" class="form-control text-uppercase" placeholder="Enter Size" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$bl_cusname;} ?>">
                      </div>
                    </div>
                    <!-- TYPE OF GOODS -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="typegoods">Type of Goods</label>
                        <input type="text" id="typegoods" name="typegoods" class="form-control text-uppercase" placeholder="Enter Type of Goods" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$typegoods;} ?>">
                      </div>
                    </div>
                    <!-- CONSIGNEE'S NAME -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_consignee">Consignee's Name</label>
                        <input type="text" id="bl_consignee" name="bl_consignee" class="form-control text-uppercase" placeholder="Enter Consignee name" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$bl_consignee;} ?>">
                      </div>
                    </div>
                    <!-- EXACT TIME OF ARRIVAL -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_eta">Exact Time of Arrival</label>
                        <input type="date" id="bl_eta" name="bl_eta" class="form-control" placeholder="Choose Date" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$bl_eta;} ?>">
                      </div>
                    </div>
                    <!-- RELEASE STATUS -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_release">Release Status</label>
                        <select class="form-control text-uppercase" name="bl_release" id="bl_release">
                          <option value="">Choose Status</option>
                          <option value="Released">Released</option>
                          <option value="Not Released">Not Released</option>
                        </select>
                        <!-- <input type="date" id="bl_release" name="bl_release" class="form-control" placeholder="Release Status" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$bl_release;} ?>"> -->
                      </div>
                    </div>
                    <!-- PAAR -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_paar">PAAR</label>
                        <select class="form-control text-uppercase" name="bl_paar" id="bl_paar">
                            <option value="">Choose Paar</option>
                            <option value="Ready">Ready</option>
                            <option value="Not Ready">Not Ready</option>
                          </select>
                          <!-- <input type="date" id="bl_paar" name="bl_paar" class="form-control" placeholder="PAAR" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$bl_paar;} ?>"> -->
                      </div>
                    </div>
                    <!-- IMPORT INVOICE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_import">Import</label>
                        <input type="text" id="bl_import" name="bl_import" class="form-control text-uppercase" placeholder="Enter Import" value="<?php if(isset($_GET['ed'])){echo $row[11];}else{echo @$bl_import;} ?>">
                      </div>
                    </div>
                      <!-- PLACE OF EXAMINATION -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_term">Terminal</label>
                          <input type="text" id="bl_term" name="bl_term" class="form-control text-uppercase" placeholder="Enter Terminal" value="<?php if(isset($_GET['ed'])){echo $row[12];}else{echo @$bl_term;} ?>">
                        </div>
                      </div>
                      <!-- DELIVERY ORDER -->
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="bl_deliv">Delivered</label>
                          <input type="text" id="bl_deliv" name="bl_deliv" class="form-control text-uppercase" placeholder="Enter Delivered" value="<?php if(isset($_GET['ed'])){echo $row[13];}else{echo @$bl_deliv;} ?>">
                        </div>
                      </div>
                  </div><!-- END ROW -->
                </div><!-- SECOND PART -->
                <div class="col-12 pl-lg-4">
                  <!-- <button type="submit" id="btn_prog" name="btn_prog" class="btn btn-primary" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button> -->
                  <?=@$update_btn; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>