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
	<div class="wrapper-login">
		<h2>Verify Email</h2>
		<br>
		<p>Thank you for signing up!</p>
		<p>We need to verify your email address</p>
		<p>Before you login please click on the verification link<br>sent to your email to activate your account.</p>
		<button onclick="location.href='<?php echo URLROOT; ?>/users/login'" id="submit" type="button" value="submit">Login</button>
	</div>
</div>
</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>