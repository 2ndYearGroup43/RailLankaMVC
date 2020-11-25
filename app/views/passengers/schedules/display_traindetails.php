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

<!-- Further Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">Train Details</h1>
			<!-- <div class=form-container> -->
				<table class="details-content-table">

					<tbody>	
						<tr>
							<th>Train ID:</th>	
							<td>1001</td>
						</tr>
						<tr>
							<th>Type:</th>	
							<td>Intercity Express - Denuwara Menike</td>
						</tr>
						<tr>
							<th>From:</th>	
							<td>Colombo Fort</td>
						</tr>
						<tr>
							<th>To:</th>	
							<td>Badulla</td>
						</tr>
						<tr>
							<th>Departure Time:</th>	
							<td>6.30 a.m.</td>
						</tr>
						<tr>
							<th>Arrival Time:</th>	
							<td>15.01 p.m.</td>
						</tr>
						<tr>
							<th>Duration:</th>	
							<td>8hrs 31min</td>
						</tr>
						<tr>
							<th>Tickets:</th>	
							<td>
								<ul>
									<li><label class="label1">1st Class</label>: Rs:1700.00</li><br>
									<li><label class="label2">2nd Class</label>: Rs:1000.00</li><br>
									<li><label class="label3">3rd Class</label>: Rs: 700.00</li><br>	
								</ul>
							</td>
						</tr>
					</tbody>		
				</table>
				<br>
				<h3>Colombo Fort to Badulla Train Stops</h3>
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
							<td data-label="Stop No.">001</td>
							<td data-label="Station">Colombo Fort</td>
							<td data-label="Arrival Time">6.20 AM</td>
							<td data-label="Dept. Time">6.30 AM</td>
							<td data-label="First Class">-</td>
							<td data-label="Second Class">-</td>
							<td data-label="Third Class">-</td>
						</tr>
						<tr>	
							<td data-label="Stop No.">002</td>
							<td data-label="Station">Peradeniya Junction</td>
							<td data-label="Arrival Time">8.40 AM</td>
							<td data-label="Dept. Time">8.50 AM</td>
							<td data-label="First Class">Rs 340.00</td>
							<td data-label="Second Class">Rs. 220.00</td>
							<td data-label="Third Class">Rs. 120.00</td>
						</tr>
						<tr>	
							<td data-label="Stop No.">003</td>
							<td data-label="Station">Gampola</td>
							<td data-label="Arrival Time">9.05 AM</td>
							<td data-label="Dept. Time">9.05 AM</td>
							<td data-label="First Class">Rs 400.00</td>
							<td data-label="Second Class">Rs. 230.00</td>
							<td data-label="Third Class">Rs. 130.00</td>
						</tr>
					</tbody>		
				</table>
				<br>
				<h3>Available Days</h3>
				<table class="content-table">

					<thead>
						<tr>
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
							<th>Saturday</th>
							<th>Sunday</th>
					<tbody>	
						<tr>	
							<td data-label="Monday"><i class="fa fa-check"></i></td>
							<td data-label="Tuesday"><i class="fa fa-check"></i></td>
							<td data-label="Wednesday"><i class="fa fa-check"></i></td>
							<td data-label="Thursday"><i class="fa fa-check"></i></td>
							<td data-label="Friday"><i class="fa fa-check"></i></td>
							<td data-label="Saturday"><i class="fa fa-check"></i></td>
							<td data-label="Sunday"><i class="fa fa-check"></i></td>
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

	
<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>