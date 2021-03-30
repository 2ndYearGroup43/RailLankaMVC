<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- Further Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket" id="review">
			<div>
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">BOOKING REVIEW</h1>
			<div class="timer" id="countdown">
				<div class="time_text">Time Ends:</div>
				<div class="timer_sec"><?php echo  date('H:i:s', strtotime($data['resEnd'])); ?></div>			
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
		<!-- 	<br> -->
			
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
							<td><?php echo $data['count']; ?></td>
						</tr>
						<tr class="grand-total">
							<td>Total</td>
							<td></td>
							<td></td>
							<td><?php echo $data['total']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		<!-- 	<br> -->
			
			<div id="cancel-policy" class="summary">
				<div>
					<h3>CANCELLATION POLICY</h3>
				</div>
				<p>Deposit is non-refundable and will be charged to your credit card.</p>
				<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
			</div>
		
			<br><!-- <br> -->
			
			<button type="submit" id="payhere-payment" class="btn checkout-btn">Checkout &raquo;</button>
			<img id="payment-image" src="<?php echo URLROOT ?>/public/img/payhere.jpg">

		</div>
		<div class="content-row">
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	<button data-target="alert-warning-popup" class="alert-btn2 hidden-btn" type="button" id="time-alert-btn"></button>

	<!-- alert warning2 pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Timeout Warning!</h3>
				<p>Your reservation will get cancelled in less than one minute!</p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning2 popup -->

	<!-- js for flash message -->
	<script>
		const alertBtn2 = document.querySelectorAll(".alert-btn2");
		alertBtn2.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const alertBox = document.getElementById(target)
				alertBox.classList.add("alert-box-show");

				const closeAlert = alertBox.querySelector(".close-alert");
				closeAlert.addEventListener("click",function(){
					alertBox.classList.remove("alert-box-show");
				});

				alertBox.addEventListener("click",function(event){
					if(event.target === this){
						alertBox.classList.remove("alert-box-show");
					}
				});
			});
		});

	</script>
	<!-- end of js for flash message -->

	<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
	
	<script>
	    // Called when user completed the payment. It can be a successful payment or failure
	    payhere.onCompleted = function onCompleted(orderId) {
	        console.log("Payment completed. OrderID:" + orderId);
	        window.location.href='<?php echo URLROOT; ?>/passengerReservations/bookingConf?resNo='+orderId;
	    };

	    // Called when user closes the payment without completing
	    payhere.onDismissed = function onDismissed() {
	        //Note: Prompt user to pay again or show an error page
	        console.log("Payment dismissed");
	    };

	    // Called when error happens when initializing payment such as invalid parameters
	    payhere.onError = function onError(error) {
	        // Note: show an error page
	        console.log("Error:"  + error);
	    };

	    // Put the payment variables here
	    var payment = {
	        "sandbox": true,
	        "merchant_id": "1216685",    // Replace your Merchant ID
	        "return_url": undefined,     // Important
	        "cancel_url": undefined,     // Important
	        "notify_url": "<?php echo URLROOT; ?>/passengerReservations/done",
	        "order_id": "<?php echo $data['resNo']; ?>",
	        "items": "-",
	        "amount": "<?php echo $data['total']; ?>",
	        "currency": "LKR",
	        "first_name": "<?php echo $data['account']->firstname; ?>",
	        "last_name": "<?php echo $data['account']->lastname;?>",
	        "email": "<?php echo $data['account']->email;?>",
	        "phone": "<?php echo $data['account']->mobileno;?>",
	        "address": "-",
	        "city": "-",
	        "country": "-",
	        "delivery_address": "-",
	        "delivery_city": "-",
	        "delivery_country": "-",
	        "custom_1": "",
	        "custom_2": ""
	    };

	    // Show the payhere.js popup, when "PayHere Pay" is clicked
	    document.getElementById('payhere-payment').onclick = function (e) {
	        payhere.startPayment(payment);
	    };
	</script>

	<script>
		function refreshAt(hours, minutes, seconds) {
		    var now = new Date();
		    var then = new Date();

		    if(now.getHours() > hours ||
		       (now.getHours() == hours && now.getMinutes() > minutes) ||
		        now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() > seconds) {
		    	then.setDate(now.getDate() + 1);

		        //window.location.href='<?php echo URLROOT; ?>/passengerReservations/timeout?resNo=<?php echo $data['resNo']; ?>';
		    }
		    then.setHours(hours);
		    then.setMinutes(minutes);
		    then.setSeconds(seconds);

		    var timeout = (then.getTime() - now.getTime());

		    setTimeout(function() { 
		    	//alert("You have 1 minute remaining");
		    	document.getElementById('time-alert-btn').click();
		    	const tm = document.getElementById('countdown');
		    	tm.style.backgroundColor = '#F39E82';
		    	tm.style.borderColor = '#F39E82';

		    	//window.location.reload(true); 
		    }, timeout-60000);

		    setTimeout(function() { 
		    	//window.location.href='<?php echo URLROOT; ?>/passengerReservations/timeout';
		    	window.location.href='<?php echo URLROOT; ?>/passengerReservations/timeout?resNo=<?php echo $data['resNo']; ?>';
		    	//window.location.reload(true); 
		    }, timeout);
		}

		$(document).ready(function() { 
		   refreshAt(<?php echo date('H', strtotime($data['resEnd'])); ?>,<?php echo date('i', strtotime($data['resEnd'])); ?>,<?php echo date('s', strtotime($data['resEnd'])); ?>);  
		});
	</script>

	
<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>