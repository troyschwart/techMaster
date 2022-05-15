<?php include 'menu_nav.php'; ?>

 <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <div style="font-family:'cooper black';" id="ford_name"><h2 class="text-white">FORD A.W GLOBAL CONCEPT LIMITED</h2><p class="text-white">Welcome <?=$check[1]; ?></p><!-- <h3 class="text-white wow pulse" data-wow-duration="10s" data-wow-iteration="infinite"><?=$greet;?></h3> --><h3 class="text-white" style="font-family: 'Copperplate Gothic Bold';"><?=date('d-m-Y');?> &nbsp;&nbsp;&nbsp;&nbsp;<span id="timer"></span></h3></div>
          <!--form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" placeholder="Search" type="text">
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form-->
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <!--li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li-->
            <!-- NOTIFICATION BELL -->
            <li class="nav-item dropdown" <?php if($list=="Breverage"){echo "style='display:none'";} else if($check[1]!="Administrator"){echo "style='display:none'";} ?>>
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Messages <button class="badge badge-danger badge-pill" <?php if($act_mes==0){echo "style='display:none;'";} ?>><?=$act_mes;?></button>
              </a>
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">You have <strong class="text-primary"><?=$act_mes;?></strong> new notifications.</h6>
                </div>
                <!-- List group -->
                  <div class="list-group list-group-flush">
                  <?php while($message=mysqli_fetch_array($myact_mes1)) {$email=$message[2];
                  $retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
                  $resMeg=mysqli_fetch_array($retval1);?>

                  <a href="view-messages?<?=$rand1?>&ad=<?=$message[0]?>&<?=$rand2?>" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="<?=$resMeg[10];?>" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm"><?=$message[1]; ?></h4>
                          </div>
                          <div class="text-right text-muted">
                            <small><?=$message[6]; ?></small>
                          </div>
                        </div>
                        <p class="text-sm mb-0"><?=$message[3]; ?></p>
                      </div>
                    </div>
                  </a>
                <?php } ?>
                </div><!-- END LIST GROUP -->
                <!-- View all -->
                <a href="view-messages?<?=$rand1?>&vall&<?=$rand2?>" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
              </div>
            </li>

            <!-- TOAST -->
              <div class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="7200" <?php if($list=="Breverage"){echo "style='display:none'";} else if($check[1]!="Administrator"){echo "style='display:none;'";}else{if($act_mes==0){echo "style='display:none;'";}else{echo "style='display:block;width:auto;position:absolute;top:70px;right:19%;z-index: 99;'";}}  ?>>
                <div class="toast-header">
                  <img src="../assets/img/brand/user.png" class="rounded mr-2" alt="..." height="20" width="20">
                  <strong class="mr-auto">Welcome <?=$check[1]; ?></strong>
                  <!--small>11 mins ago</small-->
                  <button type="button" class="ml-5  close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="toast-body">
                  you have <?=$act_mes;?> new notification messages
                </div>
              </div>
          </ul>
          <?php include 'dropmenu.php'; ?>
        </div>
      </div>
    </nav>
    
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <!--a href="#" class="btn btn-sm btn-neutral">New</a-->
              <!--a href="#" class="btn btn-sm btn-neutral">Filters</a-->
            </div>
          </div>
          <!-- Card stats -->
          <div class="row">
            <?php switch ($list) {case 'Secretary':;?>
            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_transire?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Transire Manifest</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num1;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-calendar-grid-58"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Previous Transire's</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href=""><h5 class="card-title text-uppercase text-muted mb-0">Transire Manifest</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num2;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!--span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span-->
                    <span class="text-nowrap">Since today</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_expenses?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Expenses Added Today</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_expen;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="fa fa-calculator"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">Totals:</span>
                    <span class="text-success"><s style='text-decoration-style:double;'>N</s> <?=@$total_expen;?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-compass-04"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Activity Tracker</span>
                  </p>
                </div>
              </div>
            </div>

            <?php break; case 'Accountant':;?>
            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_invest?inv=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Amount Invested</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_invest;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">Totals:</span>
                    <span class="text-success"><s style='text-decoration-style:double;'>N</s> <?=@$total_invest;?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view-customer?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Customer Account</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_account;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">On <?=Date('l jS \of F,Y')?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_expenses?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Expenses Added Today</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_expen;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">Totals:</span>
                    <span class="text-success"><s style='text-decoration-style:double;'>N</s> <?=@$total_expen;?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-compass-04"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Activity Tracker</span>
                  </p>
                </div>
              </div>
            </div>

            <?php break; case 'Shipping Manager':;?>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="view_bl?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total BL Number</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_bill;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-calendar-grid-58"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Previous BL's</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="follow-up?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total follow up</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_follow;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                          <i class="fa fa-fax"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Follow up statistic</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="follow-up?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Terminal Jobs</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_term;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                          <i class="fa fa-chart-bar"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Terminal Jobs statistic</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-compass-04"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Activity Tracker</span>
                    </p>
                  </div>
                </div>
              </div>

            <?php break; case 'Releasing Officer':;?>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="view_bl?<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total BL Number</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_bill;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-calendar-grid-58"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Previous BL's</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-compass-04"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Activity Tracker</span>
                    </p>
                  </div>
                </div>
              </div>

              <?php break; case 'Transport Manager':;?>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="add_tp?vw=<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Transportation</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_tp;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-calendar-grid-58"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">View Transport</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-compass-04"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Activity Tracker</span>
                    </p>
                  </div>
                </div>
              </div>

              <?php break; case 'Manager':;?>
              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="custom-exam?ce=<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Custom Examination</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_custom;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                          <i class="ni ni-calendar-grid-58"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">View Custom Examination</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="view-app?<?=$rand2?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Approval Messages</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$fet;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                          <i class="fa fa-envelope"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">View Approval Messages</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="view-messages?<?=$rand1?>&vall&<?=$rand2?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Query Messages</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_msg1;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                          <i class="fa fa-envelope"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">View Query Messages</span>
                    </p>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-md-6">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Recent Activities</h5>
                        <span class="h2 font-weight-bold mb-0"><?=$act_num;?></span></a>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                          <i class="ni ni-compass-04"></i>
                        </div>
                      </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                      <span class="text-nowrap">Activity Tracker</span>
                    </p>
                  </div>
                </div>
              </div>

            <?php break; case 'Administrator':;?>
            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="manage-users?act=<?=$rand2;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Users Added</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_user;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Members Registered</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_transire?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Transire Manifest</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num1;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!--span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span-->
                    <span class="text-nowrap">Previous Transire's</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_bl?bl=<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total BL's</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_bill;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap">Bill of Ladings</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_expenses?<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Expenses Added Today</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_expen;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">Totals:</span>
                    <span class="text-success"><s style='text-decoration-style:double;'>N</s> <?=@$total_expen;?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_invest?inv=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Amount Invested</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_invest;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">Totals:</span>
                    <span class="text-success"><s style='text-decoration-style:double;'>N</s> <?=@$total_invest;?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view-customer?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Customer Account</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_account;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm" style="font-family: 'arial black';">
                    <span class="text-nowrap">On <?=Date('l jS \of F,Y')?></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="recent-act?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">All Activities</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num_all;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-compass-04"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">Activity Tracker</span>
                  </p>
                </div>
              </div>
            </div>

            <?php break; case 'Breverage':;?>
            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="manage-users?act=<?=$rand2;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Outlet Added</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_user;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                        <i class="fa fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-nowrap">View Outlet Added</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_transire?act=<?=$rand1;?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Stocks Added</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_num1;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!--span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span-->
                    <span class="text-nowrap">View Stocks Added</span>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a href="view_bl?bl=<?=$rand1?>"><h5 class="card-title text-uppercase text-muted mb-0">Total Payments</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$act_bill;?></span></a>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                    <span class="text-nowrap">View Payments</span>
                  </p>
                </div>
              </div>
            </div>
            <?php break; default:;?>
            <?php header("location:fordawglobal/login?sid=$rand1"); ?>
          <?php }?>
          </div><!-- END ROW -->
        </div><!-- END HEADER BODY -->
      </div>
    </div>
    <!-- Page content -->
     <div style="height:180px;">&nbsp;</div>
<?php include 'footer2.php'; ?>