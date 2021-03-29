<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<?php var_dump($_SESSION); ?> 


<!-- Account Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div>
				<h1 class="title" style="text-align: left">Hi! User Name </h1>
			</div>
			<div class="tabstop">
				<div class="tabs__sidebartop">
					<button class="tabs__buttontop" data-for-tab="1"> <span>Profile</span> <i class="fa fa-user-circle" aria-hidden="true"></i> </button>
					<button class="tabs__buttontop" data-for-tab="2"> <span>E-Tickets</span> <i class="fa fa-credit-card" aria-hidden="true"></i></button>
					<button class="tabs__buttontop" data-for-tab="3"> <span>Subscriptions</span> <i class="fa fa-bell-o" aria-hidden="true"></i></button>
				</div>

				<div class="tabs__contenttop" data-tab="1">
					<h2>My Account Details</h2>
					<br>
					<table class="details-content-table">
						<tbody>	
							<tr>
								<th>NIC:</th>	
								<td>986811524V</td>
							</tr>
							<tr>
								<th>Name:</th>	
								<td>John Doe</td>
							</tr>
							<tr>
								<th>Mobile No.</th>	
								<td>+94 777 6899567</td>
							</tr>
							<tr>
								<th>Email:</th>	
								<td>john@gmail.com</td>
							</tr>
							<tr>
								<th>Address:</th>	
								<td>No 23, Park Road, Colombo 7</td>
							</tr>
							<tr>
								<th>City:</th>	
								<td>Colombo</td>
							</tr>
							<tr>
								<th>Country:</th>	
								<td>Sri Lanka</td>
							</tr>
						</tbody>		
					</table>
					<br>
					<div class="row">
					<div class="btn-group">
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/editAccount'" type="submit" class="blue-btn"><span>Edit Account <i class="fa fa-edit"></i></span></button>
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/resetPass'" type="submit" class="blue-btn">Reset Password</button>
						<button type="submit" class="blue-btn del-acc">Delete Account</button>
					</div>
				</div>

				</div>

				<div class="tabs__contenttop" data-tab="2">
					<h2>My Tickets</h2>
					<table class="content-table">
						<thead>
							<tr>
								<th>From</th>
								<th>To</th>
								<th>Departure Time</th>
								<th>Arrival Time</th>
								<th>Type</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr class="active-row">
								<td>Colombo Fort</td>
								<td>Kandy</td>
								<td>7.00 a.m.</td>
								<td>9.38 a.m.</td>
								<td>A.C.- Intercity</td>
								<td>
									<button type="submit" class="btn"><span>View Ticket</span></button>
								</td>
							</tr>
							<tr>
								<td>Colombo Fort</td>
								<td>Kandy</td>
								<td>7.05 a.m.</td>
								<td>9.38 a.m.</td>
								<td>Intercity</td>
								<td>
									<button type="submit" class="btn">View Ticket</button>
								</td>
							</tr>
							<tr>
								<td>Colombo Fort</td>
								<td>Kandy</td>
								<td>8.30 a.m.</td>
								<td>11.03 a.m.</td>
								<td>Express - Udarata Menike</td>
								<td>
									<button type="submit" class="btn">View Ticket</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="tabs__contenttop" data-tab="3">
					<h2>My Subscriptions</h2>
					<table class="content-table">
					<thead>
						<tr>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td>Colombo Fort</td>
							<td>Kandy</td>
							<td>7.00 a.m.</td>
							<td>9.38 a.m.</td>
							<td>A.C.- Intercity</td>
							<td>
								<button type="submit" class="btn"><span>Unsubscribe</span></button>
							</td>
						</tr>
						<tr>
							<td>Colombo Fort</td>
							<td>Kandy</td>
							<td>7.05 a.m.</td>
							<td>9.38 a.m.</td>
							<td>Intercity</td>
							<td>
								<button type="submit" class="btn">Unsubscribe</button>
							</td>
						</tr>
						<tr>
							<td>Colombo Fort</td>
							<td>Kandy</td>
							<td>8.30 a.m.</td>
							<td>11.03 a.m.</td>
							<td>Express - Udarata Menike</td>
							<td>
								<button type="submit" class="btn">unsubscribe</button>
							</td>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div>

		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>

	<div class="popup-box">
		<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
		<h1>Delete Your Account?</h1>
		<p>We're sorry to hear you'd like to delete your account.<br> Keep in mind that you will not be able to reactivate your account or retrieve any of the content or information you have added.</p>
		<label>Are you sure you wanna proceed?</label>
		<div class="btns">
			<a href="#" class="btn1">Cancel</a>
			<a href="#" class="btn2">Delete My Account</a>
		</div>
	</div>

	<!-- js for tabs -->
	<script>
		function setupTabs() {
			document.querySelectorAll(".tabs__buttontop").forEach(button => {
				button.addEventListener("click", () => {
					const sideBar = button.parentElement;
					const tabsContainer = sideBar.parentElement;
					const tabNumber = button.dataset.forTab;
					const tabToActivate = tabsContainer.querySelector(`.tabs__contenttop[data-tab="${tabNumber}"]`);

					// console.log(sideBar);
					// console.log(tabsContainer);
					// console.log(tabNumber);
					// console.log(tabToActivate);

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
					// "left":"event.pageX"
					// "top":"event.pageY"
				});
			});
			$('.btn2').click(function(){
				$('.popup-box').css({
					"opacity":"0",
					"pointer-events":"none"
				});
				window.location.href='<?php echo URLROOT; ?>/pages/index';

			});
		});
	</script>
	<!-- end of js for pop up alert  -->

<?php require APPROOT . '/views/includes/footer.php'; ?>