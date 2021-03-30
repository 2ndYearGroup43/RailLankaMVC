<?php 

	if(isLoggedIn()){
		redirect($_SESSION['role']);
	}

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

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>