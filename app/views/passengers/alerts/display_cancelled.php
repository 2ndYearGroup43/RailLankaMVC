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
							<th>Entered Date</th>
							<th>Entered Time</th>
							<th>Cancellation Cause</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($data['alerts'] as $row):?>
						<tr>
							<td data-label="Alert ID"><?php echo $row->alertId ?></td>
							<td data-label="Train ID"><?php echo $row->trainId ?></td>
							<td data-label="Entered Date"><?php echo $row->date ?></td>
							<td data-label="Entered Time"><?php echo $row->time ?></td>
							<td data-label="Cause"><?php echo 
								$row->cancellation_cause ?>
							</td>
						</tr>
					<?php endforeach;?>
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