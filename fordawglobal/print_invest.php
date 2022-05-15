<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Logistic Software | Printing Outstanding Jobs";
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
$list=$acctype;
//CHECKING PAGE VALIDATION
if($list=="Administrator" || $list=="Accountant"){?>
  
<?php
}
else{?>
  <script type="text/javascript">
          window.location="dashboard?page=<?=$rand1?>&link=error!";
    </script>
<?php
}

//PRINTING EXPENSES
@$_SESSION['vw']=$_GET['vw'];
if(isset($_GET['vw'])){
    $d=$_GET['vw'];
    $results=mysqli_query($link,"SELECT * FROM tbl_invest WHERE sn='$d'");
    if(mysqli_num_rows($results)>0){
        $result_t=mysqli_query($link,"SELECT SUM(totals) as total FROM tbl_invest WHERE sn='$d'");
        $row_t=mysqli_fetch_array($result_t);
        $total=number_format($row_t['total'],2);
        $i=1;
        while ($row=mysqli_fetch_array($results)) {
          @$option.="<tr>
                <th> $i</th>
                <th>$row[1]</th>
                <th>$row[2]</th>
                <th>$row[3]</th>
                <th>$row[4]</th>
                <th>$row[5]</th>
                <th>$row[6]</th>
                <th>$row[7]</th>
                <th>$row[8]</th>
                <th>$row[9]</th>
                <th>$row[10]</th>
                <th>$row[11]</th>
                <th>$row[12]</th>
                <th>".number_format($row[13],2)."</th>
                <th>".number_format($row[14],2)."</th>
                <th>".number_format($row[15],2)."</th>
                <th>".number_format($row[16],2)."</th>
                <th>".number_format($row[17],2)."</th>
                <th>$row[18]</th>
                <th>".number_format($row[19],2)."</th>
                <th>$row[20]</th>
              </tr>";
          $i++;
        }
    }
    /*else{
      $printID=$_SESSION['vw'];
      header("Location:view_expenses?$rand1&vw=$printID&$rand2");
    }*/
}
else{
        $results=mysqli_query($link,"SELECT * FROM tbl_invest");
        $result_t=mysqli_query($link,"SELECT SUM(totals) as total FROM tbl_invest");
        $row_t=mysqli_fetch_array($result_t);
        $total=number_format($row_t['total'],2);
        $i=1;
        while ($row=mysqli_fetch_array($results)) {
          @$option.="<tr>
                <th> $i</th>
                <th>$row[1]</th>
                <th>$row[2]</th>
                <th>$row[3]</th>
                <th>$row[4]</th>
                <th>$row[5]</th>
                <th>$row[6]</th>
                <th>$row[7]</th>
                <th>$row[8]</th>
                <th>$row[9]</th>
                <th>$row[10]</th>
                <th>$row[11]</th>
                <th>$row[12]</th>
                <th>".number_format($row[13],2)."</th>
                <th>".number_format($row[14],2)."</th>
                <th>".number_format($row[15],2)."</th>
                <th>".number_format($row[16],2)."</th>
                <th>".number_format($row[17],2)."</th>
                <th>$row[18]</th>
                <th>".number_format($row[19],2)."</th>
                <th>$row[20]</th>
              </tr>";
          $i++;
        }
}

/*$datefrom=$_SESSION['Dfrom'];
$dateto=$_SESSION['Dto'];
echo $dd=date('Y-m-d',  strtotime($datefrom));
echo $day=date('Y-m-d',  strtotime($dateto));*/
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
  #table_bl th,th{
    font-size: .7rem !important;
  }
  /*th{
      padding-left: 1.5rem;
    }*/
</style>
<body oncontextmenu="return true">
  <!-- Print View -->
  <div class="col-md-12 text-uppercase" id="main_page" style="background: #fff;padding:2rem;">
  	<div class="row">
      <?=@$div; ?>
  		<div class="col-md-12 text-center mb-4"><h1 style="font-size:1.5rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1><h3 class="text-muted">OUTSTANDING JOBS::AMOUNT INVESTMENT</h3></div>
  	</div>
    <div class="col-md-12">
    <div class="col-md-12 text-right mb-3"><b>Date:</b> <?php echo date('d-m-Y');?></div>
      <!--div class="row mt-5 text-uppercase">
        <div class="form-row col-12">
          <label class="col-md-4 form-control-label"><h3>LADING COST OF BL: <u><?=$blNo;?></u></h3></label>
          <label class="col-md-4 form-control-label"><h3>SIZE: <?=$sice;?></h3></label>
          <label class="col-md-4 form-control-label"><h3>E.T.A: <?=$eta;?></h3></label>
        </div>
      </div-->
      <table border="1">
          <tr style="font-weight: bold;">
            <th>S/No.</th>
            <th>BL Number</th>
            <th>Size</th>
            <th>E.T.A</th>
            <th>Registration Date</th>
            <th>Type of Goods</th>
            <th>Customer Name</th>
            <th>Advice</th>
            <th>Container Deposit</th>
            <th>Shipping</th>
            <th>Terminal</th>
            <th>Transport</th>
            <th>Paar</th>
            <th>CPC/DTI</th>
            <th>Duty Payable</th>
            <th>Settlement</th>
            <th>NAFDAC</th>
            <th>SON</th>
            <th>Others</th>
            <th>Totals</th>
            <th>Posted on</th>
          </tr>
        <?= @$option;?>
        <tr><th colspan="19" class="text-center"><b>totals</b></th><th style="padding-left:0.3rem;"><s style='text-decoration-style:double;'>N</s><?=@$total?></th></tr>
      </table>
    </div>
  	<br>
   <br>
    
  <div class="row" id="printBar">
    <div class="col-md-12">
      <div class="text-center mt-3">
        <button type="button" id="btn_back" class="btn btn-danger" onclick="window.location='view_invest?inv=<?=$rand1?>'"><span class="fa fa-angle-double-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="btn" name="print" onclick="this.style.display='none';btn_back.style.display='none';javaScript:window.print();"><span class="fa fa-print"></span> Print</button>
      </div>
    </div>
  </div>
</div>
<?php include 'f_print.php'; ?>