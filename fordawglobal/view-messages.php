<?php include 'menu_nav.php'; 
  if($list=="Shipping Manager" || $list=="Administrator" || $list=="Releasing Officer" | $list=="Secretary" | $list=="Manager" | $list=="Transport Manager" | $list=="Accountant"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}

//SELECTING MESSAGES DETAILS
if(isset($_GET['vall'])){
  $val="vall";
  $typeMsg="This page allows you to manage and view queries.<br><br><i><b>NOTE:</b> Click on the subjects to read the messages";
  $topic="Enquiry's Page";
  $result=mysqli_query($link,"SELECT * FROM tbl_enquiry ORDER BY eid DESC");
  $i=1;
  while ($rows=mysqli_fetch_array($result)) {
    $stateus=$rows[5];
    if($stateus=='0'){
      $envelop="<span class='fa fa-envelope text-success' style='font-size:1.2rem;'></span>";
    }
    else{
      $envelop="<span class='fa fa-envelope-open-text text-primary' style='font-size:1.2rem;'></span>";
    }
    @$options.="<tr>
          <td><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></td>
          <td>$envelop &nbsp;&nbsp; <a href='javascript:void(0)' role='button' id='$rows[0]' style='color:#555;white-space:pre-line;' class='msgID'>$rows[3] ...</a></td>
          <td>
          <button type='button' class='btn btn-danger btn-sm del_btn'  data-toggle='modal' data-target='#delete_payment' id='$rows[0]'><span class='fa fa-trash'></span></button>
          </td>
        </tr>";
    $i++;
  }
}
else if(isset($_GET['ad'])){
//FOR INDIVIDUAL MESSAGES
    $typeMsg="This page allows you to manage enquires and view queries.<br><br><i><b>NOTE:</b> Click on the subjects to read the messages";
    $msID=$_GET['ad'];
    $result=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE eid='$msID'");
    $ref_update=mysqli_query($link,"UPDATE tbl_enquiry SET status='1' WHERE eid='$msID'");
    $row=mysqli_fetch_array($result);
    $dates=$row[6];
    $postDate=date('M d', strtotime($dates));
    $div1="<div class='col-md-8' style='margin:0 auto;'>
        <div class='row' id='reply_row'>
        <div class='form-row'>
          <h3 class='col-12'>$row[3] on $row[6]</h3>
            <p class='col-12 form-control-label'>From &raquo; $row[2] | $row[1] &nbsp;&nbsp;<a href='#!' id='reply_btn'><span class='fa fa-reply'></span> reply</a></p>
            <small id='small' class='col-12'>to me<br>$postDate <a href=#!>Details</a></small>
        </div>
        <div class='form-row' style='white-space:pre-line'>
          $row[4]
        </div>
        <a href='view-messages?$rand1&all&$rand2' role='button' class='btn btn-sm btn-secondary mt-5'> &laquo; back</a>
        </div>
        </div>";
  }
