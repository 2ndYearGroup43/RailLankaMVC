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


<!-- display all alerts -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Notices</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Notice ID</th>
							<th>Date</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="Notice ID">001</td>
							<td data-label="Date">02/10/2020</td>
							<td data-label="Description">Unawatuna sub railway station temporarily closed over COVID-19 scare</td>
							<td>
								<button type="submit" id="pop-up" class="btn"><span>View Details</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">002</td>
							<td data-label="TrainID">28/08/2020</td>
							<td data-label="Type">Beliatta-Anuradhapura Express Train won't be in operation until further notice</td>
							<td>
								<button type="submit" id="pop-up" class="btn">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">003</td>
							<td data-label="TrainID">27/06/2020</td>
							<td data-label="Type">Class s5 718 - 719 finds a new home</td>
							<td>
								<button type="submit" id="pop-up" class="btn">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">004</td>
							<td data-label="TrainID">13/06/2020</td>
							<td data-label="Type">Fort-Station closed for renovation</td>
							<td>
								<button type="submit" class="btn">View Details</button>
							</td>
						</tr>
					</tbody>
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/pages/index'" type="submit" class="btn blue-btn back-btn">Back</button>	
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
			<h2 class="title">Alert ID:001</h2>
				<table class="content-table" id="details">
					<tbody>	
						<tr>
							<td>2nd October 2020</td>
						</tr>
						<tr>
							<td><h3>Unawatuna sub railway station temporarily closed due to COVID-19</h3></td>
						</tr>
						<tr>	
							<td>The Unawatuna Railway Station was temporarily closed on Monday (July 13), according to the Department of Railways.

							“An officer at the Unawatuna Railway Station was directed for PCR testing after it was confirmed he maintained contact with a COVID-19 case,” Dilantha Fernando – the General Manager of Railways said on Monday (July 12).

							According to Fernando, the Unawatuna Railway station will remain closed until the officer’s PCR test results are released.
							</td>
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

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>