<?php 
define('header', TRUE);
include('../includes/connection.php');
if (!(isset($_SESSION['login']))){
    header ('location:../index.php');
}
//AUTO LOGOUT ON REFRESH
/*if(isset($_SESSION['login'])){
  if((time()-$_SESSION['last_login'])>600){ //600=10*60 10 seconds checker)
    header ( 'location:logout' );
  }
}*/
$title="Fordawglobal Dashboard - Logistic Software";
//FETCHING DATA FROM REGISTRATION TABLE
$email=$_SESSION['login'];
@$list=$_SESSION['list'];
$retval1=mysqli_query($link,"SELECT * FROM tbl_register WHERE email='$email'");
$check=mysqli_fetch_array($retval1);
$uid=$check[0];
$acctype=$check[1];
$_SESSION['keystatos']=$check[12];
if($list=="Breverage"){
  $list="Breverage";
}
else{
  $list=$acctype;
}
$date_today=date("Y-m-d");
//TOTAL QUERY MESSAGES
$myact_msg=mysqli_query($link,"SELECT * FROM tbl_query WHERE id='$uid' AND status='0'");
$act_msg=mysqli_num_rows($myact_msg);
$myact_msg1=mysqli_query($link,"SELECT * FROM tbl_query WHERE status='0'");
$act_msg1=mysqli_num_rows($myact_msg1);
//SELECTING USER ID FROM QUERY TABLE TO CHECK
$fetch=mysqli_query($link,"SELECT * FROM tbl_query WHERE id='$uid' AND status='0'");
$fetch_msg=mysqli_fetch_array($fetch);
$msgid=$fetch_msg[1];
//TOTAL APPROVAL MESSAGES
$fetch_ap=mysqli_query($link,"SELECT * FROM tbl_approval WHERE notify='0'");
$fet=mysqli_num_rows($fetch_ap);
// $appid=$fet[1];