else if(isset($_GET['qall'])){
  $val="q";
//FOR QUERY MESSAGES
  $typeMsg="Query Messages Page";
  $topic="Query Page";
  $result=mysqli_query($link,"SELECT * FROM tbl_query ORDER BY qid DESC");
  $i=1;
  
  while ($rows=mysqli_fetch_array($result)) {
    $id=$rows[5];
    $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
    $getType=mysqli_fetch_array($retval1);

    $stateus=$rows[4];
    if($stateus=='0'){
      $envelop="<span class='fa fa-envelope text-success' style='font-size:1.2rem;'></span>";
    }
    else{
      $envelop="<span class='fa fa-envelope-open-text text-primary' style='font-size:1.2rem;'></span>";
    }
    @$options.="<tr>
          <td><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></td>
          <td>$envelop &nbsp;&nbsp; <a href='javascript:void(0)' role='button' id='$rows[0]' style='color:#555;white-space:pre-line;' class='msgID'>From $getType[1] click to view the full query ...</a></td>
        </tr>";
    $i++;
  }
}
else if(isset($_GET['v'])){
  $val="v";
//FOR QUERY MESSAGES
  $typeMsg="Query Messages Page";
  $topic="Query Page";
  $result=mysqli_query($link,"SELECT * FROM tbl_query WHERE id='$uid' ORDER BY qid DESC");
  $i=1;
  
  while ($rows=mysqli_fetch_array($result)) {
    $id=$rows[5];
    $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
    $getType=mysqli_fetch_array($retval1);

    $stateus=$rows[4];
    if($stateus=='0'){
      $envelop="<span class='fa fa-envelope text-success' style='font-size:1.2rem;'></span>";
    }
    else{
      $envelop="<span class='fa fa-envelope-open-text text-primary' style='font-size:1.2rem;'></span>";
    }
    @$options.="<tr>
          <td><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></td>
          <td>$envelop &nbsp;&nbsp; <a href='javascript:void(0)' role='button' id='$rows[0]' style='color:#555;white-space:pre-line;' class='msgID'>From $getType[1] click to view the full query ...</a></td>
        </tr>";
    $i++;
  }
}
else{
  $div="<script>
        setTimeout(function(){
            window.location='dashboard?home=$rand1'
        })</script>";
}

  //REPLYING MESSAGES
  if(isset($_POST['btn_reply'])){
      $fname = htmlentities($_POST['username-reply']);
      $email=htmlentities($_POST['email-reply']);
      $subject=htmlentities($_POST['subject-reply']);
      $mesage=nl2br(htmlentities($_POST['message-reply']));
      $result=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE email='$email'");
      $row=mysqli_fetch_array($result);
      if($subject==''){
        $div="<script>
            swal('Please enter the subject !','','warning')
          </script>";
      }
      else if($mesage==''){
        $div="<script>
            swal('Please type the message !','','warning')
          </script>";
      }
      else {
        if($row[7]==1){
            $div="<script>
            swal('You have replied to this email already !','','warning')
          </script>";
        }
        else{
          $to="$email";
          $from="fordawglobal.com";
          $subject = "$subject";
          $message =  $from  . "\n\n" . "$mesage";
          $headers="From: $from \r\n";
          $headers .="Reply-To: $to \r\n";
          //mail($to,$subject,$message,$headers);
          $ref_update=mysqli_query($link,"UPDATE tbl_enquiry SET replies='1' WHERE email='$email'");
          if($ref_update){
              $div="<script>
              swal('Reply sent successfully to this email $email','','success')
              setTimeout(function(){
                  window.location='view-messages?$rand1&$rand2'
              },3000);
          </script>";
          }
        }
      }
   }
   //REPLYING QUERY MESSAGES
  if(isset($_POST['reply_query'])){
      $qid = htmlentities($_POST['qid']);
      $userid = htmlentities($_POST['userid']);
      $senderid=htmlentities($_POST['senderid']);
      $mesage=nl2br(htmlentities($_POST['message-reply']));
       if($mesage==''){
        $div="<script>
            swal('Please type the message !','','warning')
          </script>";
      }
      else{
          $sqls =mysqli_query($link,"INSERT INTO tbl_query (id,query_mess,postDate,sender) VALUES ('$senderid','$mesage',now(),'$userid')") ;
          $ref_update=mysqli_query($link,"UPDATE tbl_query SET replied='1' WHERE qid='$qid'");
          if($ref_update){
              $div="<script>
              swal('Your reply has been sent successfully','','success')
              setTimeout(function(){
                  window.location='view-messages?$rand1&v&$rand2'
              },3000);
          </script>";
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
            <h2 class="display-2 text-white">Messages Page <?php echo " ($check[1])"; ?></h2>
            <p class="text-white mt-0 mb-2"><?=@$typeMsg?></i></p>
            <a href="#!" class="btn btn-neutral" <?php if(!isset($_GET['vall'])){echo "style='display:none;'";}?>><span class="fa fa-envelope-open"></span> Users Enquiry Messages</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-sm-12 col-xl-12  order-xl-1">
          <div class="card">
            <div class="card-header" id='card-head'>
              <div class="row align-items-center text-uppercase">
                <div class="col-8">
                  <h3 class="mb-0"><?=@$topic?></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
                <form method="POST" name="get_message" id="get_message">
                  <input type="hidden" name="msgID" id="msgID" value="<?php echo $val; ?>">
                  <input type="hidden" name="msgID1" id="msgID1">
                  <input type="hidden" name="msgID2" id="msgID2">
                    <div class="col-md-12 message" <?php if(!isset($_GET['vall'])){echo "style='display:none;'";}?>>
                      <table class="table table-hover table-striped table-borderless text-black" width="100%" id="example">
                      <thead>
                        <th><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></th>
                        <th>Subject</th>
                        <th>Action</th>
                        </thead>
                        <?= @$options;?>
                      </table>
                    </div>
                    <div class="col-md-12 message" <?php if(!isset($_GET['qall'])){echo "style='display:none;'";}?>>
                      <table class="table table-hover table-striped table-borderless text-black" width="100%" id="example">
                      <thead>
                        <th><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></th>
                        <th>Subject</th>
                        </thead>
                        <?= @$options;?>
                      </table>
                    </div>
                    <div class="col-md-12 message" <?php if(!isset($_GET['v'])){echo "style='display:none;'";}?>>
                      <table class="table table-hover table-striped table-borderless text-black" width="100%" id="example">
                      <thead>
                        <th><input type='checkbox' name='checkbox_name[]' id='checkbox_name'></th>
                        <th>Subject</th>
                        </thead>
                        <?= @$options;?>
                      </table>
                    </div>
                    <div class="col-md-8 message1"  <?php if(!isset($_GET['ad'])||!isset($_GET['re'])){echo "style='display:none;margin:0 auto;'";}else{echo @$div1;}?>></div>
                  </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>