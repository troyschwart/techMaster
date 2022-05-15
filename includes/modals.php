<style type="text/css">
	/*.message .fa-check-circle{
		color: #009933;
		padding-left: 2rem;
	}
	.message .msg{
		font-size: 1.4rem;
		position: absolute;
		top: 40%;
		padding-left: 1rem;
	}
	.message p{
		color: #777;
		font-size: 1.6rem;
	}*/
</style>

<!-- MODAL PANEL-->

<!-- WELCOME MESSAGE MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="modal_prints" tabindex="-1" data-backdrop="static" style="margin-top: 10%;">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<span class="modal-title"></span>
									<!--button type="button" class="close" data-dismiss="modal">&times;</button-->
								</div>
								<div class="modal-body text-center">
									<h2>Welcome to fordawglobal forwarding and logistic online management system. <p>You are free to login with your credentials</p></h2>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!--GENERAL  DELETE PAYMENT MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="delete_payment" tabindex="-1" data-backdrop="static" style="margin-top: 10%;">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<p class="modal-title">Deleting data confirmation from record</p>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body" style="margin-top:-2rem;">
									<center><h3>Do you want to delete this ?</h3>
										<form method="POST" action="" id="" name="">
											<button type="submit" class="btn btn-success" name="btn_deletepay" id="btn_deletepay">YES, DELETE</button>
										
											<button type="button" class="btn btn-primary" data-dismiss="modal">CANCEL</button>
											<input type='hidden' value='' id='delID' name="delID">
									</form>
									</center>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!--LOADING SPINNER MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="modal_prints1" tabindex="-1" data-backdrop="static" style="margin-top: 10%;">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<p class="modal-title"><?=$title?></p>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body" style="margin-top:-2rem;">
									<center><h3>Loading page</h3>
										<div class="spinner-grow text-primary" role="status">
										<span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-secondary" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-success" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-danger" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-warning" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
										<div class="spinner-grow text-info" role="status">
										  <span class="sr-only">Loading...</span>
										</div>
									</center>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!-- Message MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="modal_update" tabindex="-1" data-backdrop="static" style="margin-top: 10%;">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<span class="modal-title"></span>
									<!--button type="button" class="close" data-dismiss="modal">&times;</button-->
								</div>
								<div class="modal-body text-center">
									<h1>Welcome to your dashboard</h1><br>
									<p> To hide this box from poping out</p><br>
									<h3>please update your contact info and about me on your profile page</h3>
									<div class="spinner-grow text-danger" role="status">
									  <span class="sr-only">Loading...</span>
									</div>
									<div class="spinner-grow text-info" role="status">
									  <span class="sr-only">Loading...</span>
									</div>
									<div class="spinner-grow text-warning" role="status">
									  <span class="sr-only">Loading...</span>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->


<!-- Message MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="modal_token" tabindex="-1" data-backdrop="static" style="margin-top: 10%;">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-body text-center">
									<h3>Please enter the token sent to your email <span class="fa fa-envelope-open-text text-success"></span></h3>
									<div class="row justify-content-md-center">
										<div class="col-md-6">
											<input type="text" name="token" id="token" class="form-control">
										</div>
										<button type="button" class="btn btn-primary" id="checkToken">Check Token</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->


