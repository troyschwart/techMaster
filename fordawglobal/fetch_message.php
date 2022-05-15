<?php
include('../includes/connection.php');
//FETCHING MESSAGES
$msg_=$_POST['msgID'];
$msg_ds=$_POST['msgID1'];
$msg_ds2=$_POST['msgID2'];
if($msg_=='vall'){
    $result=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE eid='$msg_ds'");
    $ref_update=mysqli_query($link,"UPDATE tbl_enquiry SET status='1' WHERE eid='$msg_ds'");
    $row=mysqli_fetch_array($result);
    $dates=$row[6];
    $postDate=date('M d', strtotime($dates));
    if($msg_ds!=""){
      $div="<div class='row' id='reply_row'>
    		<div class='form-row'>
    		  <h3 class='col-12'>$row[3] on $row[6]</h3>
    		    <p class='col-12 form-control-label'>From &raquo; $row[2] | $row[1] &nbsp;&nbsp;<a href='#!' id='reply_btn'><span class='fa fa-reply'></span> reply</a></p>
    		    <small id='small' class='col-12'>to me<br>$postDate <a href=#!>Details</a></small>
    		</div>
    		<div class='form-row' style='white-space:pre-line'>
    		  $row[4]
    		</div>
    		</div>
    		<a href='view-messages?$rand1&$rand2' role='button' class='btn btn-sm btn-secondary mt-5'> &laquo; back</a>";
    }
    else{
    	$msg_ds=$_POST['msgID1'];
    	$result=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE eid='$msg_ds'");
    	$row=mysqli_fetch_array($result);
    	$div="<div class='message2' style='display:none;margin:0 auto;'>
    		<div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>To:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' placeholder='Enter Email' id='email-reply'  name='email-reply' value='$row[2]'>
              </div>
          </div> 
    	   <div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>Name:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' id='username-reply'  name='username-reply' value='$row[1]'>
              </div>
            </div> 

            <div class='form-row mb-3'>
              <label class='col-3 form-control-label mt-3'>Subject:</label>
              <div class='col-9 input-group input-group-merge input-group-alternative ml--6' style='disabled:true;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-book'></i></span>
                </div>
                <input class='form-control' type='text' placeholder='Enter Subject' id='subject-reply'  name='subject-reply' value='Re:$row[3]'>
              </div>
            </div>

            <div class='form-row'>
              <label class='col-3 form-control-label mt-3'>&nbsp;</label>
              <textarea class='col-9 form-control ml--6' placeholder='Message' name='message-reply' id='message-reply' cols='10' rows='5' style='resize:none;white-space:pre-wrap;'></textarea>
            </div>
            <div class='ml-6'>
              <button type='submit' class='btn btn-success my-4' id='btn_reply' name='btn_reply'>Submit</button>
            </div>
            </div>";
      }
}
else if($msg_=='q'){
    if($msg_ds2=="reply"){
        $msg_ds=$_POST['msgID1'];
        $result=mysqli_query($link,"SELECT * FROM tbl_query WHERE qid='$msg_ds'");
        $row=mysqli_fetch_array($result);
        $id=$row[5];
        $myid=$row[1];
        $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
        $getType=mysqli_fetch_array($retval1);
        $retval2=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$myid'");
        $getType1=mysqli_fetch_array($retval2);

        $div="<div class='message2' style='display:none;margin:0 auto;'>
          <h3 class='text-center'>Reply Message</h3>
            <input type='hidden' value='$msg_ds' name='qid'>
          <div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>From:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' id='email-reply'  name='email-reply' value='$getType1[1]'>
                <input class='form-control' type='hidden' id='userid'  name='userid' value='$myid'>
              </div>
          </div> 
          <div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>To:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' id='username-reply'  name='username-reply' value='$getType[4] ($getType[1])'>
                <input class='form-control' type='hidden' id='senderid'  name='senderid' value='$id'>
              </div>
            </div> 

            <div class='form-row'>
              <label class='col-3 form-control-label mt-3'>&nbsp;</label>
              <textarea class='col-9 form-control ml--6' placeholder='Message' name='message-reply' id='message-reply' cols='10' rows='5' style='resize:none;white-space:pre-wrap;'></textarea>
            </div>
            <div class='ml-6'>
              <button type='submit' class='btn btn-success my-4' id='reply_query' name='reply_query'>Submit</button>
            </div>
            </div>";
      }
    else{
      $result=mysqli_query($link,"SELECT * FROM tbl_query WHERE qid='$msg_ds'");
      $ref_update=mysqli_query($link,"UPDATE tbl_query SET status='1' WHERE qid='$msg_ds'");
      $row=mysqli_fetch_array($result);
      $dates=$row[3];
      $reply=$row[6];
      if($reply=='1'){
          $rep="";
      }
      else{
        $rep="<a href='javascript:void(0)' id='reply' role='button' class='btn btn-sm btn-secondary mt-5'> Reply <span class='fa fa-reply'></span></a>";
      }
      $postDate=date('M d,Y', strtotime($dates));
      $id=$row[5];
      $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
      $getType=mysqli_fetch_array($retval1);

      $div="<div class='row' id='reply_row'>
          <div class='form-row'>
            <h3 class='col-12'>Query message sent to you on $row[3]</h3>
              <p class='col-12 form-control-label'>From &raquo; $getType[1] | $getType[4]</p>
              <small id='small' class='col-12'>to me<br>$postDate <a href=#!>Details</a></small>
          </div>
          <div class='form-row' style='white-space:pre-line'>
            $row[2]
          </div>
          </div>
          <a href='view-messages?$rand1&q&$rand2' role='button' class='btn btn-sm btn-secondary mt-5'> &laquo; back</a> $rep";
    }
  }
