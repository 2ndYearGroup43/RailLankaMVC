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

<!-- <?php var_dump($_SESSION); ?>  -->


<!-- Account Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">My Account</h1>
				<div class="row">
					<div class="btn-group">
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/editAccount'" type="submit" class="blue-btn"><span>Edit Account <i class="fa fa-edit"></i></span></button>
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTickets'" type="submit" class="blue-btn"><span>My Tickets <i class="fa fa-credit-card" aria-hidden="true"></i></span></button>
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displaySubscriptions'" type="submit" class="blue-btn"><span>Subscriptions <i class="fa fa-bell-o" aria-hidden="true"></i></span></button>
					</div>
				</div>

				<table class="details-content-table">
					<tbody>	
						<tr>
							<th>Customer Name:</th>
							<td>John Doe</td>
						</tr>
						<tr>
							<th>NIC:</th>
							<td>976709531V</td>
						</tr>
						<tr>
							<th>Address Number:</th>
							<td>40</td>
						</tr>
						<tr>
							<th>Street:</th>
							<td>Park Street</td>
						</tr>
						<tr>
							<th>City/Town:</th>
							<td>Colombo 7</td>
						</tr>
						<tr>
							<th>Country:</th>
							<td>Sri Lanka</td>
						</tr>
						<tr>
							<th>Phone:</th>
							<td>+94 777 875634</td>
						</tr>
						<tr>
							<th>Email:</th>
							<td>user1@gmail.com</td>
						</tr>
					</tbody>		
				</table>
		</div>
		<div class="content-row">
		</div>
	
	<div class="content-row">
	</div>
	<div class="content-row">
	</div>
	</div>
	<!-- end of account details -->


	 <!--  js for toggle menu -->
	<script>
		var menuItems = document.getElementById("menuItems");
		menuItems.style.maxHeight = "0px"
		function menutoggle(){
			if(menuItems.style.maxHeight == "0px"){
				menuItems.style.maxHeight = "360px";
			}
			else{
				menuItems.style.maxHeight = "0px";
			}
		}
	</script>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>