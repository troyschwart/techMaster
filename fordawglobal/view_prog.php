<?php include "menu_nav.php"; 
//CHECKING PAGE VALIDATION
if($list=="Administrator" | $list=="Shipping Manager" | $list=="Manager"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//SELECTING PROGRESSIVE REPORT DETAILS
$heading="List of Progressive Report Added";
$result=mysqli_query($link,"SELECT * FROM tbl_prog WHERE progStatus='no' ORDER BY pid DESC");
      if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        $bl_date=date('d-m-Y',  strtotime($row[1]));
        if($list=='Manager'){
            $move_btn="";
        }
        else{
          $move_btn="<a href='view_prog?$rand1&id=$row[0]&$rand2' class='btn btn-primary btn-sm' role='button' id='$row[0]' >Move <span class='fa fa-angle-double-right'></span></a>";
        }
        @$options.="<tr>
              <td> $i</td>
              <td>$bl_date</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$row[8]</td>
              <td>$row[9]</td>
              <td>$row[10]</td>
              <td>$row[11]</td>
              <td>$row[12]</td>
              <td>$row[13]</td>
              <td>$row[15]</td>
              <td>$move_btn
              <a href='progressive-report?$rand1&&ed=$row[0]&$rand2' class='btn btn-info btn-sm' role='button' id='update_trans'> Edit <span class='fa fa-edit'></span></a>
              <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$row[0]'>Delete <span class='fa fa-trash'></span></button>
              </td>
            </tr>";
        $i++;
      }
  }
  else{
       @$options.="<tr><td colspan='15'>NO DATA AVAILABLE IN TABLE</td></tr>";
    }


  //VIEWING PAGE
  if(isset($_GET['vw'])){
    $tittle="View of Full Details of Progressive Report Added";
    $vID="print";
    //$vw=$_SESSION['vw'];
    $vw=$_GET['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_prog WHERE pid='$vw'");
    $resultVal=mysqli_fetch_array($result);
  }
  else{
    $tittle="Monitor Progress Report";
  }

  // DELETE FEES DETAILS
    if(isset($_POST['btn_deletepay'])){
      $id=$_POST['delID'];
      mysqli_query($link,"DELETE FROM tbl_prog where pid='$id'");
      $div="
      <script>
          swal('A progressive-report has been Removed Successfully','','success')
          setTimeout(function(){
          window.location.href='view_prog?$rand1&&confirm-Delete'
          },3000)
      </script>";
      $date=date("Y-m-d h:i:s a",strtotime("+1 hour"));
      $message=" A progressive-report was deleted on $date by ";
      $sql1 = "INSERT INTO tbl_activity (uid,message,postDate) VALUES ('$uid','$message',now())" ;
      $out1 = mysqli_query($link,$sql1);
    }

  //COPYING TO THE PROGRSSIVE TABLE
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $sql_copy=mysqli_query($link,"INSERT INTO tbl_follow (blNo,conNo,customerName,eta,placeExam,podischarge,size,deliveryOrd,postDate) SELECT bl.blNo,bl.conNo,bl.customerName,bl.eta,bl.terminal,bl.impot,bl.size,bl.delivered,bl.postDate FROM tbl_prog as bl WHERE bl.pid='$id'");
          if($sql_copy){
            @$div="<script>
                      swal('Successfully moved to follow up list','','success')
                      setTimeout(function(){
                        window.location='view_prog?$rand1&success&$rand2'
                        },3000)
                  </script>";
              $ref_update=mysqli_query($link,"UPDATE tbl_prog SET progStatus='x' WHERE pid='$id'");
      }
   }
   //POPING OUT DATE AGAINST 1 WEEK TIME
    $one_week=date('Y-m-d',strtotime("+7 days"));
    $result1=mysqli_query($link,"SELECT * FROM tbl_prog WHERE progStatus='no' AND eta='$one_week' ORDER BY pid DESC");
    $result2=mysqli_query($link,"SELECT count(*) as onWeeks FROM tbl_prog WHERE progStatus='no' AND eta='$one_week' ORDER BY pid DESC");
    $row2=mysqli_fetch_array($result2);
    $checkWeek=$row2['onWeeks'];
      if(mysqli_num_rows($result1)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result1)) {
          //VALIDATING ONE WEEK TIME DATES
            @$con.="<tr><td>$i</td><td>$row[2]</td><td>$row[3]</td><td>$row[8]</td></tr>";
            $div="<script>
              Swal.fire({
                  icon:'warning',
                  title:'You have $checkWeek containers that have 1 week before arrival',
                  text:'Do you want to view them',
                  showCancelButton:true,
                  confirmButtonText:'View Details'
                }).then((result)=>{
                  if(result.isConfirmed){
                      Swal.fire({
                      title: '<strong><h3>List of container(s)</h3></strong>',
                      type: 'info',
                      html:
                        '<table width=100% border=1 class=text-left><tr style=font-weight:bold;><td>S/N</td><td>BL Number</td><td>Container Number</td><td>ETA</td></tr>'+
                        '$con</table>',
                      confirmButtonColor:'#dc3545'
                    })
                  }
                })
              </script>";
              $i++;
      }
  }
    //COPYING TABLE & AUTO REFRESH    
    /*$sql_copy=mysqli_query($link,"INSERT INTO tbl_prog (datee,blNo,conNo,size,typeGoods,consig,eta,releas,paar,terminal,postDate) SELECT bl.blDate,bl.blNo,cn.containerNo,bl.size,bl.debitNote,bl.consign,bl.eta,bl.releaseStatus,bl.paar,bl.placeExam,bl.postDate FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid=cn.bid AND bl.copyStatus=''");
        if($sql_copy){
          @$div="<script>
                    setTimeout(function(){
                      window.location='view_prog?$rand1&vc&$rand2'
                      },1000)
                </script>
                ";
            $ref_update=mysqli_query($link,"UPDATE tbl_bill SET copyStatus='yes'");
        }*/
    
