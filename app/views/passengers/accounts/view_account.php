<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?>
 -->


<!-- Account Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">My Account</h1>
			<?php foreach ($data['passenger'] as $row)?>
				<div class="row">
					<div class="btn-group">
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/editAccount'" type="submit" class="blue-btn"><span>Edit Account <i class="fa fa-edit"></i></span></button>
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayTickets'" type="submit" class="blue-btn"><span>My Tickets <i class="fa fa-credit-card" aria-hidden="true"></i></span></button>
						<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displaySubscriptions'" type="submit" class="blue-btn"><span>Subscriptions <i class="fa fa-bell-o" aria-hidden="true"></i></span></button>
					</div>
				</div>

				<table class="details-content-table">
					
					<tbody>	
						<tr>
							<th>First Name:</th>
							<td><?php echo $row->firstname;?></td>
						</tr>
						<tr>
							<th>Last Name:</th>
							<td><?php echo $row->lastname;?></td>
						</tr>
						<tr>
							<th>NIC:</th>
							<td><?php echo $row->nic;?></td>
						</tr>
						<tr>
							<th>Address Number:</th>
							<td><?php echo $row->address_number;?></td>
						</tr>
						<tr>
							<th>Street:</th>
							<td><?php echo $row->street;?></td>
						</tr>
						<tr>
							<th>City/Town:</th>
							<td><?php echo $row->city;?></td>
						</tr>
						<tr>
							<th>Country:</th>
							<td><?php echo $row->country;?></td>
						</tr>
						<tr>
							<th>Phone:</th>
							<td><?php echo $row->mobileno;?></td>
						</tr>
						<tr>
							<th>Email:</th>
							<td><?php echo $row->email;?></td>
						</tr>
					</tbody>   		
				</table>
		</div>
		<div class="content-row">
		</div>
	
	<div class="content-row">
	</div>
	<div class="content-row">
	</div>
	</div>
	<!-- end of account details -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>