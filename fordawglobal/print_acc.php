<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Logistic Software | Customer's Account";
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
$list=$acctype;
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
//PRINTING THE CUSTOMER ACCOUNT
$id=$_POST['cuid'];
$_SESSION['id']=$id;
$id2=$_SESSION['id'];
$result1=mysqli_query($link,"SELECT SUM(amount_cha) as ac,SUM(credits) as cd,SUM(bal) as bl FROM tbl_cus WHERE cusid='$id'");
$rows=mysqli_fetch_array($result1);
$ob=number_format($rows['ac'],2);
$cd=number_format($rows['cd'],2);
$bl=number_format($rows['bl'],2);

$result_name=mysqli_query($link,"SELECT * FROM tbl_cus WHERE cusid='$id' ORDER BY id DESC");
$row_=mysqli_fetch_array($result_name);
//SELECTING ALL DETAILS
$result=mysqli_query($link,"SELECT * FROM tbl_cus WHERE cusid='$id'");
if(mysqli_num_rows($result)>0){
  $i=1;
while ($row=mysqli_fetch_array($result)) {
   //GETTING NAME FROM CUSTOMER TABLE
  @$option1.="<tr>
              <td> $i</td>
              <td>$row[2]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>".number_format($row[8],2)."</td>
              <td>".number_format($row[9],2)."</td>
              <td>".number_format($row[10],2)."</td>
            </tr>";
    $i++;
  }
  $option1.="<tr><td colspan='6' class='text-center'><b>TOTALS </b></td><td>$ob</td><td>$cd</td><td>$bl</td></tr>";
}
else{
  header("location:cust-acc?$rand1&cs=$id2&$rand2");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../assets/css/bs/bootstrap.min.css" type="text/css">
  <link href="../assets/css/bs/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css" media="all">
  <link rel="stylesheet" href="../assets/css/print_set.css" type="text/css" media="print">
  <!-- SWEET ALERT -->
  <script src="../assets/js/sweetalert.min.js"></script>
</head>
<style type="text/css">
  /*table tr:nth-child(1){
    border: 1px solid #000;
  }*/
  #table_bl td,th{
    font-size: .7rem !important;
  }
</style>
<body oncontextmenu="return true">
  <!-- Print View -->
  <div class="col-md-12 text-uppercase" id="main_page" style="background: #fff;padding:2rem;">
  	<div class="row">
      <?=@$div; ?>
  		<div class="col-md-12 text-center mb-4"><h1 style="font-size:2rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1>
        <h1 style="font-size:1.2rem;margin-top:3rem;" class="text-danger"><u>SUMMARY OF CUSTOMER'S ACCOUNT </u></h1></div>
  	</div>
    <div class="col-md-12">
    <div class="col-md-12 text-right"><b>Date:</b> <?php echo date('d-m-Y');?></div>
      <div class="row mt-5 text-uppercase">
        <div class="form-row col-12">
          <label class="col-md-8 form-control-label"><h3>CUSTOMERS ID: <i><?=$row_[1];?></i></h3></label>
          <label class="col-md-8 form-control-label"><h3>CUSTOMERS NAME: <i><?=$row_[3];?></i></h3></label>
          <label class="col-md-4 form-control-label"><h3>CLOSING BALANCE: <i><s style='text-decoration-style:double;'>N</s><?=number_format($row_[10],2);?></i></h3></label>
        </div>
      </div>
      <!-- <table class="table table-hover table-striped table-bordered text-black text-uppercase" width="100%" id="example">
          <th>S/N</th>
          <th>Opening Balance</th>
          <th>Debit</th>
          <th>Credit</th>
          <th>Closing Balance</th>
          <th>Paid On</th>
        <?= @$option;?>
        <tr><td colspan="2" class="text-center" style="font-weight:bold;"><b>total</b></td>
          <td style="font-weight:bold;"><s style='text-decoration-style:double;'>N</s>  <?=@$total?></td>
          <td style="font-weight:bold;"><s style='text-decoration-style:double;'>N</s>  <?=@$total1?></td>
          <td></td>
          <td></td></tr>
      </table> -->
      <table class="table table-hover table-striped table-bordered text-black text-uppercase" width="100%" id="example">
        <th>S/N</th>
        <th>Date</th>
        <th>Description</th>
        <th>ETA</th>
        <th>Size</th>
        <th>Type of Goods</th>
        <th>Amount Charged</th>
        <th>Credit</th>
        <th>Balance</th>
      <?=@$option1;?>
    </table>
    </div>
  	<br>
   <br>
    
  <!--div class="row" id="printBar">
    <div class="col-md-12">
      <div class="text-center mt-3">
        <button type="button" id="btn_back" class="btn btn-danger" onclick="window.history.back()"><span class="fa fa-angle-double-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="btn" name="print" onclick="this.style.display='none';btn_back.style.display='none';javaScript:window.print();"><span class="fa fa-print"></span> Print</button>
      </div>
    </div>
  </div-->
</div>
<?php include 'f_print.php'; ?>
<script type="text/javascript">
  $(document).ready(function(){
      javaScript:window.print();
  });
</script>