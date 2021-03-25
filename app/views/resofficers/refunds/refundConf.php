<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>


	<div class="body-section"  id="e-ticket">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="conf-ticket">
			<div class="print-header">
				<img src="<?php echo URLROOT ?>/public/img/logob2.png">
				<p class="title">REFUNDING SUCCESSFUL!</p>	
			</div>
			<div class="normal-header">
				<img src="<?php echo URLROOT ?>/public/img/logob2.png">
				<h1 class="title" style="padding-left: 175px";>REFUNDING SUCCESSFUL!</h1>
				<div class="summary">
					<center><p>Thank you for booking with us!</p></center>
				</div>
			</div>
		
			<div class="summary-header">
				<h3>REFUND DETAILS</h3>
			</div>
			<div class=summary>
				<table class="content-table">
					<tbody>
						<tr>
							<td><b>Ticket ID:</b></td>
							<td><?php echo $data['tickets']->ticketId?></td>
						</tr>
						<tr>
							<td><b>NIC:</b></td>
							<td><?php echo $data['tickets']->nic?></td>
						</tr>
						<tr>
							<td><b>Train ID:</b></td>
							<td><?php echo $data['tickets']->trainId?></td>
						</tr>
						<tr>
							<td><b>Train ID:</b></td>
							<td><?php echo $data['trains']->name?></td>
						</tr>
						<tr>
							<td><b>Price:</b></td>
							<td><?php echo $data['tickets']->price?></td>
						</tr>
						<tr>
							<td><b>Journey Date:</b></td>
							<td><?php echo $data['journeys']->journeyDate?></td>
						</tr>
						<tr>
							<td><b>Start Station:</b></td>
							<td><?php echo $data['journeys']->srcName?></td>
						</tr>
						<tr>
							<td><b>End Station:</b></td>
							<td><?php echo $data['journeys']->destName?></td>
						</tr>
					</tbody>
				</table>
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
							<li><i class="fa fa-phone" aria-hidden="true"></i> Colombo Fort - +940112-695-722 </li>
							<li><i class="fa fa-phone" aria-hidden="true"></i> Kandy - +940812-222-271</li>
							<li><i class="fa fa-at" aria-hidden="true"></i> raillankaproject@gmail.com</li>
						</ul>
					</div>
				</div>
			</div>
			<div id="policy" class="summary" style="padding-bottom: 100px";>
				<button onclick="printContent('e-ticket')" class="print"><i class="fa fa-print" aria-hidden="true" ></i> Print</button>
			</div>
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