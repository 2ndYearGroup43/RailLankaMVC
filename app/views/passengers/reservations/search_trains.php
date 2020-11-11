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

<!-- form -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="form-container">
			<h1 class="title">Search Trains</h1>
			<br>
			<form action="#">
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>
						<div class="underline"></div>
						<label>Source Station</label>
					</div>
				</div>	
				<div class="form-row">
					<div class="input-data">
						<input type="text" name="" required>
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
					<button onclick="location.href='<?php echo URLROOT; ?>/reservations/displayTrains'" type="button" class="blue-btn btn">Search</button>
					<button type="submit" class="blue-btn btn">Reset</button>
                </div>
			</form>	
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>

	</div>
<!-- js for toggle menu -->
<script>
	var menuItems = document.getElementById("menuItems");
	menuItems.style.maxHeight = "0px"
	function menutoggle(){
		if(menuItems.style.maxHeight == "0px"){
			menuItems.style.maxHeight = "390px";
		}
		else{
			menuItems.style.maxHeight = "0px";
		}
	}
</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>


