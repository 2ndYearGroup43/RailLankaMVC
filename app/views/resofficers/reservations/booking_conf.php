<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>

<div class="body-section" id="e-ticket">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket" id="review">
			<div>
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title" style="padding-left: 275px;">BOOKING REVIEW</h1>
			<div class="summary">
				<center><p>We will email you a confirmation of this booking.</p><p> You may also view your reservation details online at any time.</p></center>
				<button onclick="printContent('e-ticket')" class="print"><i class="fa fa-print" aria-hidden="true"></i> Print This Page </button>
			</div>

			<div class="summary-header">
				<h3>YOUR JOURNEY : Ticket ID <?php echo $data['tickets']->ticketId; ?></h3>
			</div>
			<div class="summary">
			
				<div class="journey">
					<?php echo $data['train']->srcName; ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo $data['train']->destName; ?>
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
			
			<div id="cancel-policy" class="summary">
				<div>
					<h3>CANCELLATION POLICY</h3>
				</div>
				<p>A passenger is entitled to a refund on the ticket price if a train journey is marked as cancelled, regardless of the reason. A full refund can be obtained by producing the email confirmation/e-ticket at the counter.</p>
			</div>
			
			<div class="summary-header">
				<h3>CUSTOMER DETAILS</h3>
			</div>
			<div class=summary>
				<div class="acc-wrapper">
					    <div class="acc-form">
						    <div class="acc-inputfield">
						    	<p>Name <b><?php echo $data['account']->firstname; ?> <?php echo $data['account']->lastname; ?></b></p>
						    </div> 
						    <div class="acc-inputfield">
						    	<p>NIC <b><?php echo $data['account']->nic; ?></b></p>
						    </div>
						    <div class="acc-inputfield">
						    	<p>Telephone No <b><?php echo $data['account']->mobileno; ?></b></p>
						    </div> 
					    </div>
					</div>
			</div>
			
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">		
		</div>
	</div>

	<script>
		function printContent(el){
			var restorepage = document.body.innerHTML;
			var printContent = document.getElementById(el).innerHTML;
			document.body.innerHTML = printContent;
			window.print();
			document.body.innerHTML = restorepage;
		}
	</script>
	
<?php
    require APPROOT.'/views/includes/footer.php';
?>