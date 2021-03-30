<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- Further Details -->
	<div class="body-section"  id="e-ticket">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket">
			<div class="print-header">
				<img src="<?php echo URLROOT ?>/public/img/logob2.png">
				<p class="title" id="title3">BOOKING CONFIRMATION</p>	
			</div>
			<div class="normal-header">
				<img src="<?php echo URLROOT ?>/public/img/logob2.png">
				<h1 class="title" id="title3">BOOKING CONFIRMATION</h1>
				<div class="summary">
					<center><p>Thank you for booking with us!</p></center>
				</div>
			</div>
			<div class="summary">
				<p><b>Your Ticket ID: <?php echo $data['resNo']; ?></b></p>
				<p><b>Booking Date: <?php echo $data['endTime']; ?></b></p>
			</div>
			<div id="policy" class="summary">
				<p>We recommend that you print this page and bring it with you. You may also view your reservation details online at any time.</p>
				<form action="<?php echo URLROOT; ?>/passengerReservations/viewTicket?resNo=<?php echo $data['resNo']; ?>" method="POST">
					<button class="mail-btn" type="submit" name="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Email</button>
				</form>
				<button onclick="printContent('e-ticket')" class="print-btn"><i class="fa fa-print" aria-hidden="true"></i> Print This Page </button>
			</div>
			<br>
		
			<div class="summary-header">
				<h3>CUSTOMER DETAILS</h3>
			</div>
			<div class=summary>
				<table class="content-table">
					<tbody>
						<tr>
							<td><b>Customer Name:</b></td>
							<td><?php echo $data['account']->firstname; ?> <?php echo $data['account']->lastname; ?></td>
						</tr>
						<tr>
							<td><b>NIC:</b></td>
							<td><?php echo $data['account']->nic; ?></td>
						</tr>
						<tr>
							<td><b>Mobile Number:</b></td>
							<td><?php echo $data['account']->mobileno; ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			
			<div class="summary-header">
				<h3>YOUR JOURNEY</h3>
			</div>
			<div class="summary">
			
				<div class="journey">
					<?php echo $data['reservation']->srcName; ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $data['reservation']->destName; ?>
				</div>
				<div class="journey-row">
					<div class="journey-details">
						<p><?php echo $data['train']->type; ?> Train <b><?php echo $data['train']->name; ?></b></p>
						<p>Train ID: <?php echo $data['train']->trainId; ?></p>
						<p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $data['reservation']->journeyDate; ?></p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data['train']->starttime; ?> -> <?php echo $data['train']->endtime; ?></p>
						<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data['duration']->format('%h hour(s) %i minute(s)'); ?></p>
						<p>Train to <?php echo $data['train']->destName; ?></p>
					</div>
				</div>
			</div>
	
			
			<div class="summary-header">
				<h3>BOOKING AND PAYMENT SUMMARY</h3>
			</div>
			<div class="summary">
				<table class="content-table" id="booking-rev-table">
					<thead>
						<tr>
							<td data-label="Compartment">Comprtment</td>
							<td data-label="SeatNo">Seat Number</td>
							<td data-label="Type">Type</td>
							<td data-label="Price">Price</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['seats'] as $seat):?>
						<tr>
							<td data-label="Compartment"><?php echo $seat->compartmentNo; ?></td>
							<td data-label="SeatNo"><?php echo $seat->seatNo; ?></td>
							<td data-label="Type"><?php echo $seat->classtype; ?> Seat</td>
							<td data-label="Price"><?php echo $seat->price; ?></td>
						</tr>
						<?php endforeach; ?>
						<tr class="grand-total">
							<td>Seat Count</td>
							<td></td>
							<td></td>
							<td><?php echo $data['reservation']->itemCount; ?></td>
						</tr>
						<tr class="grand-total">
							<td>Total</td>
							<td></td>
							<td></td>
							<td><?php echo $data['reservation']->total; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
	
		
			<div id="cancel-policy" class="summary">
				<div class="summary-header">
					<h3>CANCELLATION POLICY</h3>
				</div>
				<p>Deposit is non-refundable and will be charged to your credit card.</p>
				<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
			</div>
			<br>

			<div id="contact" class="summary">
				<div class="journey-row">
					<div class="journey-details">
						<h3>WE'RE HERE TO HELP!</h3>
						<p>Any further queries? Please contact us for assistance</p>
					</div>
					<div class="journey-seats">
						<ul>
							<li><i class="fa fa-phone" aria-hidden="true"></i> +940112-695-722</li>
							<li><i class="fa fa-phone" aria-hidden="true"></i> +940112-696-722</li>
							<li><i class="fa fa-at" aria-hidden="true"></i> raillanka@gmail.com</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="print-contact">
				<p>Please contact us for assistance:  <i class="fa fa-phone" aria-hidden="true"></i> +940112-695-722 / <i class="fa fa-at" aria-hidden="true"></i> raillanka@gmail.com</p>
			</div>
			<br><br>	
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTickets'" class="btn checkout-btn" id="viewalltickets">View All Tickets</button>
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	<!-- js for printing e-ticket -->
	<script>
		function printContent(el){
			var restorepage = document.body.innerHTML;
			var printContent = document.getElementById(el).innerHTML;
			document.body.innerHTML = printContent;
			window.print();
			document.body.innerHTML = restorepage;
		}
	</script>
	<!-- end of js for printing e-ticket -->
	
<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>