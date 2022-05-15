<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Logistic Software | Printing BL";
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
$list=$acctype;
//CHECKING PAGE VALIDATION
if($list=="Transport Manager" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
/*//GETTING ALL BL'S
if(isset($_GET['pw'])&&$_GET['pw']=='all'){
    $result=mysqli_query($link,"SELECT * FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid=cn.bid ORDER BY bl.blDate");
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[20]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[16]</td>
              <td>$row[9]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[8]</td>
              <td>$row[10]</td>
              <td>$row[11]</td>
              <td>$row[12]</td>
            </tr>
            ";
        $i++;
      }
}*/
//SELECTING BY ID
if(isset($_GET['vw'])){
    $printID=$_GET['vw'];
    $result=mysqli_query($link,"SELECT * FROM tbl_tp WHERE tid='$printID'");
    if(mysqli_num_rows($result)==1){
      $i=1;
      $results=mysqli_query($link,"SELECT * FROM tp_container WHERE tid='$printID'");
     while ($rowCon=mysqli_fetch_array($results)) {
        @$viewCon.="<table border='1' class='text-center' width='100%'><tr><td>$rowCon[2]</td></tr></table>";
     }
      while ($row=mysqli_fetch_array($result)) {
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$viewCon</td>
              <td>$row[2]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$row[8]</td>
              <td>$row[9]</td>
              <td>$row[10]</td>
              <td style='white-space:pre-wrap;'>$row[11]</td>
              <td>$row[12]</td>
            </tr>
            ";
        $i++;
      }
    }
    else{
      //$printID=$_GET['vw'];
      header("Location:add_tp?$rand1&vw&$rand1");
    }
}
/*//SELECTING BY DATES
if(isset($_GET['date_checker'])){
    $datefrom=$_SESSION['Dfrom'];
    $dateto=$_SESSION['Dto'];
    $dd=date('Y-m-d',  strtotime($datefrom));
    $day=date('Y-m-d',  strtotime($dateto));
    $result=mysqli_query($link,"SELECT * FROM tbl_bill as bl,tbl_containers as cn WHERE bl.bid=cn.bid AND bl.blDate BETWEEN '$dd' AND '$day' ORDER BY bl.blDate");
    if(mysqli_num_rows($result)>0){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$options.="<tr>
              <td> $i</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td> $row[21]</td>
              <td>$row[3]</td>
              <td>$row[4]</td>
              <td>$row[16]</td>
              <td>$row[9]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[8]</td>
              <td>$row[10] </td>
              <td>$row[11]</td>
              <td>$row[12]</td>
            </tr>
            ";
        $i++;
      }
    }
    else{
      header("Location:view_bl?$rand1&null&$rand1");
    }
}*/
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
      <div class="col-md-12 text-center mb-2"><h1 style="font-size:1.5rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1></div>
  		<div class="col-md-12 text-center mb-4"><h2 style=""><u> TRANSPORTATION DETAILS</u></h2></div>
  	</div>
    <div class="col-md-12">
      <table class="text-center" width="100%" id="table_bl" border="1">
    		<tr>
            <th>S/No.</th>
            <th>BL Number</th>
            <th>Container Number</th>
            <th>Container Size</th>
            <th>Transporter Name</th>
            <th>Driver Name</th>
            <th>Driver Phone Number</th>
            <th>Loading Date</th>
            <th>Arrival Date</th>
            <th>Current Location & State</th>
            <th>Departure Date from Kano</th>
            <th>Return Date</th>
            <th>Remarks</th>
            <th>Posted on</th>
        	</tr>
          <?= $options;?>
    	</table>
    </div>
  	<br>
   <br>
    
  <div class="row" id="printBar">
    <div class="col-md-12">
      <div class="text-center mt-3">
        <button type="button" id="btn_back" class="btn btn-danger" onclick="window.history.back()"><span class="fa fa-angle-double-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="btn" name="print" onclick="this.style.display='none';btn_back.style.display='none';javaScript:window.print();"><span class="fa fa-print"></span> Print Ford Jobs</button>
      </div>
    </div>
  </div>
</div>
<?php include 'f_print.php'; ?>