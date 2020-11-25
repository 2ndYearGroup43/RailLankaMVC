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
		<h2>Reset Password</h2>

		<form method="POST">

			<p class="options">Enter your new password.</p>

			<input type="password" placeholder="Password *"name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>

			<input type="password" placeholder="Confirm Password *"name="confirmPassword">
			<span class="invalidFeedback">
				<?php echo $data['confirmPasswordError']; ?>
			</span>


			<button id="submit" type="submit" value="submit">Submit</button>

		</form>
	</div>
</div>
</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>