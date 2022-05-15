<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Accountant" || $list=="Administrator" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
$continue=false;
  //SELECTING COST BL DETAILS
  if(isset($_GET['1'])){
    $result=mysqli_query($link,"SELECT * FROM tbl_costbl ORDER BY costID DESC");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$options1.="
              <tr>
            <form id='form_updates' name='form_updates' action='' method='POST'>
            <td><span id='id-$row[0]'>$i</span><input type='text' id='id$row[0]' name='id_text' value='$row[0]' class='form-control' style='width:4rem;display:none;'></td>
            <td><a href='javascript:void(0)' id='bl-$row[0]' value='$row[1]' class='blID'>$row[1]</a><input type='text' class='form-control' value='$row[1]' id='bl$row[0]' style='width:8rem;display:none;' name='bl_text'></td>
            <td><span id='c$row[0]'>$row[7]<input type='text' class='form-control' value='$row[7]' id='c$row[0]' style='width:4rem;display:none;' name='c_text'></span></td>
            <td><span id='s-$row[0]'>$row[2]</span><input type='text' class='form-control' value='$row[2]' id='s$row[0]' style='width:4rem;display:none;' name='s_text'></td>
            <td><span id='e-$row[0]'>$row[6]</span><input type='text' class='form-control' value='$row[6]' id='e$row[0]' style='width:8rem;display:none;' name='e_text'></td>
            <td><span id='d-$row[0]'>$row[3]</span><input type='text' class='form-control' value='$row[3]' id='d$row[0]' style='display:none;' name='d_text'></td>
            <td><span id='a-$row[0]'>$row[4]</span><input type='text' class='form-control' value='$row[4]' id='a$row[0]' style='width:8rem;display:none;' name='a_text'></td>
            <td><span id='p$row[0]'>$row[5]</span></td>

            <td><a href='#!' class='btn btn-info btn-sm' role='button' id='updateID' value='$row[0]'><span class='fa fa-edit'>&nbsp;Edit</span></a>
            <button type='submit' class='btn btn-default btn-sm' role='button' id='update-btn$row[0]' name='update-btn' style='display:none;><span class='fa fa-location-arrow'>&nbsp;Update</span></button>
            <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span>&nbsp;Delete</button>
            </td>
          </form>
          </tr>";
      $i++;
    }
  }
    $result=mysqli_query($link,"SELECT *,SUM(amount) as total FROM tbl_costbl GROUP BY bl ORDER BY costID DESC");
    $i=1;
    while ($row=mysqli_fetch_array($result)) {
      @$options.="
            <tr>
            <form id='form_updates' name='form_updates' action='' method='POST'>
            <td><span id='id-$row[0]'>$i</span><input type='text' id='id$row[0]' name='id_text' value='$row[0]' class='form-control' style='width:4rem;display:none;'></td>
            <td><a href='javascript:void(0)' id='bl-$row[0]' value='$row[1]' class='blID'>$row[1]</a><input type='text' class='form-control' value='$row[1]' id='bl$row[0]' style='width:8rem;display:none;' name='bl_text'></td>
            <td><span id='c$row[0]'>$row[7]</span></td>
            <td><span id='s-$row[0]'>$row[2]</span><input type='text' class='form-control' value='$row[2]' id='s$row[0]' style='width:4rem;display:none;' name='s_text'></td>
            <td><span id='e-$row[0]'>$row[6]</span><input type='text' class='form-control' value='$row[6]' id='e$row[0]' style='width:8rem;display:none;' name='e_text'></td>
            <td><span id='a-$row[0]'>$row[total]</span><input type='text' class='form-control' value='$row[total]' id='a$row[0]' style='width:8rem;display:none;' name='a_text'></td>
            <td><span id='p$row[0]'>$row[5]</span></td>
            

            <td><a href='print_cost?$rand1&pw=$row[1]&$rand2' class='btn btn-success btn-sm' role='button' id='print_edit$row[0]'><span class='fa fa-print'>&nbsp;Print</span></a>
            </td>
          </form>
          </tr>";
      $i++;
    }

    //PRINTING BL USING BL NUMBER 
    if(isset($_POST['btn_land_print1'])){
        $bl=htmlentities($_POST['land_bl1']);
        if($bl==""){
          $div="<script>swal('Please enter the BL Number before printing','','warning')</script>";
        }
        else{
          $results=mysqli_query($link,"SELECT * FROM tbl_costbl WHERE bl='$bl'");
          if(mysqli_num_rows($results)>0){
              $continue=true;
              $result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_costbl WHERE bl='$bl'");
              $row_t=mysqli_fetch_array($result_t);
              $total=$row_t['total'];
              $i=1;
              while ($rows=mysqli_fetch_array($results)) {
                $blNo=$rows[1];
                $sice=$rows[2];
                $conNo=$rows[7];
                $eta=$rows[6];
                @$option.="<tr>
                      <td> $i</td>
                      <td>$rows[3]</td>
                      <td>".number_format($rows[4],2)."</td>
                    </tr>";
                $i++;
              }
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A Lading cost of BL was printed on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
          }
          else{
            $div="<script>swal('No result found','','warning')</script>";
          }
      }
    }

    //UPDATING COST BL
    if(isset($_POST['update-btn'])){
        //@$id=$_POST['id_text'];
        @$id=$_POST['bl_text'];
        @$land_bl=htmlentities($_POST['bl_text']);
        @$land_size=htmlentities($_POST['s_text']);
        @$land_eta=htmlentities($_POST['e_text']);
        @$desc=htmlentities($_POST['d_text']);
        @$amount=htmlentities($_POST['a_text']);
        $_SESSION['bl_text']=$land_bl;
        $ref_update=mysqli_query($link,"UPDATE tbl_costbl SET bl='$land_bl',size='$land_size',descrip='$desc',amount='$amount' WHERE bl='$id'");
        if($ref_update){
          $div="<script>
                    swal('Update Successfully!','','success')
                    setTimeout(function(){
                      window.location.href='cost-bl?$rand1&&act&ed&$rand2'
                  },3000)
                </script>
                ";
          $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
          $message=" A Lading cost of BL was updated on $date by ";
          $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
          $out1 = mysqli_query($link,$sql1);
        }
        else{
          $div="<script>
                    swal('Something went wrong!','','error')
                </script>
                ";
        }
    }
    //REDIRECTING PAGE MESSAGE ERROR
    if(isset($_GET['pw'])){
        $div="<script>swal('No result found','','warning')</script>";
    }
    //LINK TO EDIT COST BL
     /*if(isset($_GET['1'])){
         $div="<script>
          setTimeout(function(){
            window.location.href='cost-bl?$rand1&&confirm-Delete'
          })
        </script>";
     }*/
   // DELETE LADING COST BL DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_costbl where costID='$id'");
      $div="<script>
          swal('Lading cost of BL has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='cost-bl?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A Lading cost of BL was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }
