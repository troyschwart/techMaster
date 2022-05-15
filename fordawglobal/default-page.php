<?php 
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
$title="Fordawglobal Dashboard - Logistic Software | Printing BL";

  $div="<script>
        Swal.fire({
              title: 'Sorry !!!',
              text: 'Please we are working on this page.it will be ready soon. ?',
              icon: 'warning',
              showCancelButton:false,
              confirmButtonColor:'#007bff',
              cancelButtonColor:'#dc3545',
              confirmButtonText: 'Ok',
              showLoaderOnConfirm:true
            })
            setTimeout(function(){
                window.history.back();
              },5000)
    </script>";

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
  <link rel="stylesheet" href="../assets/css/sweetalert2.css" type="text/css">
  <script src="../assets/js/sweetalert.min.js"></script>
  <script src="../assets/js/sweetalert2.all.min.js"></script>
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
  <?php echo @$div;?>
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!--script src="../assets/js/bootstrap.js" type="text/javascript"></script-->
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/js.cookie.js"></script>
<script src="../assets/js/jquery.scrollbar.min.js"></script>
<script src="../assets/js/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="../assets/js/Chart.min.js"></script>
<script src="../assets/js/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.2.0"></script>
<!--script src="../assets/js/number-divider.min.js"--></script>
<?php include '../includes/modals.php'; ?>
<?php include '../includes/custom.php'; ?>
</body>
</html>