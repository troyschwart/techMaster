<?php include 'menu_nav.php'; ?>

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'nav.php'; ?>
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h2 class="display-2 text-white">Hello <?=$check[4];echo " ($check[1])"; ?></h2>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="../assets/img/brand/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?=$check[10];?>" class="rounded-circle" id="user_photo">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <!--a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a-->
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center">
                    <!--div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div-->
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="h3">
                  <?=$check[2]." ".$check[3]; ?><span class="font-weight-light">, <?=$check[5]; ?></span>
                </h5>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i><?=$check[6]; ?>
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?=$check[1]; ?> - Ford A.W Glogal Concept Ltd
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>Head Office: 63 Ibrahim Taiwo Road, Kano
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="success_msg"></div><?=@$div?>
              <form id="pro_update" name="pro_update" enctype="multipart/form-data" onsubmit="return false">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <input type="hidden" id="userID" name="userID" class="form-control" placeholder="ID" value="<?=$check[0];?>">
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_first">First name</label>
                        <input type="text" id="input_first" name="input_first" class="form-control text-capitalize" placeholder="First name" value="<?=$check[2];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_last">Last name</label>
                        <input type="text" id="input_last" name="input_last" class="form-control text-capitalize" placeholder="Last name" value="<?=$check[3];?>">
                      </div>
                    </div>
                  </div><!-- END ROW 1 -->
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_username">Username</label>
                        <input type="text" id="input_username" name="input_username" class="form-control text-capitalize" placeholder="Username" value="<?=$check[4];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_phone">Phone Number</label>
                        <input type="text" id="input_phone" name="input_phone" class="form-control" placeholder="Last name" value="<?=$check[5];?>">
                      </div>
                    </div>
                  </div><!-- END ROW 2-->
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input_address">Address</label>
                        <input id="input_address" name="input_address" class="form-control" placeholder="Home Address" value="<?=$checkDetails[2];?>" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_city">City</label>
                        <input type="text" id="input_city" name="input_city" class="form-control text-capitalize" placeholder="City" value="<?=$checkDetails[3];?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input_country">Country</label>
                        <input type="text" id="input_country" name="input_country" class="form-control text-capitalize" placeholder="Country" value="<?=$checkDetails[4];?>">
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="input_file">Upload Image</label>
                        <input type="file" id="input_file" name="input_file" class="form-control"  onchange="document.getElementById('user_photo').src=window.URL.createObjectURL(this.files[0]);document.getElementById('user_photo1').src=window.URL.createObjectURL(this.files[0])">
                        <p class="help-block" style="font-size:0.9rem;color:#ccc;">file should be in the format: jpg, jpeg or png</p>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Description -->
                <h6 class="heading-small text-muted mb-4">About me</h6>
                <div class="pl-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">About Me</label>
                    <textarea rows="4" id="about_me" name="about_me" class="form-control" placeholder="A few words about you ..."><?=$checkDetails[5];?></textarea>
                  </div>
                </div>
                <div class="col-12 text-right">
                  <button type="button" id="btn_profile" name="btn_profile" class="btn btn-success">update profile</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
<?php include 'footer2.php'; ?>