<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Manager" || $list=="Administrator"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_cusexam WHERE cid='$id'");
      $row=mysqli_fetch_array($result);
  }
  //ADDING THE BL
  if(isset($_POST['btn_bl'])){
    $bl_bill = htmlentities($_POST['bl_bill']);
    $conNo = htmlentities($_POST['conNo']);
    $cpc_ce = htmlentities($_POST['cpc_ce']);
    $cpc_ce=str_replace(",","", $cpc_ce);
    $duty_ce = htmlentities($_POST['duty_ce']);
    $duty_ce=str_replace(",","", $duty_ce);
    $settle_ce = htmlentities($_POST['settle_ce']);
    $settle_ce=str_replace(",","", $settle_ce);
    $port_ce = htmlentities($_POST['port_ce']);
    $port_ce=str_replace(",","", $port_ce);
    $naf_ce = htmlentities($_POST['naf_ce']);
    $naf_ce=str_replace(",","", $naf_ce);
    $son_ce = htmlentities($_POST['son_ce']);
    $son_ce=str_replace(",","", $son_ce);
    $type_ce = htmlentities($_POST['type_ce']);
    $other_ce = htmlentities($_POST['other_ce']);
    $other_ce=str_replace(",","", $other_ce);
    $total=$cpc_ce+$duty_ce+$settle_ce+$port_ce+$naf_ce+$son_ce+$other_ce;
    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$bl_bill' AND conNo='$conNo'");
    $result1=mysqli_query($link,"SELECT * FROM tbl_cusexam WHERE blNo='$bl_bill' AND conNo='$conNo'");
    if($bl_bill=='' | $conNo=='' | $cpc_ce=='' | $duty_ce=='' | $settle_ce=='' | $port_ce=='' | $naf_ce=='' | $son_ce=='' | $type_ce=='' | $other_ce==''){
        $div=" <script>
            swal('Please make sure that all fields are filled correctly!','','error')
        </script>
        ";
    }
    else if(mysqli_num_rows($result)==1){
     $ref_update=mysqli_query($link,"UPDATE tbl_invest SET cpc='$cpc_ce',duty='$duty_ce',settle='$settle_ce',term='$port_ce',naf='$naf_ce',son='$son_ce',tog='$type_ce',others='$other_ce' WHERE blNo='$bl_bill' AND conNo='$conNo'");
          $div="<script>
                swal('Custom examination updated on the record successfully!','','success')
                setTimeout(function(){
                    window.location.href='view_ce?e=$rand1'
                },3000)
            </script>
            ";
            if(mysqli_num_rows($result1)==0){
                $sqls = "INSERT INTO tbl_cusexam (blNo,conNo,cpc,duty,settle,portSer,naf,son,typeGood,others,postDate) VALUES ('$bl_bill','$conNo','$cpc_ce','$duty_ce','$settle_ce','$port_ce','$naf_ce','$son_ce','$type_ce','$other_ce',now())" ;
                 $outs = mysqli_query($link,$sqls);
            }
    }
    else{
          $sqls = "INSERT INTO tbl_cusexam (blNo,conNo,cpc,duty,settle,portSer,naf,son,typeGood,others,postDate) VALUES ('$bl_bill','$conNo','$cpc_ce','$duty_ce','$settle_ce','$port_ce','$naf_ce','$son_ce','$type_ce','$other_ce',now())" ;
          $outs = mysqli_query($link,$sqls);
          $sqls1 = "INSERT INTO tbl_invest (blNo,tog,term,cpc,duty,settle,naf,son,others,postDate,conNo) VALUES ('$bl_bill','$type_ce','$port_ce','$cpc_ce','$duty_ce','$settle_ce','$naf_ce','$son_ce','$other_ce',now(),'$conNo')" ;
        $outs = mysqli_query($link,$sqls1);
          if($outs){
              $div="<script>
                          swal('Custom Examination added successfully!','','success')
                          $('#form_ce')[0].reset();
                          setTimeout(function(){
                            window.location.href='view_ce?%$rand1%'
                        },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A custom examination was added on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);

          }
          else{
          $div=" <script>
                  swal('Error Occurred while submitting details','','error')
              </script>
              ";
           }
      }//END MAIN ELSE
  }
  //UPDATING BL
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $bl_bill = htmlentities($_POST['bl_bill']);
    $conNo = htmlentities($_POST['conNo']);
    $cpc_ce = htmlentities($_POST['cpc_ce']);
    $cpc_ce=str_replace(",","", $cpc_ce);
    $duty_ce = htmlentities($_POST['duty_ce']);
    $duty_ce=str_replace(",","", $duty_ce);
    $settle_ce = htmlentities($_POST['settle_ce']);
    $settle_ce=str_replace(",","", $settle_ce);
    $port_ce = htmlentities($_POST['port_ce']);
    $port_ce=str_replace(",","", $port_ce);
    $naf_ce = htmlentities($_POST['naf_ce']);
    $naf_ce=str_replace(",","", $naf_ce);
    $son_ce = htmlentities($_POST['son_ce']);
    $son_ce=str_replace(",","", $son_ce);
    $type_ce = htmlentities($_POST['type_ce']);
    $other_ce = htmlentities($_POST['other_ce']);
    $other_ce=str_replace(",","", $other_ce);
    //$total=$cpc_ce+$duty_ce+$settle_ce+$port_ce+$naf_ce+$son_ce+$other_ce;
    
    if($bl_bill!=null & $conNo!=null){
        $ref_update=mysqli_query($link,"UPDATE tbl_cusexam SET cpc='$cpc_ce',duty='$duty_ce',settle='$settle_ce',portSer='$port_ce',naf='$naf_ce',son='$son_ce',typeGood='$type_ce',others='$other_ce' WHERE cid='$id'");
        $ref_update1=mysqli_query($link,"UPDATE tbl_invest SET cpc='$cpc_ce',duty='$duty_ce',settle='$settle_ce',term='$port_ce',naf='$naf_ce',son='$son_ce',tog='$type_ce',others='$other_ce' WHERE blNo='$bl_bill' AND conNo='$conNo'");

        $div="<script>
                swal('The custom examination was updated successfully!','','success')
                setTimeout(function(){
              window.location.href='view_ce?%$rand1&%'
              },3000)
            </script>
            ";
            if($ref_update){
                $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
                $message=" A custom examination was update on $date by ";
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
            <h2 class="display-2 text-white">Custom Examination Page</h2>
            <a href="view_ce?<?=$rand1?>&<?=$rand2?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Custom Examination</a>
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
              <form id="form_ce" name="form_ce" action="" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                <h6 class="heading-small text-muted mb-4"></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- BILLING OF LADING -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_bill">Bill of Lading</label>
                        <input type="text" id="bl_bill" name="bl_bill" class="form-control text-uppercase" placeholder="Enter Bill of Landing" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$bl_bill;} ?>">
                      </div>
                    </div>
                     <!-- CONTAINER NUMBER -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="conNo">Container Number</label>
                        <input type="text" id="conNo" name="conNo" class="form-control text-uppercase" placeholder="Enter Container Number" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$conNo;} ?>">
                      </div>
                    </div>
                   <!--  <!-- CONTAINER NUMBER >
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
                    </div> -->
                    <!-- CPC/DTI -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="cpc_ce">CPC/DTI</label>
                        <input type="text" id="cpc_ce" name="cpc_ce" class="form-control text-uppercase" placeholder="Enter CPC/DTI" value="<?php if(isset($_GET['ed'])){echo number_format($row[3],2);}else{echo @$cpc_ce;} ?>">
                      </div>
                    </div>
                    <!-- DUTY PAYABLE -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="duty_ce">Duty Payable</label>
                        <input type="text" id="duty_ce" name="duty_ce" class="form-control text-uppercase" placeholder="Enter Duty Payable" value="<?php if(isset($_GET['ed'])){echo number_format($row[4],2);}else{echo @$duty_ce;} ?>">
                      </div>
                    </div>
                   <!-- CUSTOM SETTLEMENT -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="settle_ce">Custom Settlement</label>
                        <input type="text" id="settle_ce" name="settle_ce" class="form-control text-uppercase" placeholder="Enter Custom Settlement" value="<?php if(isset($_GET['ed'])){echo number_format($row[5],2);}else{echo @$settle_ce;} ?>">
                      </div>
                    </div>
                    <!-- PORT SERVICE CHARGES -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="port_ce">Port Service Charges</label>
                        <input type="text" id="port_ce" name="port_ce" class="form-control text-uppercase" placeholder="Enter Port Service Charges" value="<?php if(isset($_GET['ed'])){echo number_format($row[6],2);}else{echo @$port_ce;} ?>">
                      </div>
                    </div>
                    <!-- NAFDAC -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="naf_ce">NAFDAC</label>
                        <input type="text" id="naf_ce" name="naf_ce" class="form-control text-uppercase" placeholder="Enter NAFDAC" value="<?php if(isset($_GET['ed'])){echo number_format($row[7],2);}else{echo @$naf_ce;} ?>">
                      </div>
                    </div>
                    <!-- SON -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="son_ce">Son</label>
                        <input type="text" id="son_ce" name="son_ce" class="form-control text-uppercase" placeholder="Enter Son" value="<?php if(isset($_GET['ed'])){echo number_format($row[8],2);}else{echo @$son_ce;} ?>">
                      </div>
                    </div>
                    <!-- TYPE OF GOODS -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="type_ce">Type of Goods</label>
                        <input type="text" id="type_ce" name="type_ce" class="form-control text-uppercase" placeholder="Enter Type of Goods" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{echo @$type_ce;} ?>">
                      </div>
                    </div>
                    <!-- OTHERS -->
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="other_ce">Others</label>
                        <input type="text" id="other_ce" name="other_ce" class="form-control text-uppercase" placeholder="Enter Others" value="<?php if(isset($_GET['ed'])){echo number_format($row[10],2);}else{echo @$other_ce;} ?>">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
               
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