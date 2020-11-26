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

<!-- <?php var_dump($_SESSION); ?>  -->

<!-- form -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="form-container">
			<h1 class="title">Contact Us</h1>
			<br>
			<form action="#">
				<div class="form-row">	
					<div class="input-data">
						<input type="text" name="" required>
						<div class="underline"></div>
						<label>First Name</label>
					</div>
				</div>	
				<div class="form-row">
					<div class="input-data">
						<input type="text" name="" required>
						<div class="underline"></div>
						<label>Last Name</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data">
						<input type="email" name="" required>
						<div class="underline"></div>
						<label>Email Address</label>
					</div>
				</div>
				<div class="form-row">	
					<div class="input-data textarea">
						<textarea cols="30" rows="10" required></textarea>	
						<div class="underline"></div>
						<label>Write Your Message</label>
					</div>
				</div>
				<br>
				<div class="form-row">
					<button type="submit" class="blue-btn btn">Submit</button>
					<button onclick="location.href='<?php echo URLROOT; ?>/pages/index'" type="submit" class="blue-btn btn">Back</button>
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

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>


