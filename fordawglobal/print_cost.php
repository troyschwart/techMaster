<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Logistic Software | Printing Landing Cost";
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

//GETTING ALL BL'S
if(isset($_GET['pw'])){
    $bl=$_GET['pw'];
    $results=mysqli_query($link,"SELECT * FROM tbl_costbl WHERE bl='$bl'");
    if(mysqli_num_rows($results)>0){
        $result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_costbl WHERE bl='$bl'");
        $row_t=mysqli_fetch_array($result_t);
        $total=number_format($row_t['total'],2);
        $i=1;
        while ($rows=mysqli_fetch_array($results)) {
          $blNo=$rows[1];
          $sice=$rows[2];
          $eta=$rows[6];
          $conNo=$rows[7];
          @$option.="<tr>
                <td> $i</td>
                <td>$rows[3]</td>
                <td>".number_format($rows[4],2)."</td>
              </tr>";
          $i++;
        }
    }
    else{
      header("Location:cost-bl?$rand1&&act&pw&$rand2");
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
  #table_bl td,th{
    font-size: .7rem !important;
  }
  td{
      padding-left: .5rem;
    }
</style>
<body oncontextmenu="return true">
  <!-- Print View -->
  <div class="col-md-12 text-uppercase" id="main_page" style="background: #fff;padding:2rem;">
  	<div class="row">
      <?=@$div; ?>
  		<div class="col-md-12 text-center mb-4"><h1 style="font-size:1.5rem;"><img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo" height="50" width="70"> FORD A.W GLOBAL CONCEPT LIMITED</h1></div>
  	</div>
    <div class="col-md-12">
    <div class="col-md-12 text-right"><b>Date:</b> <?php echo date('d-m-Y');?></div>
      <div class="row mt-5">
        <div class="form-row col-12">
          <label class="col-3 form-control-label"><h4>BL Number: <?=$blNo;?></h4></label>
          <label class="col-3 form-control-label"><h4>Container Number: <?=$conNo;?></h4></label>
          <label class="col-3 form-control-label"><h4>SIZE: <?=$sice;?></h4></label>
          <label class="col-3 form-control-label"><h4>E.T.A: <?=$eta;?></h4></label>
        </div>
      </div>
      <table border="1" width="100%">
          <tr style="font-weight: bold;">
          <td>S/N</td>
          <td>Description</td>
          <td>Amount</td></tr>
        <?= @$option;?>
        <tr><td colspan="2" class="text-center"><b>total</b></td><td style="padding-left:0.3rem;"><s style='text-decoration-style:double;'>N</s>  <?=@$total?></td></tr>
      </table>
    </div>
  	<br>
   <br>
    
  <div class="row" id="printBar">
    <div class="col-md-12">
      <div class="text-center mt-3">
        <button type="button" id="btn_back" class="btn btn-danger" onclick="window.history.back()"><span class="fa fa-angle-double-left"></span> Back</button>
        <button type="submit" class="btn btn-primary" id="btn" name="print" onclick="this.style.display='none';btn_back.style.display='none';javaScript:window.print();"><span class="fa fa-print"></span> Print</button>
      </div>
    </div>
  </div>
</div>
<?php include 'f_print.php'; ?>