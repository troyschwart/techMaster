<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Logistic Software | Printing Transire";
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
$list=$acctype;
//CHECKING PAGE VALIDATION
if($list=="Secretary" || $list=="Administrator"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}
//SELECTING TRANSIRE DETAILS
if(isset($_GET['vw'])){
    $printid=$_GET['vw'];
    //GETTING THE PORT OF DISCHARGE
    $result1=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$printid'");
    $row1=mysqli_fetch_array($result1);

    $result=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$printid'");
    if(mysqli_num_rows($result)==1){
      $i=1;
      $results=mysqli_query($link,"SELECT * FROM container_seal WHERE tid='$printid'");
     while ($rowCon=mysqli_fetch_array($results)) {
        @$viewCon.="<table border='0' class='text-center' width='100%'><tr><td>$rowCon[2]</td></tr></table>";
      }
      $results1=mysqli_query($link,"SELECT * FROM container_seal WHERE tid='$printid'");
     while ($rowCon1=mysqli_fetch_array($results1)) {
        @$viewCon1.="<table border='0' class='text-center' width='100%'><tr><td>$rowCon1[3]</td></tr></table>";
      }
      while ($row=mysqli_fetch_array($result)) {
        @$options.="<tr>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'> $i</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[1]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[2]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[4]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[5]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[6]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$viewCon</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$viewCon1</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;white-space:pre-line;'>$row[7] </td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000; white-space:pre-line;'>$row[9]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[10]</td>
            </tr>
            <tr><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'>&nbsp;</td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td></tr>
            <tr><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td>$row[8]</td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td></tr>
            ";
        $i++;
      }
    }
    else{
      $printid=$_SESSION['vw'];
      header("Location:view_transire?$rand1&vw=$printid&$rand1");
    }
}
else{
    $printid=$_POST['tid'];
    //GETTING THE PORT OF DISCHARGE
    $result1=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$printid'");
    $row1=mysqli_fetch_array($result1);

    $result=mysqli_query($link,"SELECT * FROM tbl_transire WHERE tid='$printid'");
    if(mysqli_num_rows($result)==1){
      $i=1;
      while ($row=mysqli_fetch_array($result)) {
        @$options.="<tr>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'> $i</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[1]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[2]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[4]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[5]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[6]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[7]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[8]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[9] </td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[11]</td>
              <td style='border-left: 1px solid #000;border-right: 1px solid #000;'>$row[12]</td>
            </tr>
            <tr><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'>&nbsp;</td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td></tr>
            <tr><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td>$row[10]</td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td><td style='border-left: 1px solid #000;border-right: 1px solid #000;'></td></tr>
            ";
        $i++;
      }
    }
    else{
      $printid=$_SESSION['vw'];
      header("Location:view_transire?$rand1&vw=$printid&$rand1");
    }
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
</style>
<body oncontextmenu="return true">
  <!-- Print View -->
  <div class="text-uppercase" id="main_page" style="background: #fff;padding:2rem;">
  	<div class="row"><!--img src="../assets/img/brand/logo.png" class="" alt="..." width="45" height="45"-->
      <?=@$div; ?>
  		<div class="col-md-12 text-center"><h1 style="font-size:2rem;"><u> TRANSIRE MANIFEST</u></h1><u style="font-size:1.3rem;">inland containers (Nigeria limited)</u></div>
  	</div>
  	<div class="row">
  		<div class="col-sm-4 col-md-8"><b>terminal requesting transfer</b></div>
  		<div class="col-sm-4 col-md-4"><b>icd kano via apapa, klt,</b></div>
  		<div class="col-sm-4 col-md-7"><b>Area command <u>Kano/jigawa area command</u></b></div> 
      <div class="col-sm-4 col-md-5"><b>port of discharge <?php echo $row1[3];?></b></div>
  	</div><br><br>
  	<table class="text-center" style="border-bottom: 1px solid #000;border-left: 1px solid #000;border-right: 1px solid #000;">
  		<tr>
          <td style='border: 1px solid #000;'>s/no</td>
          <td style='border: 1px solid #000;'>bill of lading</td>
          <td style='border: 1px solid #000;'>Name of ship rotation no. & date</td>
          <td style='border: 1px solid #000;'>country of origin</td>
          <td style='border: 1px solid #000;'>fractional numbering</td>
          <td style='border: 1px solid #000;'>type of cont. 20/40</td>
          <td style='border: 1px solid #000;'>container no.</td>
          <td style='border: 1px solid #000;'>seal no.</td>
          <td style='border: 1px solid #000;'>importers name & address</td>
          <td style='border: 1px solid #000;'>description of goods</td>
          <td style='border: 1px solid #000;'>weight net (KG)</td>
      	</tr>
        <?= $options;?>
  	</table>
  	<br>
    <div class="row" style="padding-left:1rem;">
      <div class="col-md-12">
        RECOMMENDED BY C.A.C ORIGINATING AREA:__________________________________________________________________________________________
      </div>
        <div class="col-md-12">APPROVAL BY C.A.C PORT DISCHARGE:__________________________________________________________________________________________________</div>
     
        <div class="col-md-12"> ___________________________________________________________________________________________________________________________________________</div>
  </div>
   <br>
    <div class="row">
      <div class="col-sm-6 col-md-6">&nbsp;</div>
      <div class="col-sm-6 col-md-6">
          <div class="col-md-12" style="margin-left:5rem;">NAME OF APPLICANT:__________________________________</div>
          <div class="col-md-12" style="margin-left:5rem;">SIGNATURE:____________________________________________</div>
          <div class="col-md-12" style="margin-left:5rem;">DATE:___________________________________________________</div>
      </div>
  </div>
  <div class="row" id="printBar">
    <div class="col-md-12">
      <div class="text-center mt-3">
        <button type="button" id="btn_back" class="btn btn-danger" onclick="window.history.back()"><span class="fa fa-angle-double-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="btn" name="print" onclick="this.style.display='none';btn_back.style.display='none';javaScript:window.print();"><span class="fa fa-print"></span> Print Transire</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>