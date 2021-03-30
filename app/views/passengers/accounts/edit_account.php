<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- Account Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="profile-container">
			<h1 class="title">Edit Profile</h1>

			<div class="tabstop">
				<div class="tabs__sidebartop">
					<button class="tabs__buttontop" data-for-tab="1"> <span>Edit Profile</span> <i class="fa fa-edit" aria-hidden="true"></i> </button>
					<button class="tabs__buttontop" data-for-tab="2"> <span>Reset Password</span> <i class="fa fa-key" aria-hidden="true"></i></button>
					<button class="tabs__buttontop" data-for-tab="3"> <span>Delete Account</span> <i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</div>

				<div class="tabs__contenttop" data-tab="1">
					<div class="acc-wrapper">
					    <div class="acc-title">
					      UPDATE ACCOUNT
					    </div>
					    <?php foreach ($data['passenger'] as $row)?>
					    <form action="<?php echo URLROOT;?>/passengerAccounts/editAccount/<?php echo $row->userid;?>" method="POST">
						    <div class="acc-form">

						    	<div class="acc-inputfield-flex">
						          	<label>NIC</label>
						          	<input type="text" name="nic" placeholder="-" class="acc-input" value="<?php echo $row->nic;?>" >
						          	<span class="invalidFeedback">
			                            <?php echo $data['nicError'];?>
			                        </span>
						      	</div> 

						      	<div class="acc-inputfield-flex">
						          	<label>First Name</label>
						          	<input type="text" name="firstName" placeholder="-" class="acc-input" value="<?php echo $row->firstname;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['firstNameError'];?>
			                        </span>
						      	</div> 

						      	<div class="acc-inputfield-flex">
						          	<label>Last Name</label>
						          	<input type="text" name="lastName" placeholder="-" class="acc-input" value="<?php echo $row->lastname;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['lastNameError'];?>
			                        </span>
						      	</div>  

						      	<div class="acc-inputfield-flex">
						          	<label>Phone Number</label>
						          	<input type="text" name="mobileNo" placeholder="-" class="acc-input" value="<?php echo $row->mobileno;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['mobileNoError'];?>
			                        </span>
						      	</div> 

						      	<div class="acc-inputfield-flex">
						          	<label>Address Number</label>
						          	<input type="text" name="addressNo" placeholder="-" class="acc-input" value="<?php echo $row->address_number;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['addressNoError'];?>
			                        </span>
						      	</div> 

						      	<div class="acc-inputfield-flex">
						          	<label>Street</label>
						          	<input type="text" name="street" placeholder="-" class="acc-input" value="<?php echo $row->street;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['streetError'];?>
			                        </span>
						      	</div> 
						      	<div class="acc-inputfield-flex">
						          	<label>City</label>
						          	<input type="text" name="city" placeholder="-" class="acc-input" value="<?php echo $row->city;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['cityError'];?>
			                        </span>
						      	</div> 
						      	<div class="acc-inputfield-flex">
						          	<label>Country</label>
						          	<input type="text" name="country" placeholder="-" class="acc-input" value="<?php echo $row->country;?>">
						          	<span class="invalidFeedback">
			                            <?php echo $data['countryError'];?>
			                        </span>
						      	</div> 
						    	<div class="acc-inputfield-flex">
						        	<input type="submit" name="editAccount" class="acc-btn">
						      	</div>
						    </div>
						</form>
					</div>
				</div>

				<div class="tabs__contenttop" data-tab="2">
					<div class="acc-wrapper">
					    <div class="acc-title">
					    	RESET PASSWORD
					    </div>
					    <form action="<?php echo URLROOT;?>/passengerAccounts/editAccount/<?php echo $_SESSION['userid'];?>" method="POST">
						    <div class="acc-form">

						    	<div class="acc-inputfield-flex">
						          	<label>Current Password</label>
						          	<input type="password" name="password" class="acc-input">
						          	<span class="invalidFeedback">
			                            <?php echo $data['passwordError'];?>
			                        </span>
						       	</div>  

						       	<div class="acc-inputfield-flex">
						          	<label>New Password</label>
						          	<input type="password" name="newPassword" class="acc-input">
						          	<span class="invalidFeedback">
			                            <?php echo $data['newPasswordError'];?>
			                        </span>
						       	</div>  

						      	<div class="acc-inputfield-flex">
						          	<label>Confirm New Password</label>
						          	<input type="password" name="confirmPassword" class="acc-input">
						          	<span class="invalidFeedback">
			                            <?php echo $data['confirmPasswordError'];?>
			                        </span>
						       	</div> 
					
						    	<div class="acc-inputfield-flex">
						        	<input type="submit" name="editPassword" class="acc-btn">
						      	</div>
						    </div>
						</form>
					</div>
				</div>

				<div class="tabs__contenttop" data-tab="3">
					<div class="acc-wrapper">
					    <div class="acc-title">
					    	DELETE YOUR ACCOUNT?
					    </div>
					    <div class="acc-form">
					    	<center><p>We're sorry to hear you'd like to delete your account.</p>
					    	<br> 
					    	<p>Keep in mind that you will not be able to reactivate your account or retrieve any of the content or information you have added. Any subscriptions will also be removed.</p>
					    	<p><b>You cannot delete your account if you have upcoming reservations</b></p>
					    	<br>
					    	<div class="acc-inputfield-flex">
					        	<input type="submit" name="deleteAccount" class="acc-btn del-acc">
					      	</div>
					    </div>
					</div>
				</div>

			</div>

			<center><button type="submit" data-target="alert-warning-popup" class="btn blue-btn alert-btn back-btn"><i class="fa fa-long-arrow-left"></i > Back</button></center>
		</div>

		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>

	<!-- delete account pop up -->
	<div class="popup-box">
		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		<h1>Delete Your Account?</h1>
		<label>Are you sure you want to proceed?</label>
		<div class="btns">
			<a href="#" class="btn1">Cancel</a>
			<a href="#" class="btn2">Delete Account</a>
		</div>
	</div>
	<!-- end of delete account pop up -->

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>You will lose any unsaved changes.</p>
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" class="proceed-btn">Proceed Anyway</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

	<!-- js for tabs -->
	<script>
		function setupTabs() {
			document.querySelectorAll(".tabs__buttontop").forEach(button => {
				button.addEventListener("click", () => {
					const sideBar = button.parentElement;
					const tabsContainer = sideBar.parentElement;
					const tabNumber = button.dataset.forTab;
					const tabToActivate = tabsContainer.querySelector(`.tabs__contenttop[data-tab="${tabNumber}"]`);

					sideBar.querySelectorAll(".tabs__buttontop").forEach(button => {
						button.classList.remove("tabs__buttontop--active");
					});

					tabsContainer.querySelectorAll(".tabs__contenttop").forEach(button => {
						button.classList.remove("tabs__contenttop--active");
					});

					button.classList.add("tabs__buttontop--active");
					tabToActivate.classList.add("tabs__contenttop--active");
				});
			});
		}

		document.addEventListener("DOMContentLoaded", () => {
			setupTabs();

			document.querySelectorAll(".tabstop").forEach(tabsContainer => {tabsContainer.querySelector(".tabs__sidebartop .tabs__buttontop").click();
			});
		});

	</script>
	<!-- end of js for tabs -->


	<!-- js for pop up alert  -->
	<script>
		$(document).ready(function(){
			$('.del-acc').click(function(){
				$('.popup-box').css({
					"opacity":"1",
					"pointer-events":"auto"
				});
			});
			$('.btn1').click(function(){
				$('.popup-box').css({
					"opacity":"0",
					"pointer-events":"none"
				});
			});
			$('.btn2').click(function(){
				$('.popup-box').css({
					"opacity":"0",
					"pointer-events":"none"
				});
				window.location.href="<?php echo URLROOT;?>/passengerAccounts/deleteAccount ?>";

			});
		});
	</script>
	<!-- end of js for pop up alert  -->

	<!-- js for flash message -->
	<script>
		const alertBtn = document.querySelectorAll(".alert-btn");
		alertBtn.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const alertBox = document.getElementById(target)
				alertBox.classList.add("alert-box-show");

				const closeAlert = alertBox.querySelector(".close-alert");
				closeAlert.addEventListener("click",function(){
					alertBox.classList.remove("alert-box-show");
				});

				alertBox.addEventListener("click",function(event){
					if(event.target === this){
						alertBox.classList.remove("alert-box-show");
					}
				});
			});
		});

	</script>
	<!-- end of js for flash message -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>