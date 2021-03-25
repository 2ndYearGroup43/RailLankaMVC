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
<!-- <?php var_dump($data); ?> -->
<!-- tickets results -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<!-- <div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div> -->
			<h1 class="title">My Tickets</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Reservation No</th>
							<th>Date</th>
							<th>Train Id</th>
							<th>From</th>
							<th>To</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data as $row):?>
							<tr class="active-row">
								<td data-label="Reservation No"><?php echo $row->reservationNo; ?></td>
								<td data-label="Date"><?php echo $row->journeyDate; ?></td>
								<td data-label="Train Id"><?php echo $row->trainId; ?></td>
								<td data-label="From"><?php echo $row->srcName; ?></td>
								<td data-label="To"><?php echo $row->destName; ?></td>
								<td>
									<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/viewTicket?resNo=<?php echo $row->reservationNo;?>'" type="submit" class="btn"><span>View Ticket</span></button>
								</td>
							</tr>
						<?php endforeach; ?>
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


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>