else{
    if($msg_ds2=="reply"){
        $msg_ds=$_POST['msgID1'];
        $result=mysqli_query($link,"SELECT * FROM tbl_query WHERE qid='$msg_ds'");
        $row=mysqli_fetch_array($result);
        $id=$row[5];
        $myid=$row[1];
        $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
        $getType=mysqli_fetch_array($retval1);
        $retval2=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$myid'");
        $getType1=mysqli_fetch_array($retval2);

        $div="<div class='message2' style='display:none;margin:0 auto;'>
          <h3 class='text-center'>Reply Message</h3>
            <input type='hidden' value='$msg_ds' name='qid'>
          <div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>From:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' id='email-reply'  name='email-reply' value='$getType1[1]'>
                <input class='form-control' type='hidden' id='userid'  name='userid' value='$myid'>
              </div>
          </div> 
          <div class='form-row mb-3'>
              <label class='col-md-2 form-control-label mt-3'>To:</label>
              <div class='col-md-9 input-group input-group-merge input-group-alternative ml--4' style='pointer-events:none;'>
                <div class='input-group-prepend'>
                  <span class='input-group-text'><i class='fa fa-envelope-open-text'></i></span>
                </div>
                <input class='form-control' type='text' id='username-reply'  name='username-reply' value='$getType[4] ($getType[1])'>
                <input class='form-control' type='hidden' id='senderid'  name='senderid' value='$id'>
              </div>
            </div> 

            <div class='form-row'>
              <label class='col-3 form-control-label mt-3'>&nbsp;</label>
              <textarea class='col-9 form-control ml--6' placeholder='Message' name='message-reply' id='message-reply' cols='10' rows='5' style='resize:none;white-space:pre-wrap;'></textarea>
            </div>
            <div class='ml-6'>
              <button type='submit' class='btn btn-success my-4' id='reply_query' name='reply_query'>Submit</button>
            </div>
            </div>";
      }
    else{
      $result=mysqli_query($link,"SELECT * FROM tbl_query WHERE qid='$msg_ds'");
      $ref_update=mysqli_query($link,"UPDATE tbl_query SET status='1' WHERE qid='$msg_ds'");
      $row=mysqli_fetch_array($result);
      $dates=$row[3];
      $reply=$row[6];
      if($reply=='1'){
          $rep="";
      }
      else{
        $rep="<a href='javascript:void(0)' id='reply' role='button' class='btn btn-sm btn-secondary mt-5'> Reply <span class='fa fa-reply'></span></a>";
      }
      $postDate=date('M d,Y', strtotime($dates));
      $id=$row[5];
      $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE id='$id'");
      $getType=mysqli_fetch_array($retval1);

      $div="<div class='row' id='reply_row'>
          <div class='form-row'>
            <h3 class='col-12'>Query message sent to you on $row[3]</h3>
              <p class='col-12 form-control-label'>From &raquo; $getType[1] | $getType[4]</p>
              <small id='small' class='col-12'>to me<br>$postDate <a href=#!>Details</a></small>
          </div>
          <div class='form-row' style='white-space:pre-line'>
            $row[2]
          </div>
          </div>
          <a href='view-messages?$rand1&v&$rand2' role='button' class='btn btn-sm btn-secondary mt-5'> &laquo; back</a> $rep";
    }
  }
echo $div;
?>