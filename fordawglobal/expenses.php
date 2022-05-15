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
      $result=mysqli_query($link,"SELECT * FROM tbl_expen WHERE id='$id'");
      $row=mysqli_fetch_array($result);
  }
  //UPDATING TRANSIRE
  if(isset($_POST['btn_update'])){
    $id=$_GET['ed'];
    $input_date = htmlentities($_POST['input_date']);
    $input_desc = htmlentities(nl2br($_POST['input_desc']));
    $input_amount = htmlentities($_POST['input_amount']);
    $input_amount=str_replace(",","", $input_amount);
    
    $ref_update=mysqli_query($link,"UPDATE tbl_expen SET dates='input_date',descrip='input_desc',amount='input_amount' WHERE id='$id'");
    $div="<script>
            swal('Expenses was updated successfully!','','success')
            setTimeout(function(){
          window.location.href='expenses?$rand1&&ed'
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
  if(isset($_POST['btn_expen'])){
    $input_date = htmlentities($_POST['input_date']);
    $input_desc = htmlentities(nl2br($_POST['input_desc']));
    $input_amount = htmlentities($_POST['input_amount']);
    $input_amount=str_replace(",","", $input_amount);
    if($input_date==null){
        $div="<script>
              swal('Please enter the date','','error')
          </script>";
    }
    else if($input_desc==""){
        $div="<script>
              swal('Please enter the Description','','error')
          </script>";
    }
    else if($input_amount==''){
        $div="<script>
              swal('Please enter the Amount','','error')
          </script>";
    }

    else{
      $sqls = "INSERT INTO tbl_expen (dates,descrip,amount,postDate) VALUES ('$input_date','$input_desc','$input_amount',now())" ;
      $outs = mysqli_query($link,$sqls);
      if($outs){
        $tdates=date("Y-m-d");
        $result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen WHERE dates='$tdates'");
        $row_t=mysqli_fetch_array($result_t);
        $total=number_format($row_t['total']);
        if($total==0){
            $total=0;
        }
        $div="<script>
                    swal('New expenses added successfully!','Total expenses today: $total','success')
                    setTimeout(function(){
                        window.location.href='expenses?e=$rand1'
                    },3000)
                </script>
                ";
        $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
        $message=" A new expenses was added on $date by ";
        $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
        $out1 = mysqli_query($link,$sql1);
      }
     }
  }
  //CALCULATING THE EXPENSES
  $tdates=date("Y-m-d");
  $result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen WHERE dates='$tdates'");
  $row_t=mysqli_fetch_array($result_t);
  $total=$row_t['total'];
  if($total==0){
      $total=0;
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
            <h2 class="display-2 text-white">Add Expenses Page</h2>
            <!--p class="text-white mt-0 mb-5"></p-->
            <a href="view_expenses?<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Expenses</a>
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
                  <h3 class="mb-0">Office Daily Expenses </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form_transire" name="form_transire" action="" method="POST">
                <div class="text-center text-uppercase"><h2>Office maintenance daily expenses</h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_date">Date</label>
                        <input type="date" id="input_date" name="input_date" class="form-control text-uppercase" value="<?php if(isset($_GET['ed'])){echo $row[1];}else{echo @$input_date;} ?>">
                      </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_desc">Description</label>
                        <textarea class="form-control text-capitalize" id="input_desc" name="input_desc" placeholder="Describe the expenses" cols="10" rows="5" style="resize:none;white-space:pre-wrap;"><?php if(isset($_GET['ed'])){echo $row[2];}else{echo @$input_desc;} ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-12"></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_amount">Amount</label>
                        <input type="text" id="input_amount" name="input_amount" class="form-control text-uppercase" placeholder="Enter Amount" value="<?php if(isset($_GET['ed'])){echo $row[3];}else{echo @$input_amount;} ?>">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-4">
                  <button type="submit" id="btn_expen" name="btn_expen" class="btn btn-success" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                  <?=@$update_btn; ?> <b><i class="text-danger ml-5">Today's total expenses</i> = <s style='text-decoration-style:double;'> N</s><?=number_format(@$total,2)?></b>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>