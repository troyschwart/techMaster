<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Secretary" || $list=="Administrator" || $list=="Accountant"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_exam WHERE eid='$id'");
      $rowt=mysqli_fetch_array($result);
  }
  //SELECTING EXAMINATION DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_exam ORDER BY eid DESC");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
          <td><a href='examination?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'><span class='fa fa-trash'></span> Delete</button>
          </td>
        </tr>";
    $i++;
  }
  //UPDATING TRANSIRE
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $e_bl = htmlentities($_POST['e_bl']);
    $e_con = htmlentities($_POST['e_con']);
    $e_advice = htmlentities($_POST['e_advice']);
    $e_advice=str_replace(",","", $e_advice);
    $e_paar = htmlentities($_POST['e_paar']);
    $e_paar=str_replace(",","", $e_paar);
    
    $ref_update=mysqli_query($link,"UPDATE tbl_exam SET advice='$e_advice', paar='$e_paar' WHERE eid='$id'");
    $ref_update1=mysqli_query($link,"UPDATE tbl_invest SET advice='$e_advice', paar='$e_paar' WHERE blNo='$e_bl' AND conNo='$e_con'");
    $div="<script>
            swal('Advice and Paar was updated successfully!','','success')
            setTimeout(function(){
          window.location.href='examination?$rand1&ed=$id&ep=$rand2'
          },3000)
        </script>
        ";
        if($ref_update){
            $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
            $message=" A daily expenses was updated on $date by ";
            $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
            $out1 = mysqli_query($link,$sql1);
        }
  }

  //INSERT INTO EXPENSES

  if(isset($_POST['btn_exam'])){
    $e_bl = htmlentities($_POST['e_bl']);
    $e_con = htmlentities($_POST['e_con']);
    $e_advice = htmlentities($_POST['e_advice']);
    $e_advice=str_replace(",","", $e_advice);
    $e_paar = htmlentities($_POST['e_paar']);
    $e_paar=str_replace(",","", $e_paar);
    //CHECKING RECORD ON INVEST TABLE
    $result=mysqli_query($link,"SELECT * FROM tbl_invest WHERE blNo='$e_bl' AND conNo='$e_con'");
    //CHECKING RECORD ON EXAMINATION TABLE
    $result1=mysqli_query($link,"SELECT * FROM tbl_exam WHERE blNo='$e_bl' AND conNo='$e_con'");

    if($e_advice==""){
        $div="<script>
              swal('Please enter the advice','','error')
          </script>";
    }
    else if($e_paar==''){
        $div="<script>
              swal('Please enter the paar','','error')
          </script>";
    }
    else{
      if(mysqli_num_rows($result)==1){
          $ref_update=mysqli_query($link,"UPDATE tbl_invest SET advice='$e_advice', paar='$e_paar' WHERE blNo='$e_bl' AND conNo='$e_con'");
          $div="<script>
                      swal('Advice and Paar updated on the record successfully!','','success')
                      setTimeout(function(){
                          window.location.href='examination?e=$rand1'
                      },3000)
                  </script>
                  ";
                  if(mysqli_num_rows($result1)==0){
                      $sqls = "INSERT INTO tbl_exam (blNo,conNo,advice,paar,postDate) VALUES ('$e_bl','$e_con','$e_advice','$e_paar',now())" ;
                      $outs = mysqli_query($link,$sqls);
                  }
      }
      else{
        $sqls = "INSERT INTO tbl_exam (blNo,conNo,advice,paar,postDate) VALUES ('$e_bl','$e_con','$e_advice','$e_paar',now())" ;
        $outs = mysqli_query($link,$sqls);
        $sqls1 = "INSERT INTO tbl_invest (blNo,advice,paar,postDate,conNo) VALUES ('$e_bl','$e_advice','$e_paar',now(),'$e_con')" ;
        $outs = mysqli_query($link,$sqls1);
        if($outs){
          $div="<script>
                      swal('New examination fee added successfully!','','success')
                      setTimeout(function(){
                          window.location.href='examination?e=$rand1'
                      },3000)
                  </script>
                  ";
          $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
          $message=" A new examination fee was added on $date by ";
          $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
          $out1 = mysqli_query($link,$sql1);
        }
       }
     }
  }
  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      $result=mysqli_query($link,"SELECT * FROM tbl_exam WHERE eid='$id'");
      $rowt=mysqli_fetch_array($result);
      mysqli_query($link,"DELETE FROM tbl_exam where eid='$id'");
      $ref_update=mysqli_query($link,"UPDATE tbl_invest SET advice='0', paar='0' WHERE blNo='$rowt[1]' AND conNo='$rowt[2]'");
      $div="<script>
          swal('Advice and Paar has been Reset to zero (0) Successfully','','success')
          setTimeout(function(){
          window.location.href='examination?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" An amount investment was deleted on $date by ";
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
            <h2 class="display-2 text-white">Examination Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="examination?<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Examination Fee</a>
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
                  <h3 class="mb-0">Examination Expenses </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_transire" name="form_transire" action="" method="POST">
                <div class="text-center text-uppercase"><h2>Examination Fee</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="form-row">
                    <div class="col-4">
                        <label class="form-control-label" for="e_bl">BL Number</label>
                        <input type="text" id="e_bl" name="e_bl" class="form-control text-uppercase" placeholder="Enter BL Number" value="<?php if(isset($_GET['ed'])){echo $rowt[1];}else{echo @$e_bl;} ?>">
                    </div>
                    <div class="col-4">
                        <label class="form-control-label" for="e_con">Container Number</label>
                        <input type="text" id="e_con" name="e_con" class="form-control text-uppercase" placeholder="Enter Container Number" value="<?php if(isset($_GET['ed'])){echo $rowt[2];}else{echo @$e_con;} ?>">
                    </div>
                    <div class="col-4">
                        <label class="form-control-label" for="e_advice">Advice</label>
                        <input type="text" id="e_advice" name="e_advice" class="form-control text-uppercase" placeholder="Enter Advice" value="<?php if(isset($_GET['ed'])){echo $rowt[3];}else{echo @$e_advice;} ?>">
                    </div>
                    <div class="col-4">
                        <label class="form-control-label" for="e_paar">PAAR</label>
                        <input type="text" id="e_paar" name="e_paar" class="form-control text-uppercase" placeholder="Enter PAAR" value="<?php if(isset($_GET['ed'])){echo $rowt[4];}else{echo @$e_paar;} ?>">
                    </div>
                    <div class="col-4" style="margin-top:2rem;">
                      <button type="submit" id="btn_exam" name="btn_exam" class="btn btn-default" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                      <?=@$update_btn; ?>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
              </form>
              <hr>
              <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase" width="100%" id="example">
                    <thead class="th">
                      <th>S/No.</th>
                      <th>BL Number</th>
                      <th>Container Number</th>
                      <th>Advice</th>
                      <th>Paar</th>
                      <th>Action</th>
                    </thead>
                    <?= @$options;?>
                  </table>
            </div><!-- END CARD DBODY -->
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>