switch ($list) {
  case 'Secretary':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_transire?$rand1'>
        <i class='fa fa-file-export text-pink'></i>
        <span class='nav-link-text'>Add Transire</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_transire?$rand1'>
        <i class='fa fa-search-plus text-purple'></i>
        <span class='nav-link-text'>View Transire</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='expenses?$rand1'>
        <i class='fa fa-book text-info'></i>
        <span class='nav-link-text'>Add Daily Expenses</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='examination?$rand2'>
        <i class='fa fa-balance-scale text-danger'></i>
        <span class='nav-link-text'>Examination Fee</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&v&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>Check Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Accountant':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='cost-bl?$rand1'>
        <i class='fa fa-bus-alt text-info'></i>
        <span class='nav-link-text'>Lading Cost Bl</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?$rand1'>
        <i class='fa fa-chart-bar text-primary'></i>
        <span class='nav-link-text'>View Follow up List</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='cust-acc?$rand1'>
        <i class='fa fa-users text-purple'></i>
        <span class='nav-link-text'>Customers Account</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-transactions?$rand1'>
        <i class='fa fa-cogs text-orange'></i>
        <span class='nav-link-text'>view Transactions</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='expenses?$rand1'>
        <i class='fa fa-book text-info'></i>
        <span class='nav-link-text'>Add Daily Expenses</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_invest?inv=$rand2'>
        <i class='fa fa-chart-pie text-yellow'></i>
        <span class='nav-link-text'>Add Amount Investment</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?vd=$rand2'>
        <i class='fa fa-shuttle-van text-success'></i>
        <span class='nav-link-text'>Jobs Delivered</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
        <i class='fa fa-envelope-open-text text-black'></i>
        <span class='nav-link-text'>Query Staff</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&v&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>Check Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#approve'>
        <i class='fa fa-check-circle text-success'></i>
        <span class='nav-link-text'>Send Approval</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-app?$rand2'>
        <i class='fa fa-calendar-check text-success'></i>
        <span class='nav-link-text'>View Approvals</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Shipping Manager':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_bl?$rand1'>
        <i class='fa fa-file-export text-pink'></i>
        <span class='nav-link-text'>Add Bill of lading</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_bl?$rand1'>
        <i class='fa fa-search-plus text-purple'></i>
        <span class='nav-link-text'>view Bill of lading</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-transactions?$rand1'>
        <i class='fa fa-cogs text-red'></i>
        <span class='nav-link-text'>view Invoices Transactions</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?$rand1'>
        <i class='fa fa-chart-bar text-primary'></i>
        <span class='nav-link-text'>View Follow up List</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_prog?$rand1'>
        <i class='fa fa-calculator text-danger'></i>
        <span class='nav-link-text'>Progressive Report</span>
      </a>
    </li>
     <li class='nav-item'>
      <a class='nav-link' href='add_terminal?$rand1'>
        <i class='fa fa-network-wired text-warning'></i>
        <span class='nav-link-text'>Terminal Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
     <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
        <i class='fa fa-envelope-open-text text-black'></i>
        <span class='nav-link-text'>Query Staff</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&v&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>Check Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Releasing Officer':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_bl?$rand1'>
        <i class='fa fa-search-plus text-purple'></i>
        <span class='nav-link-text'>view BL Numbers</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-transactions?$rand1'>
        <i class='fa fa-cogs text-red'></i>
        <span class='nav-link-text'>View Invoices Transactions</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?$rand1'>
        <i class='fa fa-chart-bar text-primary'></i>
        <span class='nav-link-text'>View Follow up List</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
        <i class='fa fa-envelope-open-text text-black'></i>
        <span class='nav-link-text'>Query Staff</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&v&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>Check Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Transport Manager':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_tp?$rand1'>
        <i class='fa fa-user-plus text-purple'></i>
        <span class='nav-link-text'>Add Transport</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_tp?vw=$rand1'>
        <i class='fa fa-shuttle-van text-pink'></i>
        <span class='nav-link-text'>View Added Transport</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='tp-cost?$rand1'>
        <i class='fa fa-calculator text-default'></i>
        <span class='nav-link-text'>Added Container Cost</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='empty-con?$rand1'>
        <i class='fa fa-car-side text-red'></i>
        <span class='nav-link-text'>Empty Container Returns</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?$rand1'>
        <i class='fa fa-chart-bar text-primary'></i>
        <span class='nav-link-text'>View Follow up List</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
        <i class='fa fa-envelope-open-text text-black'></i>
        <span class='nav-link-text'>Query Staff</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&v&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>Check Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Manager':
    $menu="<ul class='navbar-nav'>
    <li class='nav-item'>
      <a class='nav-link active' href='dashboard?$rand1'>
        <i class='ni ni-tv-2 text-primary'></i>
        <span class='nav-link-text'>Dashboard</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='profile?my profile=$rand1'>
        <i class='ni ni-single-02 text-success'></i>
        <span class='nav-link-text'>Profile</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='custom-exam?$rand1'>
        <i class='fa fa-shuttle-van text-primary'></i>
        <span class='nav-link-text'>Custom Examination</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_expenses?$rand1'>
        <i class='fa fa-book text-info'></i>
        <span class='nav-link-text'>View Daily Expenses</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='add_terminal?t=$rand1'>
        <i class='fa fa-network-wired text-warning'></i>
        <span class='nav-link-text'>View Terminal Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-transactions?$rand1'>
        <i class='fa fa-cogs text-red'></i>
        <span class='nav-link-text'>View Invoices Transactions</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='tp-cost?$rand1'>
        <i class='fa fa-calculator text-default'></i>
        <span class='nav-link-text'>View Container Cost</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_follow?$rand1'>
        <i class='fa fa-chart-bar text-primary'></i>
        <span class='nav-link-text'>View Follow up List</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_prog?$rand1'>
        <i class='fa fa-calculator text-danger'></i>
        <span class='nav-link-text'>Progressive Report</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view_prog?vd=$rand2'>
        <i class='fa fa-shuttle-van text-success'></i>
        <span class='nav-link-text'>Jobs Delivered</span>
      </a>
    </li>
     <li class='nav-item'>
      <a class='nav-link' href='cost-bl?act=$rand1'>
        <i class='fa fa-bus-alt text-info'></i>
        <span class='nav-link-text'>Lading Cost Bl</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='cust-acc?$rand1&%v%&$rand2'>
        <i class='fa fa-chart-area text-success'></i>
        <span class='nav-link-text'>Daily Customers Account</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
        <i class='fa fa-chalkboard-teacher text-primary'></i>
        <span class='nav-link-text'>Search Jobs</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
        <i class='fa fa-envelope-open-text text-black'></i>
        <span class='nav-link-text'>Query Staff</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-messages?$rand1&qall&$rand2'>
        <i class='fa fa-envelope text-danger'></i>
        <span class='nav-link-text'>View all Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg1 </b></span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='view-app?$rand2'>
        <i class='fa fa-calendar-check text-success'></i>
        <span class='nav-link-text'>View Approvals</span>
      </a>
    </li>
    <li class='nav-item'>
      <a class='nav-link' href='logout'>
        <i class='fa fa-power-off text-dark'></i>
        <span class='nav-link-text'>Logout</span>
      </a>
    </li>
    </ul>";
    break;
    case 'Administrator':
      $menu="<ul class='navbar-nav'>
            <li class='nav-item'>
              <a class='nav-link active' href='dashboard?$rand1'>
                <i class='ni ni-tv-2 text-primary'></i>
                <span class='nav-link-text'>Dashboard</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='profile?my profile=$rand1'>
                <i class='ni ni-single-02'></i>
                <span class='nav-link-text'>My Profile</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='manage-users?mu=$rand2'>
                <i class='fa fa-user-cog text-orange'></i>
                <span class='nav-link-text'>Manage users</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='manage-transire?mg=$rand1'>
                <i class='fa fa-pen-alt text-primary'></i>
                <span class='nav-link-text'>Manage Transires</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#!' id='second-item'>
                <i class='fa fa-chart-bar text-success'></i>
                <span class='nav-link-text'>Manage BL's</span>
              </a>
              <ul id='second-list' style='display:none;>
                  <li class='nav-item'>
                    <a class='nav-link' href='view_bl?$rand1'>
                      <i class='fa fa-angle-double-right text-blue'></i>
                      <span class='nav-link-text'>View Bill of Lading</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='view_bl?$rand1&1&$rand2'>
                      <i class='fa fa-angle-right text-purple'></i>
                      <span class='nav-link-text'>view BL Numbers</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='view-transactions?$rand1'>
                      <i class='fa fa-angle-double-right text-red'></i>
                      <span class='nav-link-text'>view Transactions</span>
                    </a>
                  </li>
              </ul>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#!' id='second-item-1'>
                <i class='fa fa-users text-purple'></i>
                <span class='nav-link-text'>Manage Customer's Account</span>
              </a>
              <ul id='second-list-1' style='display:none;'>
                  <li class='nav-item'>
                    <a class='nav-link' href='cost-bl?$rand1/'>
                      <i class='fa fa-angle-double-right text-warning'></i>
                      <span class='nav-link-text'>Lading Cost</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='view_prog?$rand1&$rand2'>
                      <i class='fa fa-angle-right text-danger'></i>
                      <span class='nav-link-text'>Progressive Report</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='cust-acc?$rand1'>
                      <i class='fa fa-angle-double-right text-primary'></i>
                      <span class='nav-link-text'>Customers Account</span>
                    </a>
                  </li>
              </ul>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='expenses?$rand1'>
                <i class='fa fa-book text-info'></i>
                <span class='nav-link-text'>Add Daily Expenses</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='add_invest?inv=$rand2'>
                <i class='fa fa-chart-pie text-danger'></i>
                <span class='nav-link-text'>Add Amount Investment</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='examination?$rand2'>
                <i class='fa fa-balance-scale text-danger'></i>
                <span class='nav-link-text'>Examination Fee</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='view_follow?$rand1'>
                <i class='fa fa-chart-bar text-primary'></i>
                <span class='nav-link-text'>view Follow up List</span>
              </a>
            </li>
             <li class='nav-item'>
              <a class='nav-link' href='add_terminal?$rand1'>
                <i class='fa fa-network-wired text-warning'></i>
                <span class='nav-link-text'>Terminal Jobs</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='add_tp?vw=$rand1'>
                <i class='fa fa-shuttle-van text-pink'></i>
                <span class='nav-link-text'>View Added Transport</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='tp-cost?$rand1'>
                <i class='fa fa-calculator text-default'></i>
                <span class='nav-link-text'>Added Container Cost</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='empty-con?$rand1'>
                <i class='fa fa-car-side text-red'></i>
                <span class='nav-link-text'>Empty Container Returns</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#search_jobs'>
                <i class='fa fa-chalkboard-teacher text-primary'></i>
                <span class='nav-link-text'>Search Jobs</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='javascript:void(0)' data-toggle='modal' data-target='#query_staff'>
                <i class='fa fa-envelope-open-text text-black'></i>
                <span class='nav-link-text'>Query Staff</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='view-messages?$rand1&qall&$rand2'>
                <i class='fa fa-envelope text-danger'></i>
                <span class='nav-link-text'>View all Queries <b class='badge badge-primary badge-pill' style='font-size:.8rem;'> $act_msg1 </b></span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='view-app?$rand2'>
                <i class='fa fa-calendar-check text-success'></i>
                <span class='nav-link-text'>View Approvals</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='view-login?all logins=$rand1'>
                <i class='ni ni-key-25 text-info'></i>
                <span class='nav-link-text'>View Logins</span>
              </a>
            </li>
          </ul>";
    break;
case 'Breverage':
      $menu="<ul class='navbar-nav'>
            <li class='nav-item'>
              <a class='nav-link active' href='dashboard?$rand1'>
                <i class='ni ni-tv-2 text-primary'></i>
                <span class='nav-link-text'>Dashboard</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='profile?my profile=$rand1'>
                <i class='ni ni-single-02'></i>
                <span class='nav-link-text'>My Profile</span>
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#!' id='second-item'>
                <i class='fa fa-chart-bar text-success'></i>
                <span class='nav-link-text'>Manage Stock</span>
              </a>
              <ul id='second-list' style='display:none;>
                  <li class='nav-item'>
                    <a class='nav-link' href='add_outlet?$rand1'>
                      <i class='fa fa-angle-double-right text-blue'></i>
                      <span class='nav-link-text'>Add Outlet</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='add_stock?&$rand2'>
                      <i class='fa fa-angle-double-right text-purple'></i>
                      <span class='nav-link-text'>Add Stock</span>
                    </a>
                  </li>
              </ul>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='#!' id='second-item-1'>
                <i class='fa fa-users text-purple'></i>
                <span class='nav-link-text'>Manage Payment</span>
              </a>
              <ul id='second-list-1' style='display:none;'>
                  <li class='nav-item'>
                    <a class='nav-link' href='payments?$rand1'>
                      <i class='fa fa-angle-double-right text-warning'></i>
                      <span class='nav-link-text'>Payment Page</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='summary?$rand1'>
                      <i class='fa fa-angle-double-right text-warning'></i>
                      <span class='nav-link-text'>Payment Summary</span>
                    </a>
                  </li>
              </ul>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='logout'>
                <i class='fa fa-power-off text-dark'></i>
                <span class='nav-link-text'>Logout</span>
              </a>
            </li>
          </ul>";
    break;
}
//SELECTING CONTACT DETAILS FROM CONTACT TABLE
$retval=mysqli_query($link,"SELECT * FROM tbl_contact WHERE uid='$uid'");
$checkDetails=mysqli_fetch_array($retval);
$update=$checkDetails[7];

