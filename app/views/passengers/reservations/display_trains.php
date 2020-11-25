<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassengerLoggedIn();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<?php var_dump($_SESSION); ?> 

<!-- search results -->
	<div class="body-section">
		<a href="#" id="pop-up" class="btn pop-up-btn">Search <i class="fa fa-search" aria-hidden="true"></i></a>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<h1 class="title">Search Results</h1>
			<!-- <div class=form-container> -->
				<table class="content-table">
					<thead>
						<tr>
							<th>Train ID</th>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-label="Train ID">1005</td>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Badulla</td>
							<td data-label="Departure Time">05.55 a.m.</td>
							<td data-label="Arrival Time">16.07 p.m.</td>
							<td data-label="Type">Intercity - Podi Menike</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="btn"><span>Reserve</span></button>
							</td>
						</tr>
						<tr class="active-row">
							<td data-label="Train ID">1001</td>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Badulla</td>
							<td data-label="Departure Time">06.30 a.m.</td>
							<td data-label="Arrival Time">15.01 p.m.</td>
							<td data-label="Type">Intercity - Denuwara Menike</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="btn"><span>Reserve</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="Train ID">1015</td>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Badulla</td>
							<td data-label="Departure Time">08.30 a.m.</td>
							<td data-label="Arrival Time">17.44 p.m.</td>
							<td data-label="Type">Express - Udarata Menike</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="btn">Reserve</button>
							</td>
						</tr>
						<tr>
							<td data-label="Train ID">1007</td>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Badulla</td>
							<td data-label="Departure Time">9.45 a.m.</td>
							<td data-label="Arrival Time">19.20 a.m.</td>
							<td data-label="Type">Express Train</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="btn">Reserve</button>
							</td>
						</tr>
						<!-- <tr>
							<td data-label="Train ID">1045</td>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Badulla</td>
							<td data-label="Departure Time">20.30 a.m.</td>
							<td data-label="Arrival Time">07.37 a.m.</td>
							<td data-label="Type">Night Mail Train</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="btn">Reserve</button>
							</td>
						</tr> -->
					</tbody>
				</table>
			<!-- </div> -->
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" type="submit" class="btn blue-btn back-btn">Back</button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of search results -->

	<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
				<div class="mini-schedule">
					<h2 class="title">SEARCH TRAIN</h2>
					<form action="#">
						<div class="form-row">
							<div class="mini-input-data">
								<label for="src">From</label>
                                <select name="src" id="src">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
							</div>
							<div class="mini-input-data">
								<label for="src">To</label>
                                <select name="src" id="src">
                                   	<option value="Fort">Fort</option>
                                   	<option value="Kandy">Kandy</option>
                                   	<option value="Galle">Galle</option>
                                   	<option value="Baadulla">Baadulla</option>
                                </select>
                            </div>	
						</div>
						<!-- <div class="form-row">
							
						</div> -->
						<div class="form-row">
							<div class="mini-input-data">
								<label for="date">Date</label>
                            	<input type="date" id="date" >
                            </div>
						</div>
						<div class="form-row">
							<div class="mini-input-data">
								<label for="time">Time</label>
                            	<input type="time" id="time" >
                            </div>
						</div>
					</form>
					<button onclick="location.href='<?php echo URLROOT; ?>/reservations/displayTrains'" class="btn blue-btn">Go <i class="fa fa-long-arrow-right"></i></button>
				</div>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

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