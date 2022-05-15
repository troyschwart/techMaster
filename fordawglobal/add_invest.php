<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Accountant" || $list=="Administrator"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE sn='$id'");
      $row=mysqli_fetch_array($result);
  }
  //INSERT THE INVESTMENT
  $input_cpc=$input_duty=$input_settle=$input_naf=$input_son=$input_advice=$input_con=$input_ship=$input_term=$input_transp=$input_paar=$input_other=0;
  if(isset($_POST['btn_invest'])){
    $input_bl = htmlentities($_POST['input_bl']);
    $input_cont = htmlentities($_POST['input_cont']);
    $input_siz = htmlentities($_POST['input_siz']);
    $input_eta = htmlentities($_POST['input_eta']);
    $input_dat = htmlentities($_POST['input_dat']);
    $input_tog = htmlentities($_POST['input_tog']);
    $input_cus = htmlentities($_POST['input_cus']);
    $input_advice = htmlentities($_POST['input_advice']);
    $input_advice=str_replace(",","", $input_advice);
    $input_con = htmlentities($_POST['input_con']);
    $input_con=str_replace(",","", $input_con);
    $input_ship = htmlentities($_POST['input_ship']);
    $input_ship=str_replace(",","", $input_ship);
    $input_term = htmlentities($_POST['input_term']);
    $input_term=str_replace(",","", $input_term);
    $input_transp = htmlentities($_POST['input_transp']);
    $input_transp=str_replace(",","", $input_transp);
    $input_paar = htmlentities($_POST['input_paar']);
    $input_paar=str_replace(",","", $input_paar);
    $input_cpc = htmlentities($_POST['input_cpc']);
    $input_cpc=str_replace(",","", $input_cpc);
    $input_duty = htmlentities($_POST['input_duty']);
    $input_duty=str_replace(",","", $input_duty);
    $input_settle = htmlentities($_POST['input_settle']);
    $input_settle=str_replace(",","", $input_settle);
    $input_naf = htmlentities($_POST['input_naf']);
    $input_naf=str_replace(",","", $input_naf);
    $input_son = htmlentities($_POST['input_son']);
    $input_son=str_replace(",","", $input_son);
    $input_other = htmlentities($_POST['input_other']);
    $input_total=$input_advice+$input_con+$input_ship+$input_term+$input_transp+$input_paar+$input_cpc+$input_duty+$input_settle+$input_naf+$input_son;
    //CHECKING FOR BL'S ADDED
    $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$input_bl'");
    $row=mysqli_fetch_array($result);
    //VALIDATING FIELDS
    if($input_bl=='' | $input_siz=='' | $input_eta=='' | $input_dat=='' | $input_tof=='' | $input_cus==''){
        $div=" <script>
            swal('Please make sure that the first 6 fields are filled correctly!','','error')
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
        $sqls = "INSERT INTO tbl_invest (blNo,size,eta,regDate,tog,cusName,advice,contDep,ship,term,transp,paar,cpc,duty,settle,naf,son,others,totals,postDate,conNo) VALUES ('$input_bl','$input_siz','$input_eta','$input_dat','$input_tof','$input_cus','$input_advice','$input_con','$input_ship','$input_term','$input_transp','$input_paar','$input_cpc','$input_duty','$input_settle','$input_naf','$input_son','$input_other','$input_total',now(),'$input_cont')" ;
        $outs = mysqli_query($link,$sqls);
        if($outs){
            $div="<script>
                        swal('New amount investment added successfully!','','success')
                        setTimeout(function(){
                        window.location.href='add_invest?inv=$rand1&'
                        },3000)
                    </script>
                    ";
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" An amount investment was added on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
        else{
        $div=" <script>
                swal('Submission failed, Try again!','','warning')
            </script>
            ";
         }
    }
  }

  //UPDATING INVESTMENT
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $input_bl = htmlentities($_POST['input_bl']);
    $input_cont = htmlentities($_POST['input_cont']);
    $input_siz = htmlentities($_POST['input_siz']);
    $input_eta = htmlentities($_POST['input_eta']);
    $input_dat = htmlentities($_POST['input_dat']);
    $input_tog = htmlentities($_POST['input_tog']);
    $input_cus = htmlentities($_POST['input_cus']);
    $input_advice = htmlentities($_POST['input_advice']);
    $input_advice=str_replace(",","", $input_advice);
    $input_con = htmlentities($_POST['input_con']);
    $input_con=str_replace(",","", $input_con);
    $input_ship = htmlentities($_POST['input_ship']);
    $input_ship=str_replace(",","", $input_ship);
    $input_term = htmlentities($_POST['input_term']);
    $input_term=str_replace(",","", $input_term);
    $input_transp = htmlentities($_POST['input_transp']);
    $input_transp=str_replace(",","", $input_transp);
    $input_paar = htmlentities($_POST['input_paar']);
    $input_paar=str_replace(",","", $input_paar);
    $input_cpc = htmlentities($_POST['input_cpc']);
    $input_cpc=str_replace(",","", $input_cpc);
    $input_duty = htmlentities($_POST['input_duty']);
    $input_duty=str_replace(",","", $input_duty);
    $input_settle = htmlentities($_POST['input_settle']);
    $input_settle=str_replace(",","", $input_settle);
    $input_naf = htmlentities($_POST['input_naf']);
    $input_naf=str_replace(",","", $input_naf);
    $input_son = htmlentities($_POST['input_son']);
    $input_son=str_replace(",","", $input_son);
    $input_other = htmlentities($_POST['input_other']);
    $input_total=$input_advice+$input_con+$input_ship+$input_term+$input_transp+$input_paar+$input_cpc+$input_duty+$input_settle+$input_naf+$input_son;
    $ref_update=mysqli_query($link,"UPDATE tbl_invest SET blNo='$input_bl',size='$input_siz',eta='$input_eta',regDate='$input_dat',tog='$input_tog',cusName='$input_cus',advice='$input_advice',contDep='$input_con',ship='$input_ship',term='$input_term',transp='$input_transp',paar='$input_paar',cpc='$input_cpc',duty='$input_duty',settle='$input_settle',naf='$input_naf',son='$input_son',others='$input_other',totals='$input_total',conNo='$input_cont' WHERE sn='$id'");
    $div="<script>
            swal('Investment was updated successfully!','','success')
            setTimeout(function(){
          window.location.href='view_invest?$rand1&&id'
          },3000)
        </script>
        ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A Investment update was made on $date by ";
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
            <h2 class="display-2 text-white">Add Investment Page</h2>
            <a href="view_invest?<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Investment</a>
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
                  <h3 class="mb-0">Outstanding Jobs </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_Investment" name="form_Investment" action="" method="POST">
                <div class="text-center text-uppercase"><h2>Add Investment form</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_bl">BL Number</label>
                        <input type="text" id="input_bl" name="input_bl" class="form-control text-uppercase" placeholder="Enter Bill of Lading" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$input_bl;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_cont">Container Number</label>
                        <input type="text" id="input_cont" name="input_cont" class="form-control text-uppercase" placeholder="Enter Bill of Lading" maxlength="20" value="<?php if(isset($_GET['ed'])){echo $row[20];}else{echo @$input_cont;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_siz">Size</label>
                        <input type="text" id="input_siz" name="input_siz" class="form-control text-uppercase" placeholder="Enter size" value="<?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$input_siz;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_eta">E.T.A</label>
                        <input type="date" id="input_eta" name="input_eta" class="form-control text-uppercase" placeholder="Enter E.T.A" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$input_eta;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_dat">Registration Date</label>
                        <input type="date" id="input_dat" name="input_dat" class="form-control text-uppercase" placeholder="Enter Registration Date" value="<?php if(isset($_GET['ed'])){echo $row[4];}else{echo @$input_dat;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_tog">Type of Goods</label>
                        <input type="text" id="input_tog" name="input_tog" class="form-control text-uppercase" placeholder="Enter Type of goods" value="<?php if(isset($_GET['ed'])){echo $row[5];}else{echo @$input_tog;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_cus">Customer Name</label>
                        <input type="text" id="input_cus" name="input_cus" class="form-control text-uppercase" placeholder="Enter Customer Name" value="<?php if(isset($_GET['ed'])){echo $row[6];}else{echo @$input_cus;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_advice">Advice</label>
                        <input type="text" id="input_advice" name="input_advice" class="form-control text-uppercase add-invest" placeholder="Enter Advice" value="<?php if(isset($_GET['ed'])){echo $row[7];}else{echo @$input_advice;} ?>">
                        <input type="hidden" id="input_advice1" name="input_advice1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[7];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_con">Container Deposit</label>
                        <input type="text" id="input_con" name="input_con" class="form-control text-uppercase add-invest" placeholder="Enter Container Deposite" value="<?php if(isset($_GET['ed'])){echo $row[8];}else{echo @$input_con;} ?>">
                        <input type="hidden" id="input_con1" name="input_con1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[8];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_ship">Shipping</label>
                        <input type="text" id="input_ship" name="input_ship" class="form-control text-uppercase add-invest" placeholder="Enter Shipping" value="<?php if(isset($_GET['ed'])){echo $row[9];}else{echo @$input_ship;} ?>">
                        <input type="hidden" id="input_ship1" name="input_ship1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[9];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_term">Terminal</label>
                        <input type="text" id="input_term" name="input_term" class="form-control text-uppercase add-invest" placeholder="Enter Terminal" value="<?php if(isset($_GET['ed'])){echo $row[10];}else{echo @$input_term;} ?>">
                        <input type="hidden" id="input_term1" name="input_term1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[10];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_transp">Transport</label>
                        <input type="text" id="input_transp" name="input_transp" class="form-control text-uppercase add-invest" placeholder="Enter Transport" value="<?php if(isset($_GET['ed'])){echo $row[11];}else{echo @$input_transp;} ?>">
                        <input type="hidden" id="input_transp1" name="input_transp1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[11];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_paar">Paar</label>
                        <input type="text" id="input_paar" name="input_paar" class="form-control text-uppercase add-invest" placeholder="Enter Paar" value="<?php if(isset($_GET['ed'])){echo $row[12];}else{echo @$input_paar;} ?>">
                        <input type="hidden" id="input_paar1" name="input_paar1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[12];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_cpc">CPC/DTI</label>
                        <input type="text" id="input_cpc" name="input_cpc" class="form-control text-uppercase add-invest" placeholder="Enter CPC/DTI" value="<?php if(isset($_GET['ed'])){echo $row[13];}else{echo @$input_cpc;} ?>">
                        <input type="hidden" id="input_cpc1" name="input_cpc1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[13];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_duty">Duty Payable</label>
                        <input type="text" id="input_duty" name="input_duty" class="form-control text-uppercase add-invest" placeholder="Enter Duty Payable" value="<?php if(isset($_GET['ed'])){echo $row[14];}else{echo @$input_duty;} ?>">
                        <input type="hidden" id="input_duty1" name="input_duty1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[14];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_settle">Settlement</label>
                        <input type="text" id="input_settle" name="input_settle" class="form-control text-uppercase add-invest" placeholder="Enter Settlement" value="<?php if(isset($_GET['ed'])){echo $row[15];}else{echo @$input_settle;} ?>">
                        <input type="hidden" id="input_settle1" name="input_settle1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[15];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_naf">NAFDAC</label>
                        <input type="text" id="input_naf" name="input_naf" class="form-control text-uppercase add-invest" placeholder="Enter NAFDAC" value="<?php if(isset($_GET['ed'])){echo $row[16];}else{echo @$input_naf;} ?>">
                        <input type="hidden" id="input_naf1" name="input_naf1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[16];}?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_son">SON</label>
                        <input type="text" id="input_son" name="input_son" class="form-control text-uppercase add-invest" placeholder="Enter SON" value="<?php if(isset($_GET['ed'])){echo $row[17];}else{echo @$input_son;} ?>">
                        <input type="hidden" id="input_son1" name="input_son1" class="form-control" value="<?php if(isset($_GET['ed'])){echo $row[17];} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_other">Others</label>
                        <input type="text" id="input_other" name="input_other" class="form-control text-uppercase" placeholder="Enter Others" value="<?php if(isset($_GET['ed'])){echo $row[18];}else{echo @$input_other;} ?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_total">Totals</label>
                        <input type="text" id="input_total" name="input_total" class="form-control text-uppercase" placeholder="Enter Totals" value="<?php if(isset($_GET['ed'])){echo $row[19];}else{echo @$input_total;}?>" <?php if(isset($_GET['ed'])){echo 'style=pointer-events:none;';}?>>
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 ml-2 text-center">
                  <button type="submit" id="btn_invest" name="btn_invest" class="btn btn-warning" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>