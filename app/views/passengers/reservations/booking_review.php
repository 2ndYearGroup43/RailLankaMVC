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

<!-- Further Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket">
			<h1 class="title">BOOKING SUMMARY</h1>
			<div class="summary">
				We will email you a confirmation of this booking. <br> You may also view your reservation details online at any time.
			</div>
			<br>
			<!-- <p>Thank you for booking with us!</p>
			<p>You will receive an email confirmation soon.</p>
			<br> -->
			<br>
			
			<div class="summary-header">
				<h3>CUSTOMER DETAILS</h3>
			</div>
			<div class=summary>
				<table class="content-table">
					<tbody>
						<tr>
							<td><b>Customer Name:</b></td>
							<td>Bilbo Baggins</td>
						</tr>
						<tr>
							<td><b>Address:</b></td>
							<td>No 40, Park Street, Colombo 7</td>
						</tr>
						<tr>
							<td><b>City/Town:</b></td>
							<td>xxxxxx</td>
						</tr>
						<tr>
							<td><b>Country:</b></td>
							<td>xxxxxx</td>
						</tr>
						<tr>
							<td><b>Phone:</b></td>
							<td>+94 777 875634</td>
						</tr>
						<tr>
							<td><b>Email:</b></td>
							<td>bilbo@gmail.com</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			
			<div class="summary-header">
				<h3>YOUR JOURNEY</h3>
			</div>
			<div class=summary>
				<div class="journey">
					Colombo Fort <i class="fa fa-long-arrow-right" aria-hidden="true"></i> Kandy
				</div>
				<p>Express Train <b>Udarata Menike</b></p>
				<p><i class="fa fa-calendar-o" aria-hidden="true"></i> 20th June 2020</p>
				<p><i class="fa fa-clock-o" aria-hidden="true"></i> 2 hrs 33 mins</p>
				<p>Train to Badulla</p>
				<br>
				<p>Seat Numbers:
					<ul>
						<li>Compartment 1 :  21 , 22</li>
						<li>Compartment 2 :  33 , 34</li>
					</ul> 
				</p>
			<br>
			
			<div class="summary-header">
				<h3>BOOKING AND PAYMENT SUMMARY</h3>
			</div>
			<div class="summary">
				<table class="content-table">
					<thead>
						<tr>
							<td>Type</td>
							<td>Price</td>
							<td>Quantity</td>
							<td>Total</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>First Class</td>
							<td>Rs. 400.00</td>
							<td>3</td>
							<td>Rs. 1200.00</td>
						</tr>
						<tr>
							<td>Second Class</td>
							<td>Rs. 230.00</td>
							<td>1</td>
							<td>Rs. 230.00</td>
						</tr>
						<tr>
							<td>First Class</td>
							<td>Rs. 125.00</td>
							<td>2</td>
							<td>Rs. 250.00</td>
						</tr>
						<tr class="grand-total">
							<td>Total</td>
							<td></td>
							<td></td>
							<td>Rs. 1680.00</td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			
			<div id="cancel-policy" class="summary">
				<div class="summary-header">
					<h3>CANCELLATION POLICY</h3>
				</div>
				<p>Deposit is non-refundable and will be charged to your credit card.</p>
				<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
			</div>

			<br>
			<br>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/bookingReview'" class="btn checkout-btn">Checkout &raquo;</button>
			<p class="options">Back to seat map? <a href="<?php echo URLROOT; ?>/passengerReservations/displaySeatmaps">Click here.</a></p>

			<!-- <img src="https://www.freepnglogos.com/uploads/visa-and-mastercard-logo-26.png" width="200" alt="visa and mastercard logo" /></a> -->
		</div>
		<div class="content-row">
			<!-- <button type="submit" class="back-btn"><span>Back</span></button> -->
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	
<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>