<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	if(isLoggedIn()){
		redirect($_SESSION['role']);
	}

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<div class="banner">
<div class="container-login">
	<div class="wrapper-login">
		<h2>Sign In</h2>

		<form action="<?php echo URLROOT; ?>/users/login" method="POST">
			<input type="email" placeholder="Email *"name="email">
			<span class="invalidFeedback">
				<?php echo $data['emailError']; ?>
			</span>

			<input type="password" placeholder="Password *"name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options"><a href="<?php echo URLROOT; ?>/users/requestReset">Forgot Password?</a></p>

			<p class="options">Not registered yet? <a href="<?php echo URLROOT; ?>/users/register">Create an account!</a></p>
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

<?php require APPROOT . '/views/includes/footer.php'; ?>