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

<!-- rescheduled train results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title2">Rescheduled Trains</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Alert ID</th>
							<th>Train ID</th>
							<th>New Date</th>
							<th>New Time</th>
							<th>Cause</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="Alert ID">001</td>
							<td data-label="Train ID">0019</td>
							<td data-label="New Date">20-11-2020</td>
							<td data-label="New Time">05.50 AM</td>
							<td data-label="Cause">
								Rescheduled due to a breakdown
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">002</td>
							<td data-label="Train ID">0013</td>
							<td data-label="New Date">20-11-2020</td>
							<td data-label="New Time">07.00 AM</td>
							<td data-label="Cause">
								Rescheduled due to a breakdown
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">003</td>
							<td data-label="Train ID">0081</td>
							<td data-label="New Date">20-11-2020</td>
							<td data-label="New Time">10.00 AM</td>
							<td data-label="Cause">
								Rescheduled due to a breakdown
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">004</td>
							<td data-label="Train ID">0019</td>
							<td data-label="New Date">20-11-2020</td>
							<td data-label="New Time">03.00 PM</td>
							<td data-label="Cause">
								Rescheduled due to a breakdown
							</td>
						</tr>
						<!-- <tr>
							<td>005</td>
							<td>0051</td>
							<td>20-11-2020</td>
							<td>08.00 PM</td>
							<td>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
						</tr> -->
					</tbody>
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/displayAlerts'" type="submit" class="btn blue-btn back-btn">Back</button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of rescheduled train results -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>