<!-- ADD / REGISTER USER MODAL PANEL -->
<div class="container">
  <div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="addUser" tabindex="-1" data-backdrop="static" style="">
			<div class="modal-dialog" >
				<div class="modal-content">
					<div class="modal-header">
						<span class="modal-title"><h3 class="text-danger">Create a new user account | Add New User Page</h3></span>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body text-center">
						<?php echo @$div; ?>
							<form role="form" method="POST" id="regForm">
					            <!-- ACCOUNT TYPE -->
					            <div class="form-group mb-3">
					              <select class="form-control" id="account_type" name="account_type">
					                <option value="choose">Choose Account Type</option>
					                <option value="administrator">Administrator</option>
					                <option value="manager">Manager</option>
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
					                <input class="form-control text-capitalize" placeholder="First Name" type="text" id="fName" name="fName" value="<?php if(isset($_GET['ed'])){ echo $row[2];}else{} ?>">
					              </div>
					            </div>
					            <!-- LAST NAME -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative mb-3">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="fa fa-user-tie"></i></span>
					                </div>
					                <input class="form-control text-capitalize" placeholder="Last Name" type="text" id="lName" name="lName" value="<?php if(isset($_GET['ed'])){ echo $row[3];}else{} ?>">
					              </div>
					            </div>
					            <!-- USERNAME -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative mb-3">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="fa fa-user"></i></span>
					                </div>
					                <input class="form-control text-capitalize" placeholder="username" type="text" id="username" name="username" value="<?php if(isset($_GET['ed'])){ echo $row[4];}else{} ?>" maxlength="10">
					              </div>
					            </div>
					            <!-- PHONE NUMBER -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative mb-3">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="fa fa-phone"></i></span>
					                </div>
					                <input class="form-control" placeholder="Phone Number" type="text" id="phone" name="phone" maxlength="11" value="<?php if(isset($_GET['ed'])){ echo $row[5];}else{} ?>">
					              </div>
					            </div>
					            <!-- EMAIL -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative mb-3">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="ni ni-email-83"></i></span>
					                </div>
					                <input class="form-control" placeholder="Email" type="email" id="email" name="email" value="<?php if(isset($_GET['ed'])){ echo $row[6];}else{} ?>">
					              </div>
					            </div>
					            <!-- PASSWORD -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
					                </div>
					                <input class="form-control" placeholder="Password" type="password" name="password" id="password" <?php if(isset($_GET['ed'])){ echo 'disabled';}else{} ?> >
					              </div>
					            </div>
					            <!-- CONFIRM PASSWORD -->
					            <div class="form-group">
					              <div class="input-group input-group-merge input-group-alternative">
					                <div class="input-group-prepend">
					                  <span class="input-group-text"><i class="fa fa-lock"></i></span>
					                </div>
					                <input class="form-control" placeholder="Confirm Password" type="password" name="Cpassword" id="Cpassword" <?php if(isset($_GET['ed'])){ echo 'disabled';}else{} ?> >
					              </div>
					              <p id="message"></p>
					            </div>
					            <!--div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div-->
					            <!-- CHECKBOX -->
					            <div class="row my-4" <?php if(isset($_GET['ed'])){ echo "style='display:none'";}else{} ?>>
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
					              <?php if(isset($_GET['ed'])): ?>
					              	<?=$update_btn; ?>
					              <?php else: ?>
					              	<button type="button" class="btn btn-primary mt-4" id="reg_btn" name="reg_btn">Create account</button>
					              <?php endif; ?>
					              <button type="button" class="btn btn-danger mt-4" data-dismiss="modal">Close</button>
					            </div>
					          </form>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<!--END OF MODAL CLASS -->


<!-- VIEW ONLINE USERS PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="online-users" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-header">
									<span class="modal-title">Online Users</span>&nbsp;<span class="fa fa-user-clock text-success"></span>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body text-center">
									<div class="text-center text-uppercase"><h2>List of Online Users</h2></div>
                  <table class="table table-hover table-striped table-bordered text-black text-center" width="100%" id="example">
                    <thead class="th">
                      <th>s/no</th>
                      <th>Account Type</th>
                      <th>Username</th>
                      <th>Status</th>
                    </thead>
                    <?= @$options1;?>
                  </table>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!-- PRINTING BL'S OPTION MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="modal_bl" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-body">
									<form method="POST" action="" name="form-bl" id="form-bl">
										<div class="row ml-3">
											<h3 class="mt-3">Print All BL's Available &raquo;</h3>&nbsp;&nbsp;
											<button type="button" class="btn btn-primary" name="check_bl_main" id="check_bl_main" onclick="window.location='print_bl?<?=$rand?>&pw=all&<?=$rand1?>'">Print All</button>
										</div>
										<hr>
										<h3>Print By Date &raquo;</h3>
										<div class="row">
											<!-- DATE FROM -->
											<div class="col-xs-3 col-md-4 mb-2">
												<label class="form-control-label">Date From:</label>
											</div>
											<div class="col-xs-9 col-md-8 mb-2">
												<input type="text" name="date_bl_from" id="date_bl_from" class="form-control">
											</div>
											<!-- DATE TO -->
											<div class="col-xs-3 col-md-4">
												<label class="form-control-label">Date To:</label>
											</div>
											<div class="col-xs-9 col-md-8">
												<input type="text" name="date_bl_to" id="date_bl_to" class="form-control">
											</div>
										</div>
										<div class="col-md-12 text-center">
											<button type="submit" class="btn btn-warning mt-2" name="check_bl_date" id="check_bl_date">Print</button>
											<button type="button" class="btn btn-secondary mt-2" data-dismiss="modal">Close</button>
										</div>
								 </form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->


<!-- GETTING BL'S  MODAL PANEL -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="bl_modal" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
									<form method="POST" action="" name="form-invoice" id="form-invoice">
										<h3 id="tid">Fill and submit to Accountant and Chairman (Admin) &raquo;</h3>
										<h3 style="display:none;" id="tiud">Update Transaction Details &raquo;</h3>
										<div class="row">
											<!-- BL NO. -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">BL Number:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="bl_bill" id="bl_bill" class="form-control text-uppercase" value="">
											</div>
											<!-- CONTAINER NO -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Container Number:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="conID" id="conID" class="form-control text-uppercase">
											</div>
											<!-- CONTAINER DEPOSIT / WAIVER-->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Container Waiver:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="conDep" id="conDep" class="form-control text-uppercase">
											</div>
											<!-- INVOICE NUMBER -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Invoice Number:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="bl_import" id="bl_import" class="form-control text-uppercase">
											</div>
											<!-- AMOUNT PAID -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Amount Paid:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="bl_amount" id="bl_amount" class="form-control">
											</div>
											<!-- DETENTION INVOICE -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Detention Invoice:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="bl_dent" id="bl_dent" class="form-control text-uppercase">
											</div>
											<!-- DENTENTION AMOUNT -->
											<div class="col-xs-3 col-md-5 mb-2">
												<label class="form-control-label">Dentention Amount:</label>
											</div>
											<div class="col-xs-9 col-md-7 mb-2">
												<input type="text" name="bl_amt" id="bl_amt" class="form-control">
											</div>
										</div>
										<div class="modal-footer">
					             <button type='submit' id='btn_update_bl' name='btn_update_bl' class='btn btn-danger mt-2' style="display:none;"><input type='hidden' id='uid' name="uid">Update BL</button>
											<button type="submit" class="btn btn-success mt-2" name="rl_btn" id="rl_btn">Send <span class="fa fa-paper-plane"></span></button>
											<button type="button" class="btn btn-secondary mt-2" data-dismiss="modal">Close</button>
										</div>
								 </form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->


