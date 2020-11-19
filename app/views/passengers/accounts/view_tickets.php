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

<!-- tickets results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">My Tickets</h1>
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
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" type="submit" class="btn blue-btn back-btn"><span>Back</span></button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of tickets results -->


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