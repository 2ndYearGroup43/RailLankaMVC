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
			<h1 class="title2 rescheduled-title">Rescheduled Trains</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Alert ID</th>
							<th>Train ID</th>
							<th>Name</th>
							<th>Old Date</th>
							<th>New Date</th>
							<th>New Time</th>
							<th>Entered Date</th>
							<th>Entered Time</th>
							<th>Cause</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['alerts'] as $row):?>
						<tr class="active-row">
							<td data-label="Alert ID"><?php echo $row->alertId?></td>
							<td data-label="Train ID"><?php echo $row->trainId?></td>
							<td data-label="Name"><?php echo $row->name?></td>
							<td data-label="Old Date"><?php echo $row->olddate?></td>
							<td data-label="New Date"><?php echo $row->newdate?></td>
							<td data-label="New Time"><?php echo $row->newtime?></td>
							<td data-label="Entered Date"><?php echo $row->date?></td>
							<td data-label="Entered Time"><?php echo $row->time?></td>
							<td data-label="Cause"><?php echo $row->reschedulement_cause?></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/searchAlertsBy'" type="submit" class="btn blue-btn back-btn">Back</button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of rescheduled train results -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>