<!-- SEARCH JOBS MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="search_jobs" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-body">
									<form method="POST" action="" name="form-jobs" id="form-jobs">
										<h2 class="text-center text-danger">Search Jobs Form</h2>
											<!-- SEARCH JOBS FORM -->
											<div class="col-12 mb-2 ml--3">
												<label class="form-control-label">Enter the BL Number to search</label>
											</div>
										<div class="form-row">
											<input type="text" name="search-txt" id="search-txt" class="form-control col-4 col-6" placeholder="Enter BL Number">
											<button type="button" class="btn btn-primary ml-1" name="jobs_btn" id="jobs_btn">Search Jobs</button>
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<!-- <p>This <a href="#" role="button" class="btn btn-secondary popover-test"  title="Popover title" data-content="Popover body content">Check Tooltips</a> shows popover on click</p>
											<p><a href="#" class="tooltip-test" title="Tooltip">Check Tooltips</a></p> -->
										</div>
								 </form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!-- VIEW SEARCH JOBS PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="show-jobs" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<span class="modal-title">List of the job you search for</span>&nbsp;<span class="fa fa-user-clock text-success"></span>
									<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
								</div>
								<div class="modal-body text-center">
									<div class="text-center text-uppercase"><h2></h2></div>
                  <p id="job_msg"></p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!-- QUERY STAFF MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="query_staff" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-body">
									<form method="POST" action="" name="query-form" id="query-form">
										<p id="success_mo"></p>
										<h2 class="text-center text-danger">Query Staff Form</h2>
											<!-- ACCOUNT TYPE -->
					            <div class="form-group mb-3">
					            	<label class="form-control-label">Account Type</label>
					              <select class="form-control" id="account_query" name="account_query">
					                <option value="choose">Choose Account Type</option>
					                <option value="administrator">Administrator</option>
					                <option value="manager">Manager</option>
					                <option value="secretary">Secretary</option>
					                <option value="accountant">Accountant</option>
					                <option value="shipping manager">Shipping Manager</option>
					                <option value="releasing officer">Releasing Officer</option>
					                <option value="transport manager">Transport Manager</option>
					              </select>
					            </div>

					             <div class="form-group mb-3" style="display:none;" id="staff_n">
					            	<label class="form-control-label">Staff Name</label>
					              <select class="form-control" id="account_name" name="account_name">
					                 <option value="">Choose Name</option>
					              </select>
					            </div>

											<div class="form-group">
												<label class="form-control-label">Query Message</label>
												<textarea class="form-control" placeholder="Type Query" cols="10" rows="5" style="resize:none;" id="query_mes" name="query_mes"></textarea>
											</div>
											<button type="button" class="btn btn-danger ml-2" name="query_btn" id="query_btn">Submit Query</button>
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								 </form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->

<!-- APPROVAL MODAL PANEL -->
	<div class="container message">
		<div class="row">
			<div class="col-md-12">
					<div class="modal fade" id="approve" tabindex="-1" data-backdrop="static">
						<div class="modal-dialog" >
							<div class="modal-content">
								<div class="modal-body">
									<form method="POST" action="" name="appro-form" id="appro-form">
										<p id="success_mo"></p>
										<h2 class="text-center text-danger">Send Approval Form</h2>
											<!-- ACCOUNT TYPE -->
					            <div class="form-group mb-3">
					            	<label class="form-control-label">Account Type</label>
					              <select class="form-control" id="account_approval" name="account_approval">
					                <option value="">Choose Account Type</option>
					                <option value="administrator">Administrator</option>
					                <option value="manager">Manager</option>
					              </select>
					            </div>

											<div class="form-group">
												<label class="form-control-label">Query Message</label>
												<textarea class="form-control" placeholder="Type Message" cols="10" rows="5" style="resize:none;" id="appro_msg" name="appro_msg"></textarea>
											</div>
											<button type="button" class="btn btn-success ml-2" name="appro_btn" id="appro_btn">Submit Approval</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								 </form>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
<!--END OF MODAL CLASS -->