<?php
include 'header.php'; 

?>
  <!-- Main content -->
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-white">Create an account</h1>
              <p class="text-lead text-white">Fill all fields to create a new account</p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <!-- Table -->
      <!--?php $div; ?-->
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
          <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <div id="success_msg"></div>
                <h5>Enter your credentials in the available fields</h5>
              </div>
              <form role="form" method="POST" id="regForm">
                <!-- ACCOUNT TYPE -->
                <div class="form-group mb-3">
                  <select class="form-control" id="account_type" name="account_type">
                    <option value="choose">Choose Account Type</option>
                    <!--option value="administrator">Administrator</option-->
                    <option value="secretary">Secretary</option>
                    <option value="accountant">Accountant</option>
                    <option value="shipping manager">Shipping Manager</option>
                    <option value="releasing officer">Releasing Officer</option>
                    <option value="transport manager">Transport Manager</option>
                  </select>
                </div>
                <!-- FIRST NAME -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                    </div>
                    <input class="form-control" placeholder="First Name" type="text" id="fName" name="fName">
                  </div>
                </div>
                <!-- LAST NAME -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user-tie"></i></span>
                    </div>
                    <input class="form-control" placeholder="Last Name" type="text" id="lName" name="lName">
                  </div>
                </div>
                <!-- USERNAME -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="username" type="text" id="username" name="username">
                  </div>
                </div>
                <!-- PHONE NUMBER -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-phone"></i></span>
                    </div>
                    <input class="form-control" placeholder="Phone Number" type="text" id="phone" name="phone" maxlength="11">
                  </div>
                </div>
                <!-- EMAIL -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email" id="email" name="email">
                  </div>
                </div>
                <!-- PASSWORD -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password" name="password" id="password">
                  </div>
                </div>
                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    <input class="form-control" placeholder="Confirm Password" type="password" name="Cpassword" id="Cpassword">
                  </div>
                  <p id="message"></p>
                </div>
                <!--div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div-->
                <!-- CHECKBOX -->
                <div class="row my-4">
                  <div class="col-12">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckRegister" name="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">
                        <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-primary mt-4" id="reg_btn" name="reg_btn">Create account</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
<?php include 'footer.php'; ?>