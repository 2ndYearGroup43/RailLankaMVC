<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<div class="banner">
<div class="container-login">
	<div class="wrapper-login" id="wrapper-register">
		<h2>Register</h2>

		<form action="<?php echo URLROOT; ?>/users/register" method="POST">

			<input type="text" placeholder="NIC No *"name="nic">
			<span class="invalidFeedback">
				<?php echo $data['nicError']; ?>
			</span>
			<p><center>or</center></p>
			<input type="text" placeholder="Passport No *"name="passport">
			<span class="invalidFeedback">
				<?php echo $data['passportError']; ?>
			</span>
			<br>
			<hr>

			<input type="email" placeholder="Email *"name="email">
			<span class="invalidFeedback">
				<?php echo $data['emailError']; ?>
			</span>

			<input type="password" placeholder="Password *"name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>
			<!-- <p class="login-hide">
				<i class="fa fa-circle-thin" aria-hidden="true"></i> Must be at least 8 characters
			</p>
			<p class="login-hide">
				<i class="fa fa-circle-thin" aria-hidden="true"></i> Should contain at least one numeric value
			</p> -->

			<input type="password" placeholder="Confirm Password *"name="confirmPassword">
			<span class="invalidFeedback">
				<?php echo $data['confirmPasswordError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options">Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Log In!</a></p>
		</form>
	</div>
</div>
</div>

<!-- js for toggle menu -->
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