<?php 
if(!defined('header')){
  exit("<h1>Server say's:</h1><h3>page does not exist !!! or invalid link entered</h3>");
}
include('../includes/connection.php');
$title="Fordawglobal  - Logistic Software";
if(isset($_GET['reset'])){}
else if(isset($_GET['qst'])){
  $login="Enquiry Page";
}
else{
  $login="Login";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Fordawglobal Logistic Company">
  <meta name="author" content="Fordawglobal Software">
  <title><?=$title ?></title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- SWEET ALERT -->
  <link rel="stylesheet" href="../assets/css/sweetalert2.css" type="text/css">
  <script src="../assets/js/sweetalert2.all.min.js"></script>
  <script src="../assets/js/sweetalert.min.js"></script>
</head>

<body class="bg-default" oncontextmenu="return false" style="user-select: none;">
  <!-- Navbar -->
  <nav id="navbar-main" class="navbar navbar-horizontal navbar-transparent navbar-main navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="dashboard">
        <img src="../assets/img/brand/logo.png" alt="ford logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="dashboard">
                <img src="../assets/img/brand/logo.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="login?login=<?=$rand1; ?>" class="nav-link">
              <span class="nav-link-inner--text"><?=@$login?></span>
            </a>
          </li>
        </ul>
        <hr class="d-lg-none" />
        <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.facebook.com/" target="_blank" data-toggle="tooltip" data-original-title="Like us on Facebook">
              <i class="fab fa-facebook-square"></i>
              <span class="nav-link-inner--text d-lg-none">Facebook</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://www.instagram.com/" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Instagram">
              <i class="fab fa-instagram"></i>
              <span class="nav-link-inner--text d-lg-none">Instagram</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://twitter.com/" target="_blank" data-toggle="tooltip" data-original-title="Follow us on Twitter">
              <i class="fab fa-twitter-square"></i>
              <span class="nav-link-inner--text d-lg-none">Twitter</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-link-icon" href="https://whatsapp.me/" target="_blank" data-toggle="tooltip" data-original-title="Chat us on Whatsapp">
              <i class="fab fa-whatsapp"></i>
              <span class="nav-link-inner--text d-lg-none">Whatsapp</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
