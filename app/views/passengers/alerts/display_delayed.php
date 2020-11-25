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

<!-- delayed train results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Delayed Trains</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>Delay Time/th>
							<th>Delay Cause</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td>001</td>
							<td>0019</td>
							<td>09.00 AM</td>
							<td>
								Delayed due to breakdown
							</td>
						</tr>
						<tr>
							<td>002</td>
							<td>0013</td>
							<td>09.30 AM</td>
							<td>
								Delayed due to breakdown
							</td>
						</tr>
						<tr>
							<td>003</td>
							<td>0081</td>
							<td>11.00 AM</td>
							<td>
								Delayed due to breakdown
							</td>
						</tr>
						<tr>
							<td>004</td>
							<td>1001</td>
							<td>11.10 AM</td>
							<td>
								Delayed due to breakdown
							</td>
						</tr>
						<tr>
							<td>005</td>
							<td>0051</td>
							<td>04.20 PM</td>
							<td>
								Delayed due to breakdown
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
	<!-- end of delayed train results -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>