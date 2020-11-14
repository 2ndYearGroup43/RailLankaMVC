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
		<div class="table-container">
			<h1 class="title">Train Details</h1>
			<!-- <div class=form-container> -->
				<table class="details-content-table">

					<tbody>	
						<tr>
							<th>Type:</th>	
							<td>A.C.-Intercity</td>
						</tr>
						<tr>
							<th>From:</th>	
							<td>Colombo Fort</td>
						</tr>
						<tr>
							<th>To:</th>	
							<td>Kandy</td>
						</tr>
						<tr>
							<th>Departure Time:</th>	
							<td>7.00 a.m.</td>
						</tr>
						<tr>
							<th>Arrival Time:</th>	
							<td>9.38 p.m.</td>
						</tr>
						<tr>
							<th>Duration:</th>	
							<td>2hrs 38min</td>
						</tr>
						<tr>
							<th>Tickets:</th>	
							<td>
								<ul>
									<li>Commuter: Rs:125.00</li><br>
									<li>2nd Class: Rs:230.00</li><br>
									<li>1st Class: N/A</li><br>	
								</ul>
							</td>
						</tr>
					</tbody>		
				</table>
				<br>
				<table class="content-table">

					<thead>
						<tr>
							<th>Stop Number</th>
							<th>Station</th>
							<th>Arrival Time</th>
							<th>Departure Time</th>
							<th>First Class Price</th>
							<th>Second Class Price</th>
							<th>Third Class Price</th>
					<tbody>	
						<tr>	
							<td data-label="Stop No.">xxxxxxxxxxxx</td>
							<td data-label="Station">xxxxxxxxxxxx</td>
							<td data-label="Arrival Time">xxxxxxxxxxxx</td>
							<td data-label="Dept. Time">xxxxxxxxxxxx</td>
							<td data-label="First Class">xxxxxxxxxxxx</td>
							<td data-label="Second Class">xxxxxxxxxxxx</td>
							<td data-label="Third Class">xxxxxxxxxxxx</td>
						</tr>
						<tr>	
							<td data-label="Stop No.">xxxxxxxxxxxx</td>
							<td data-label="Station">xxxxxxxxxxxx</td>
							<td data-label="Arrival Time">xxxxxxxxxxxx</td>
							<td data-label="Dept. Time">xxxxxxxxxxxx</td>
							<td data-label="First Class">xxxxxxxxxxxx</td>
							<td data-label="Second Class">xxxxxxxxxxxx</td>
							<td data-label="Third Class">xxxxxxxxxxxx</td>
						</tr>
					</tbody>		
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/displayTrains'" type="submit" class="btn blue-btn back-btn">Back</button>
		</div>
		<div class="content-row">
			<!-- <button type="submit" class="back-btn"><span>Back</span></button> -->
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	 <!--  js for toggle menu -->
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

	
<?php require APPROOT . '/views/includes/footer.php'; ?>