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

<!-- cancelled train results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title2">Cancelled Trains</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>Date</th>
							<th>Cancellation Cause</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-label="Alert ID">001</td>
							<td data-label="Train ID">0019</td>
							<td data-label="Date">26/11/202</td>
							<td data-label="Cause">
								Cancelled due to COVID_19
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">002</td>
							<td data-label="Train ID">0013</td>
							<td data-label="Date">24/11/202</td>
							<td data-label="Cause">
								Cancelled due to COVID_19
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">003</td>
							<td data-label="Train ID">0081</td>
							<td data-label="Date">20/11/202</td>
							<td data-label="Cause">
								Cancelled due to COVID_19
							</td>
						</tr>
						<tr>
							<td data-label="Alert ID">004</td>
							<td data-label="Train ID">0019</td>
							<td data-label="Date">13/11/202</td>
							<td data-label="Cause">
								Cancelled due to COVID_19
							</td>
						</tr>
						<!-- <tr>
							<td>005</td>
							<td>0051</td>
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
	<!-- end of cancelled train results -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>