?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <style type="text/css">
      td,th,tr{
          padding-left: .5rem;
        }
    </style>
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Lading Cost of BL Page</h2>
            <a href="cost-bl?act=<?=$rand1;?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Lading Cost Added</a>
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
              <div class="row text-uppercase">
                <div class="col-12 align-items-center">
                  <h3 class="mb-0">Lading Cost of BL </h3>
                  <button type="button" class="btn btn-default" onclick="window.history.back();" style="float:right;margin-top:-2rem;">Back</button>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <h4 class="row">
                <div class="col-xs-1 col-md-1 text-danger" style="font-size:1.5rem;">*</div> <div class="col-xs-11 col-md-11 ml--5">Please you can click on the BL Number before clicking on check BL button. <span class="fa fa-chalkboard-teacher"></span></div>
              </h4>
              <form id="form_landing" name="form_landing" action="" method="POST">
                <h6 class="heading-small text-muted mb-4 text-center">Ford A.W Global (Nigeria Limited)</h6>
                <div id="print_tab" <?php if($continue==true){echo "style='display:none;'";} if(isset($_GET['act'])){echo "style='display:none;'";} if(isset($_GET['1'])){echo "style='display:none;'";}?>>
                  <div class="pl-lg-4">
                    <label class="form-control-label" for="land_no">Enter Number of items</label>
                    <div class="form-row">
                    <input type="text" id="costID" name="costID" class="form-control col-md-3">
                    <button id="add_cost" name="add_cost" type="button" class="btn btn-warning btn-sm ml-2">Add <i class="fa fa-plus"></i></button>
                    <button id="minus_cost" name="minus_cost" type="button" class="btn btn-warning btn-sm ml-2">Minus <i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <hr>
                  
                  <div class="pl-lg-4 mt-4">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="land_bl">BL Number</label>
                          <input type="text" id="land_bl" name="land_bl" class="form-control text-uppercase" placeholder="Bl Number" maxlength="20" value="">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="conNo">Container</label>
                          <input type="text" id="conNo" name="conNo" class="form-control text-uppercase" placeholder="Container Number" maxlength="20" value="">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="land_size">Size</label>
                          <input type="text" id="land_size" name="land_size" class="form-control text-uppercase" placeholder="size" maxlength="10" value="">
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <label class="form-control-label" for="land_eta">E.T.A</label>
                          <input type="date" id="land_eta" name="land_eta" class="form-control text-uppercase" placeholder="Enter E.T.A" maxlength="10" value="">
                        </div>
                      </div>
                    </div><!-- END ROW 2-->
                  </div>
                  <div class="col-12 ml-2" id="success_msg1"></div>
                  <div class="col-12 ml-2">
                    <button type="button" id="btn_land" name="btn_land" class="btn btn-success">Save</button>
                  </div>
              </div><!-- END PRINT TAB -->
            </form>

            <form id="form_landing1" name="form_landing1" action="" method="POST">
              <div class="row mt-5" id="print_tab1" <?php if($continue==true){echo "style='display:none;'";} if(isset($_GET['act'])){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
                <div class="col-lg-12 mb-4">
                    <label class="form-control-label" for="land_bl1"> Enter BL Number to print</label>
                    <div class="form-row">
                      <input type="text" id="land_bl1" name="land_bl1" class="form-control col-4 text-uppercase mr-2" placeholder="Bl Number" maxlength="20" value="">
                       <button type="submit" id="btn_land_print1" name="btn_land_print1" class="btn btn-default"><i class="fa fa-print"></i> Check BL </button>
                       <a href="cost-bl?<?=$rand1?>&1&<?=$rand2?>" role="button" class="btn btn-danger">Click to edit details </a>
                    </div>
                </div>
                <div class="col-md-12" <?php if(isset($_GET['1'])){echo "style='display:none;'";}?>>
                  <table class="table table-hover table-striped table-bordered text-black table-responsive" width="100%" id="example">
                    <thead>
                      <th>S/N</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Size</th>
                      <th>E.T.A</th>
                      <th>Amount</th>
                      <th>Post Date</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
                </div>
                </div>
                <div class="col-md-12" <?php if(isset($_GET['1'])){echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
                  <table class="table table-hover table-striped table-bordered text-black table-responsive" width="100%" id="example">
                    <thead>
                      <th>S/N</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Size</th>
                      <th>E.T.A</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Post Date</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options1;?>
                  </table>
                </div>
              

              <div id="print_tab2" <?php if($continue==false){echo "style='display:none;'";}?>>
                <div class="col-md-12 text-uppercase">
                 <h1 class="text-center" style="font-size:1.5rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1>
                 <div class="col-md-12 text-right"><b>Date:</b> <?php echo date('d-m-Y');?></div>
                  <div class="row mt-5">
                    <div class="form-row col-12">
                      <label class="col-3 form-control-label"><h4>BL Number: <?=$blNo;?></h4></label>
                      <label class="col-3 form-control-label"><h4>Container Number: <?=$conNo;?></h4></label>
                      <label class="col-3 form-control-label"><h4>SIZE: <?=$sice;?></h4></label>
                      <label class="col-3 form-control-label"><h4>E.T.A: <?=$eta;?></h4></label>
                    </div>
                  </div>
                  <table border="1" width="100%">
                      <tr style="font-weight: bold;">
                      <td>S/N</td>
                      <td>Description</td>
                      <td>Amount</td></tr>
                    <?= @$option;?>
                    <tr><td colspan="2" class="text-center"><b>total</b></td><td><s style='text-decoration-style:double;'>N</s>  <?=number_format(@$total,2)?></td></tr>
                  </table>
                  <button type="submit" id="btn_land_prints" name="btn_land_prints" class="btn btn-danger mt-4" onclick="print_all('print_tab2')">Print BL</button>
                </div>
              </div><!-- END DIV OF PRINT2 -->
          </form>
        </div>
      </div>
    </div>
  </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>
<script type="text/javascript">
  function print_all(el) {
    //print_all('print_tab2')
        var body=document.body.innerHTML;
        var print_tab=document.getElementById(el).innerHTML;
        document.body.innerHTML=print_tab;
        $('#btn_land_prints').hide();
        window.print();
        document.body.innerHTML=body;
      }
</script>