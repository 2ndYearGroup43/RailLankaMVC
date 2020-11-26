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
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Deptarture Time">7.00 a.m.</td>
							<td data-label="Arrival Time">9.38 a.m.</td>
							<td data-label="Type">A.C.- Intercity</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTicket1'" type="submit" class="btn"><span>View Ticket</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Deptarture Time">7.05 a.m.</td>
							<td data-label="Arrival Time">9.38 a.m.</td>
							<td data-label="Type">Intercity</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTicket1'" type="submit" class="btn"><span>View Ticket</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Deptarture Time">8.30 a.m.</td>
							<td data-label="Arrival Time">11.03 a.m.</td>
							<td data-label="Type">Express - Udarata Menike</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTicket1'" type="submit" class="btn"><span>View Ticket</span></button>
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


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>