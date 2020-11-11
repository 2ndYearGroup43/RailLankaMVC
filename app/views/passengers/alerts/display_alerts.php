<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	isPassenger();
	require APPROOT . '/views/includes/head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<?php var_dump($_SESSION); ?> 


<!-- display all alerts -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Alerts</h1>
				<div class="row alerts-row">
					<div class="col">
						<div class="alert-search-box">
						<input class="search-txt" type="text" name="" placeholder="Enter train ID">
						<a class="search-btn" href="#">
							<i class="fa fa-search"></i>
						</a>
					</div>
					</div>
					<div class="col">
						<div class="dropdown">
							<button class="dropbtn">Select Type  <i class="fa fa-caret-down"></i></button>
							<div class="dropdown-content">
								<a href="<?php echo URLROOT; ?>/alerts/displayDelayed">Delayed</a>
								<a href="<?php echo URLROOT; ?>/alerts/displayRescheduled">Rescheduled</a>
								<a href="<?php echo URLROOT; ?>/alerts/displayCancelled">Cancelled</a>
							</div>
						</div>
					</div>
					<?php if(isset($_SESSION['userid'])) : ?>
                    <div class="btn-group col-4" id="cng">
					  <button onclick="location.href='<?php echo URLROOT; ?>/accounts/displaySubscriptions'" class="blue-btn">My Alerts</button>
					  <button onclick="location.href='<?php echo URLROOT; ?>/alerts/search'" class="blue-btn">Subscribe</button>
					</div>
					<?php endif; ?>
				</div>
				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>Type</th>
							<th>Details</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="AlertID">001</td>
							<td data-label="TrainID">0019</td>
							<td data-label="Type">Delay</td>
							<td data-label="Cause">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
							<td>
								<button type="submit" id="pop-up" class="btn"><span>View Details</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">002</td>
							<td data-label="TrainID">0013</td>
							<td data-label="Type">Rescheduled</td>
							<td data-label="Cause">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
							<td>
								<button type="submit" id="pop-up" class="btn">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">003</td>
							<td data-label="TrainID">0081</td>
							<td data-label="Type">Cancelled</td>
							<td data-label="Cause">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
							<td>
								<button type="submit" id="pop-up" class="btn">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">004</td>
							<td data-label="TrainID">0019</td>
							<td data-label="Type">Delay</td>
							<td data-label="Cause">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
							<td>
								<button type="submit" class="btn">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">005</td>
							<td data-label="TrainID">0051</td>
							<td data-label="Type">Cancelled</td>
							<td data-label="Cause">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
							</td>
							<td>
								<button type="submit" id="pop-up" class="btn">View Details</button>
							</td>
						</tr>
					</tbody>
				</table>
			<!-- </div> -->
				
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of display all alerts -->

	<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<h2 class="title">Train Details</h2>
				<table class="content-table" id="details">

					<tbody>	
						<tr>
							<th>AlertID:</th>	
							<td>001</td>
						</tr>
						<tr>
							<th>TrainID:</th>	
							<td>0019</td>
						</tr>
						<tr>
							<th>Type:</th>	
							<td>Cancelled</td>
						</tr>
						<tr>
							<th>New Time:</th>	
							<td>7.00 a.m.</td>
						</tr>
						<tr>
							<th>New Date:</th>	
							<td>9.38 p.m.</td>
						</tr>
						<tr>
							<th>Cause:</th>	
							<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</td>
						</tr>
					</tbody>		
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

	<script>
		var menuItems = document.getElementById("menuItems");
		menuItems.style.maxHeight = "0px"
		function menutoggle(){
			if(menuItems.style.maxHeight == "0px"){
				menuItems.style.maxHeight = "360px";
			}
			else{
				menuItems.style.maxHeight = "0px";
			}
		}
	</script>

	<!-- js for pop up -->
	<script>

		document.getElementById('pop-up').addEventListener('click', function() {
				document.querySelector('.bg-modal').style.display = 'flex';
		});

		document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

	</script>
	<!-- end of js for pop up -->

<?php require APPROOT . '/views/includes/footer.php'; ?>