?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center mt--5">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">View Progressive Report Page</h2>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row">
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center text-uppercase">
                <div class="col-12">
                  <h3 class="mb-0"><?php echo $tittle; ?></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
              <h3 class="text-uppercase"><i class="fa fa-asterisk text-danger"></i> Click on move button to move BL to follow up list</h3><br>
              <?php switch(@$vID){ case 'print':; ?>
                <div id="tab1">
                  <form method="POST" name="view_prog" id="view_prog" action="">
                  <div class="row text-uppercase">
                  <div class="col-md-6">
                    <label class="form-control"><span class="text-danger">Serial No:</span> <b><?=$resultVal[0];?><input type="hidden" name="pid" value="<?=$resultVal[0];?>"></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Bill Date:</span> <b><?=$resultVal[1];?></b></label>
                    <label class="form-control"><span class="text-danger">BL Number:</span> <b><?=$resultVal[2];?></b></label>
                    <label class="form-control"><span class="text-danger">Container No.:</span> <b><?=$resultVal[3];?></b></label>
                    <label class="form-control"><span class="text-danger">Size: </span> <b><?=$resultVal[4];?></b></label>
                    <label class="form-control"><span class="text-danger">Customer Name: </span> <b><?=$resultVal[5];?></b></label>
                    <label class="form-control"><span class="text-danger">Type of Goods:</span> <b><?=$resultVal[6];?></b></label>
                    <label class="form-control"><span class="text-danger">Consignee:</span> <b><?=$resultVal[7];?></b></label>
                    <label class="form-control"><span class="text-danger">Exact Time of Arrival:</span> <b><?=$resultVal[8];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Release:</span> <b><?=$resultVal[9];?></b></label>
                  </div>
                  
                  <div class="col-md-6">
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">PAAR:</span> <b><?=$resultVal[10];?></b></label>
                    <label class="form-control" style="padding-bottom:10%;"><span class="text-danger">Import:</span> <b><?=$resultVal[11];?></b></label>
                    <label class="form-control"><span class="text-danger">Terminal:</span> <b><?=$resultVal[12];?></b></label>
                     <label class="form-control"><span class="text-danger">Delivery:</span> <b><?=$resultVal[13];?></b></label>
                    <label class="form-control"><span class="text-danger">Post Date:</span> <b><?=$resultVal[17];?></b></label>
                    <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_prog?<?=$rand1?>';"><span class="fa fa-angle-double-left"></span> Back</button>
                  </div>
                </div>
              </form>
              </div>
              <?php break; default:;?>
                <div id="tab2">
                  <div class="text-center text-uppercase"><h2><?=$heading;?></h2><h6 style="color:#888;">Ford A.W Global (Nigeria Limited)</h6></div>
                  <div class="form-row">
                    <label class="form-control-label" style="margin-top:.7rem;">Search:</label>
                    <input type="text" name="search-prog" id="search-prog" class="form-control col-3 mb-3 ml-2" placeholder="Enter BL Number">
                  </div>
                  <div class="col-12" id="tab">
                    <table class="table table-hover table-striped table-bordered text-black text-center text-uppercase table-responsive" width="100%" id="">
                      <thead class="th">
                        <th>S/No.</th>
                        <th>Date of bill</th>
                        <th>BL Number</th>
                        <th>Container no.</th>
                        <th>Size</th>
                        <th>Customer Name</th>
                        <th>Type of Goods</th>
                        <th>Consignee</th>
                        <th>ETA</th>
                        <th>Release</th>
                        <th>PAAR</th>
                        <th>Import</th>
                        <th>Terminal</th>
                        <th>Delivered</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                      </thead>
                      <?= @$options;?>
                    </table>
                  </div>
                  <div class="col-12" id="tab2">
                    <p id="show_tab"></p>
                  </div>
                </div><!-- END TABLE2 DETAILS -->
              <?php }?>
            </div>
          </div>
        </div>
      </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>
<span id="clock"></span>
<script type="text/javascript"> 
//REFRESHING A PAGE
/*$(function(){
  var time=10;
  var rm=setInterval(function(){
      --time;
     $('#clock').html(time);
     $('#clock').hide();
      if(time==6){
        window.location='view_prog?<?=$rand1?>';
        time=10;
      } 
  },1000);
});*/
//REFRESH 2
/*$(window).load(function(){
  //$('#auto').load('');
  refresh();
});*/
/*function refresh(){
      setTimeout(function(){
        //$('#auto').fadeIn('slow').load('').fadeOut('slow');
        refresh();
        //window.location='view_prog?<?=$rand1?>';
      });
    }*/
</script>