//SELECTING RECENT ACTIVITIES
if($acctype=="Administrator"){
  $retvalAct=mysqli_query($link,"SELECT * FROM tbl_register as r,tbl_activity as a WHERE r.ID=a.uid AND r.keyStatus='0' ORDER BY a.aid DESC LIMIT 0,10");
  //$retvalActs=mysqli_query($link,"SELECT * FROM tbl_register as r,tbl_activity as a WHERE r.ID=a.uid");
  $i=0;
  while($checkAct=mysqli_fetch_array($retvalAct)){
  $x=$checkAct[2]." ".$checkAct[3];
  $acc=$checkAct[1];
  if($i%2==1){
    $bgcolor="background-color:#fafafa";
  }
  if($i%2==0){
    $bgcolor="";
  }
  @$acts .="<div class='col-md-12 col-lg-12' style='border:1px solid #ccc;padding:0.7rem;margin-bottom:0.1rem;font-size:0.9rem;$bgcolor;'>=> <i class='text-danger'>".$checkAct[15]." ".$x." ($acc)"."</i></div>";
    $i++;
 }
}
else{
  $retvalAct=mysqli_query($link,"SELECT * FROM tbl_register as r,tbl_activity as a WHERE r.ID='$uid' AND a.uid='$uid' ORDER BY a.aid DESC LIMIT 0,10");
  //$retvalActs=mysqli_query($link,"SELECT * FROM tbl_register as r,tbl_activity as a WHERE r.ID=a.uid");
  $i=0;
  while($checkAct=mysqli_fetch_array($retvalAct)){
  $x=$checkAct[2]." ".$checkAct[3];
  $acc=$checkAct[1];
  if($i%2==1){
    $bgcolor="background-color:#fafafa";
  }
  if($i%2==0){
    $bgcolor="";
  }
  @$acts .="<div class='col-md-12 col-lg-12' style='border:1px solid #ccc;padding:0.7rem;margin-bottom:0.1rem;font-size:0.9rem;$bgcolor;'>=> <i class='text-danger'>".$checkAct[15]." ".$x." ($acc)"."</i></div>";
    $i++;
 }
}
//SELECTING ALL ACTIVITY FROM TABLE ACTIVITY
$myact_num_all=mysqli_query($link,"SELECT * FROM tbl_activity");
$act_num_all=mysqli_num_rows($myact_num_all);
//SELECTING INDIVIDUAL ACTIVITY FROM TABLE ACTIVITY
$myact_num=mysqli_query($link,"SELECT * FROM tbl_activity WHERE uid='$uid'");
$act_num=mysqli_num_rows($myact_num);
//TOTAL TRANSIRE
$myact_num1=mysqli_query($link,"SELECT * FROM tbl_transire");
$act_num1=mysqli_num_rows($myact_num1);
//TOTAL TRANSIRE SINCE TODAY
$myact_num2=mysqli_query($link,"SELECT * FROM tbl_transire WHERE postDate='$date_today'");
$act_num2=mysqli_num_rows($myact_num2);
//TOTAL BL
$myact_bill=mysqli_query($link,"SELECT * FROM tbl_bill");
$act_bill=mysqli_num_rows($myact_bill);
/*//TOTAL LADING COST
$myact_land=mysqli_query($link,"SELECT DISTINCT bl FROM tbl_costbl");
$act_land=mysqli_num_rows($myact_land);*/
//TOTAL AMOUNT INVESTMENT
$myact_invest=mysqli_query($link,"SELECT DISTINCT blNo FROM tbl_invest");
$act_invest=mysqli_num_rows($myact_invest);
//TOTAL CUSTOM EXAMINATION
$myact_custom=mysqli_query($link,"SELECT DISTINCT blNo FROM tbl_cusexam");
$act_custom=mysqli_num_rows($myact_custom);
//TOTAL FOLLOW UP
$myact_follow=mysqli_query($link,"SELECT DISTINCT blNo FROM tbl_follow");
$act_follow=mysqli_num_rows($myact_follow);
//TOTAL TRANSPORTATION
$myact_tp=mysqli_query($link,"SELECT DISTINCT blNo FROM tbl_tp");
$act_tp=mysqli_num_rows($myact_tp);
//TOTAL TERMINAL JOBS
$myact_term=mysqli_query($link,"SELECT * FROM tbl_term");
$act_term=mysqli_num_rows($myact_term);
//SUM OF TOTAL ON TABLE INVEST 
$result_t=mysqli_query($link,"SELECT SUM(totals) as total FROM tbl_invest");
$row_t=mysqli_fetch_array($result_t);
$total_invest=number_format($row_t['total']);
//TOTAL PROGRESSIVE REPORT
$myact_prog=mysqli_query($link,"SELECT * FROM tbl_prog");
$act_prog=mysqli_num_rows($myact_prog);
//TOTAL CUSTOMER ACCOUNT
$myact_account=mysqli_query($link,"SELECT * FROM tbl_cus");
$act_account=mysqli_num_rows($myact_account);
//TOTAL EXPENSES ADDED
$myact_expen=mysqli_query($link,"SELECT * FROM tbl_expen");
$act_expen=mysqli_num_rows($myact_expen);
//TOTAL DAILY EXPENSES
$result_t=mysqli_query($link,"SELECT SUM(amount) as total FROM tbl_expen");
$row_t=mysqli_fetch_array($result_t);
$total_expen=number_format($row_t['total']);
//TOTAL USERS
$myact_user=mysqli_query($link,"SELECT * FROM tbl_register WHERE keyStatus='0'");
$act_user=mysqli_num_rows($myact_user);
//TOTAL MESSAGES
$myact_mes=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE status='0' ORDER BY eid DESC");
$act_mes=mysqli_num_rows($myact_mes);
//DISPLAY  MESSAGES ON POPUP
$myact_mes1=mysqli_query($link,"SELECT * FROM tbl_enquiry WHERE status='0' ORDER BY eid DESC LIMIT 0,5");
//$act_mes=mysqli_num_rows($myact_mes);
if(isset($_GET['link'])){
    $div="<script>
          swal('You are not permitted to view that page! Please ignore such attempt because your account can be blocked','','warning')
          setTimeout(function(){
            window.location.href='dashboard?home=$rand1'
          },10000)
      </script>";
}
$showDat=date('h:i:s a');
$showDate=strtotime($showDat);
$morn=strtotime('00:00:00');
$noon=strtotime('00:00:00');
$night=strtotime('04:00:00');
if($showDate>=$morn){
  $greet="Hello, Good Morning";
}
else if($showDate>=$noon){
  $greet="Hello, Good Afternoon";
}
else if($showDate>=$night){
  $greet="Hello, Good Evening";
}
/*if($showDate>=$morn | $showDate<=$noon){
  $greet="Hello, Good Morning";
}
else if($showDate>=$noon | $showDate<=$night){
  $greet="Hello, Good Afternoon";
}
else if($showDate>=$night |$showDate<=$morn){
  $greet="Hello, Good Evening";
}*/
//SELECTING STAFF DETAILS FOR QUERYING
$results=mysqli_query($link,"SELECT * FROM tbl_bill");
  while($row_=mysqli_fetch_array($results)){
    @$optBl.="<option value='$row_[2]'>$row_[2]</option>";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Fordawglobal Logistic Company">
  <meta name="author" content="Fordawglobal Software">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css" type="text/css">
  <link href="../assets/css/bs/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/jquery-ui.css" type="text/css">
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/fontawesome-free/css/all.min.css" type="text/css">
  <link href="../assets/css/animate.css" rel="stylesheet" type="text/css" >
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="../assets/css/print_set.css" type="text/css" media="print">
  <!-- SWEET ALERT -->
  <link rel="stylesheet" href="../assets/css/sweetalert2.css" type="text/css">
  <script src="../assets/js/sweetalert2.all.min.js"></script>
  <script src="../assets/js/sweetalert.min.js"></script>
</head>
<style type="text/css">
  ul li{
    list-style-type: none;
  }
</style>
<body oncontextmenu="return false" style="user-select: none;">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main" style="height:;">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="../assets/img/brand/logo.png" class="navbar-brand-img" alt="ford logo">
        </a>
        <!-- <p class="text-danger wow swing" data-wow-duration="10s" data-wow-iteration="infinite"><?=@$greet?></p> -->
      </div>
      <div class="navbar-inner mt-5">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <?php echo @$menu;?>
          <!-- CHECKING ACOUNT UPDATE -->
          <input type="hidden" name="uuid" id="uuid" value="<?php echo $update;?>">
          <input type="hidden" name="msg" id="msg" value="<?php echo $act_msg;?>">
          <input type="hidden" name="msgid" id="msgid" value="<?php echo $msgid;?>">
          <input type="hidden" name="uid" id="uid" value="<?php echo $uid;?>">
          <input type="hidden" name="appid" id="appid" value="<?php echo $fet;?>">
          <input type="hidden" name="appName" id="appName" value="<?php echo $list;?>">
          <!-- Divider -->
          <hr class="my-3">
        </div><!-- Collapse closed -->
      </div><!-- Navbar Closed -->
    </div>
  </nav>
  