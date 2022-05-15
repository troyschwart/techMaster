<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Breverage"){?>
  
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
      $result=mysqli_query($link,"SELECT * FROM tbl_outlet WHERE outletID='$id'");
      $rows=mysqli_fetch_array($result);
      //SELECTING FOR CONTAINER NUMBER
  }

  $result=mysqli_query($link,"SELECT * FROM tbl_outlet");
  $i=1;
  while ($row=mysqli_fetch_array($result)) {
    
    @$options.="<tr>
          <td> $i</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
          <td>$row[4]</td>
          <td><a href='add_outlet?$rand1&&ed=$row[0]' class='btn btn-info btn-sm' role='button' id='update_cat'><span class='fa fa-edit'>&nbsp;Edit</span></a>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete</button>
          </td>
        </tr>";
    $i++;
  }
    //UPDATING OUTLET
    if(isset($_POST['btn_update'])){
      $id=$_GET['ed'];
      @$outletName=strtoupper(htmlentities($_POST['outletName']));
      @$address=strtoupper(htmlentities($_POST['address']));
      @$phone=htmlentities($_POST['phone']);
      $update=mysqli_query($link,"UPDATE tbl_outlet SET nameOutlet='$outletName',address='$address',phone='$phone' WHERE outletID='$id'");
      if($update){
        $div="<script>
          swal('Outlet Updated Successfully','','success')
          setTimeout(function(){
          window.location.href='add_outlet?$rand1&&id'
          },2000)
        </script>";
      }
    }
  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_outlet where outletID='$id'");
      $div="<script>
                swal('Outlet has been Removed Successfully','','success')
                setTimeout(function(){
                window.location.href='add_outlet?$rand1&&id'
                },3000)
            </script>";
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
            <h2 class="display-2 text-white">Add Outlet Details Page</h2>
            <a href="add_outlet?vw=<?=$rand1?>" class="btn btn-outline-white"><span class="fa fa-print"></span> View Added Outlet Details</a>
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
                  <h3 class="mb-0"><?=$list?> </h3>
                </div>
              </div>
            </div>
            <div class="card-body text-uppercase">
              <div id="success_msg"></div><?=@$div?>
              <form id="form-outlet" name="form-outlet" action="" method="POST" <?php if(isset($_GET['vw'])){echo "style='display:none;'";}?>>
                <div class="text-center text-uppercase"><h2>Add Outlet form</h2><h6 style="color:#888;">Ford Breverages (Nigeria Limited)</h6></div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <!-- OUTLET NAME -->
                        <label for="reg">Outlet name: <span class="text-danger">*</span></label>
                        <input type="text" name="outletName" id="outletName" placeholder="Enter Outlet name" class="form-control text-uppercase" value="<?php if(isset($_GET['ed'])){echo @$rows[1];}else{echo @$outletName;}?>" required>
                    </div>
                    <div class="form-group col-md-5">
                      <!-- ADDRESS -->
                        <label for="reg">Address: <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" placeholder="Enter Address" class="form-control text-uppercase" value="<?php if(isset($_GET['ed'])){echo @$rows[2];}else{echo @$address;}?>" required>
                    </div>
                    <div class="form-group col-md-3">
                      <!-- PHONE NUMBER -->
                        <label for="reg">Phone Number: <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" placeholder="Enter Phone" maxlength="11" class="form-control" value="<?php if(isset($_GET['ed'])){echo @$rows[3];}else{echo @$phone;}?>">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" id="submit_outlet" name="submit_outlet" class="btn btn-primary" <?php if(isset($_GET['ed'])){echo "style='display:none'";} ?>>Submit</button>
                    <?=@$update_btn; ?>
                  </div>
                   <hr> 
                 </form>
                <h2 class="text-center">List of Outlet Names Added</h2>
                <table class="table table-hover table-striped table-bordered text-black text-center text-capitalize table-responsive" width="100%" id="example">
                  <thead class="th">
                    <th>S/N</th>
                    <th>Name of Outlet</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Date Added</th>
                    <th>Action</th>
                  </thead>
                  <?php echo $options;?>
              </table>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>