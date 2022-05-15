<?php include 'menu_nav.php'; 
//CHECKING PAGE VALIDATION
if($list=="Releasing Officer" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}

  //ADDING THE BL
  if(isset($_POST['btn_bl'])){
    $id=$_GET['ed'];
    $bl_exp = htmlentities($_POST['bl_exp']);
    $release_file = $_FILES['release_file']['name'];
    
    $location="../photo/".uniqid().$release_file;
    $uploadOk=1;
    $imageFileType=pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions=array('jpg','jpeg','png','pdf','doc','docx');

    if(!in_array(strtolower($imageFileType), $valid_extensions)){
        $uploadOk=0;
    }
    if($bl_exp==''){
        $div=" <script>
            swal('Please make sure that all fields are filled correctly!','','error')
        </script>
        ";
    }
    else{
      if($release_file==null | empty($release_file)){
         $div=" <script>
                swal('Please upload a file','','warning')
            </script>
            ";
      }//END FIRST IF
      else{
        if($uploadOk==0){
              $div=" <script>
                  swal('File format not supported','file should be in the format: jpg, jpeg or png','error')
              </script>";
          }
        else{
          $sqls = "UPDATE tbl_bill SET deliveryOrd='$location',dExp='$bl_exp' WHERE bid='$id'" ;
          $outs = mysqli_query($link,$sqls);
          $sqls1 = "UPDATE tbl_follow SET deliveryOrd='$location' WHERE bid='$id'" ;
          $outs = mysqli_query($link,$sqls1);

          if($outs){
              $div="<script>
                          swal('Delivery order upload was successfully!','','success')
                         setTimeout(function(){
                          window.location.href='view_bl?$rand1&&updated=successful'
                          },3000)
                      </script>
                      ";
              $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
              $message=" A delivery order was uploaded on $date by ";
              $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
              $out1 = mysqli_query($link,$sql1);
              move_uploaded_file($_FILES['release_file']['tmp_name'],$location);

          }
          else{
          $div=" <script>
                  swal('Error Occurred while submitting details due to wrong files uploaded, Try again!','','error')
              </script>
              ";
           }
         }
        }//END OF ELSE FOR IF
      }//END MAIN ELSE
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
            <h2 class="display-2 text-white">Delivery Upload Page</h2>
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
                <h6 class="heading-small text-muted mb-4"></h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <!-- DATE -->
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="bl_exp">Expiration Date</label>
                        <input type="date" id="bl_exp" name="bl_exp" class="form-control">
                      </div>
                    </div>
                    <div id="file_r">
                            <label class="form-control-label" for="bl_release_file">Upload the file for delivery Order <span class="fa fa-arrow-down"></span></label>
                            <input type="file" class="form-control" name="release_file" id="release_file">
                            <p class="help-block" style="font-size:0.9rem;color:#ccc;">file should be in the format: jpg, jpeg or png</p>
                          </div>
                  </div><!-- END ROW 2-->
                </div>
                <div class="col-12 pl-lg-4">
                  <button type="submit" id="btn_bl" name="btn_bl" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>