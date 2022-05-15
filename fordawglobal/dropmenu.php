<ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img src="<?=$check[10];?>" class="rounded-circle" id="user_photo">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?=$check[2]." ".$check[3]; ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome <?=$check[1]; ?> !</h6>
                </div>
                <a href="profile?my profile=<?=$rand1;?>" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a>
                <a href="change_password" class="dropdown-item">
                  <i class="ni ni-key-25"></i>
                  <span>Change password</span>
                </a>
                 <!-- <div class="toast-container position-absolute top-0 end-0 p-3"-->
                  <!-- <div class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true" data-delay="7200" style="position:absolute;top:70px;right:21%;z-index: 99;"> -->
                    
                <!--a href="#!" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Settings</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a-->
                <div class="dropdown-divider"></div>
                <a href="logout" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>