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

<!-- form -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="form-container">
			<!-- <div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div> -->
			<h1 class="title">Search Trains</h1>
			<br>
			<form action="#">
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="source" list="stationList" required>
						<datalist id="stationList">
							<option>Fort</option>
							<option>Kandy</option>
							<option>Galle</option>
							<option>Badulla</option>
						</datalist>
						<div class="underline"></div>
						<label>Source Station</label>
					</div>
				</div>	
				<div class="form-row">
					<div class="input-data">
						<input type="text" name="destination" list="stationList" required>
						<div class="underline"></div>
						<label>Destination Station</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="date" name="" placeholder="" required>
						<div class="underline"></div>
						<label>Date</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="time" name="" required>	
						<div class="underline"></div>
						<label>Time</label>
					</div>
				</div>
				<div class="form-row">
					
					<button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/displayTrains'" type="button" class="blue-btn btn">Search</button> <!-- submit was removed -->
					<button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/search'" type="submit" class="blue-btn btn">Reset</button>
                </div>
			</form>	
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>

	</div>


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>

