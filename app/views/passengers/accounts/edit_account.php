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


<!-- edit account form -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="form-container">
			<h1 class="title">Edit Profile</h1>
			<form action="#">
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>
						<div class="underline"></div>
						<label>Name</label>
					</div>
				</div>	
				<div class="form-row">
					<div class="input-data">
						<input type="text" name="" required>
						<div class="underline"></div>
						<label>Email</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>
						<!-- <i class="fa fa-calendar" aria-hidden="true"></i> -->			<div class="underline"></div>
						<label>NIC</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>	
						<div class="underline"></div>
						<label>Mobile No.</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>	
						<div class="underline"></div>
						<label>Address</label>
					</div>
				</div>
				<div class="form-row">
					<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" type="button" class="blue-btn btn">Save</button>
					<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" type="button" class="blue-btn btn">Back</button>
                </div>
			</form>	
		</div>
	</div>
<!-- end of edit account form -->

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