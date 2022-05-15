<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Secretary" || $list=="Administrator"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$id'");
      $row=mysqli_fetch_array($result);
      //SELECTING FOR CONTAINER NUMBER
      $results=mysqli_query($link,"SELECT * FROM container_seal WHERE tid='$id'");
        $i=1;
         @$options="<label class='form-control-label text-danger' for='containerNo'><i>Click on save to update container numbers and seal no. for BL: $row[1]</i></label>";
       while ($rowCon=mysqli_fetch_array($results)) {
        @$options.="<div class='form-row mb-3'>
          <input type='hidden' name='idcon' id='idcon$i' class='form-control text-uppercase col-md-6' value='$rowCon[0]'>
          <input type='text' name='upcon' id='$i' class='form-control text-uppercase col-4' placeholder='Container Number' maxlength='20' value='$rowCon[2]'>
          <input type='text' name='upseal' id='sn$i' class='form-control text-uppercase col-4 ml-2' placeholder='Seal Number' maxlength='20' value='$rowCon[3]'>
          <button type='button' class='btn btn-primary ml-2' data-id='$i' id='trans-upBtn' name='trans-upBtn'>Save</button>
        </div>
        ";
        $i++;
      }
  }
  //UPDATING TRANSIRE
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $input_bill = htmlentities($_POST['input_bill']);
    $input_ship_name = htmlentities($_POST['input_ship_name']);
    $input_discharge = htmlentities($_POST['input_discharge']);
    $input_contry = htmlentities($_POST['input_contry']);
    $input_fraction = htmlentities($_POST['input_fraction']);
    $input_contype = htmlentities($_POST['input_contype']);
    /*$input_container = htmlentities($_POST['input_container']);
    $input_seal = htmlentities($_POST['input_seal']);*/
    $input_import = htmlentities($_POST['input_import']);
    $input_adress = htmlentities($_POST['input_adress']);
    $input_desc = htmlentities($_POST['input_desc']);
    $input_weight = htmlentities($_POST['input_weight']);
    if($input_contype=="choose"){
      $input_contype=$row[6];
    }
    else{
      $input_contype=$input_contype;
    }
    $ref_update=mysqli_query($link,"UPDATE tbl_transire SET bol='$input_bill',shiprotate='$input_ship_name',portofdischarge='$input_discharge',coo='$input_contry',fracNo='$input_fraction',toc='$input_contype',importName='$input_import',address='$input_adress',dogs='$input_desc',weight='$input_weight' WHERE tid='$id'");
    $div="<script>
            swal('Transire was updated successfully!','','success')
            setTimeout(function(){
          window.location.href='view_transire?$rand1&&id'
          },3000)
        </script>
        ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A transire update was made on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
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
            <h2 class="display-2 text-white">Add Transire Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <?php if($list=="Secretary"){$link="view_transire?$rand1";}else{$link="manage-transire?mg=$rand2";} ?>
            <a href="<?=$link?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Transire</a>
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
                  <h3 class="mb-0">Transire Manifest </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_transire" name="form_transire" action="" method="POST">
                <div class="text-center text-uppercase"><h2>Add Transire form</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <input type="hidden" id="conID" name="conID" class="form-control">
                <input type="hidden" id="input_bill_copy" name="input_bill_copy" class="form-control text-uppercase">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_bill">Bill of Lading</label>
                        <input type="text" id="input_bill" name="input_bill" class="form-control text-uppercase" placeholder="Bill of Lading" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_ship_name">Name of ship rotation no.</label>
                        <input type="text" id="input_ship_name" name="input_ship_name" class="form-control text-uppercase" placeholder="Name of ship rotation no." value="<?php if(isset($_GET['ed'])){echo $row[2];}else{} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_discharge">Port of Discharge</label>
                        <input type="text" id="input_discharge" name="input_discharge" class="form-control text-uppercase" placeholder="Enter Port of discharge" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_contry">Country of origin</label>
                        <input type="text" id="input_contry" name="input_contry" class="form-control text-uppercase" placeholder="Country of origin" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{} ?>">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_fraction">Fractional Numbering</label>
                        <input type="text" id="input_fraction" name="input_fraction" class="form-control" placeholder="Fractional Numbering" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{} ?>">
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_contype">Type of Container 20/40</label>
                        <select class="form-control text-uppercase" name="input_contype" id="input_contype">
                          <option value="choose">Choose Type</option>
                          <option value="20 FT">20 FT</option>
                          <option value="40 FT">40 FT</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-12 mb-3" <?php if(isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                        <p class="small text-muted">Click on the plus sign to add more container numbers and seal number</p>
                        <label class="form-control-label" for="input_container">Container No.</label>
                        <label class="form-control-label" style="margin-left:14rem;" for="input_seal">Seal No.</label>
                      <div class="form-row">
                        <input type="text" id="input_container" name="input_container[]" class="form-control text-uppercase col-4" placeholder="Container No." maxlength="20">
                        <input type="text" id="input_seal" name="input_seal[]" class="form-control text-uppercase col-4 ml-5" placeholder="Seal No" maxlength="20">
                        <button type="button" class="btn btn-primary ml-2" id="plusBtn1" name="plusBtn1">+</button>
                        <div class="col-lg-12" id="addContainer"></div>
                      </div>
                    </div>
                    <div class="col-lg-12" <?php if(!isset($_GET['ed'])){ echo "style=display:none;";} ?>>
                            <?=@$options;?>
                    </div>
                    <!--div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_seal">Seal No.</label>
                        <input type="text" id="input_seal" name="input_seal" class="form-control text-uppercase" placeholder="Seal No" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{} ?>">
                      </div>
                    </div-->
                    <div class="col-12 mb-3"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_import">Importers Name</label>
                        <input type="text" id="input_import" name="input_import" class="form-control text-uppercase" placeholder="Importers Name" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{} ?>">
                      </div>
                    </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input_adress">Address</label>
                          <input type="text" id="input_adress" name="input_adress" class="form-control text-uppercase" placeholder="Importers Address" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{} ?>">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input_desc">Description of Goods</label>
                          <input type="text" id="input_desc" name="input_desc" class="form-control text-uppercase" placeholder="Description of Goods" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{} ?>">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input_weight">Weight Net (KG)</label>
                          <input type="text" id="input_weight" name="input_weight" class="form-control text-uppercase" placeholder="Weight (KG)" value="<?php if(isset($_GET['ed'])){echo $row[10];}else{} ?>">
                        </div>
                      </div>
                  </div><!-- END ROW -->
                </div><!-- SECOND PART -->
                <div class="col-12 text-right">
                  <button type="button" id="btn_trans" name="btn_trans" class="btn btn-primary" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>