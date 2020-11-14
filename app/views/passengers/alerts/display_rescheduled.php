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

<!-- rescheduled train results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Rescheduled Trains</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>New Date</th>
							<th>New Time</th>
							<th>Reschedulement Cause</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td>001</td>
							<td>0019</td>
							<td>20-11-2020</td>
							<td>xxxx</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr>
						<tr>
							<td>002</td>
							<td>0013</td>
							<td>20-11-2020</td>
							<td>xxxx</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr>
						<tr>
							<td>003</td>
							<td>0081</td>
							<td>20-11-2020</td>
							<td>xxxx</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr>
						<tr>
							<td>004</td>
							<td>0019</td>
							<td>20-11-2020</td>
							<td>xxxx</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr>
						<tr>
							<td>005</td>
							<td>0051</td>
							<td>20-11-2020</td>
							<td>Cancelled</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr>
					</tbody>
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/displayAlerts'" type="submit" class="btn red-btn back-btn">Back</button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of rescheduled train results -->

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

<?php require APPROOT . '/views/includes/footer.php'; ?>