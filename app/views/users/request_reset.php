<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }

	if(isLoggedIn()){
		redirect($_SESSION['role']);
	}

	// use PHPMailer\PHPMailer\PHPMailer;
	// use PHPMailer\PHPMailer\SMTP;
	// use PHPMailer\PHPMailer\Exception;

	// require APPROOT . '/libraries/PHPMailer/src/Exception.php';
	// require APPROOT . '/libraries/PHPMailer/src/PHPMailer.php';
	// require APPROOT . '/libraries/PHPMailer/src/SMTP.php';

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<div class="banner">
<div class="container-login">
	<div class="wrapper-login">
		<h2>Reset Password</h2>

		<form action="<?php echo URLROOT; ?>/users/requestReset" method="POST">

			<p class="options">Enter your email and we'll send you a link to<br>get back into your account.</p>

			<input type="email" placeholder="Email *" name="email" autocomplete="off">
			<span class="invalidFeedback">
				<?php echo $data['emailError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options"><a href="<?php echo URLROOT; ?>/users/login">Back to Log In?</a></p>
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