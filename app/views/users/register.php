<?php 

	if(isLoggedIn()){
		redirect($_SESSION['role']);
	}


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
			<input type="text" placeholder="First Name*" name="fname">
			<span class="invalidFeedback">
				<?php echo $data['fnameError']; ?>
			</span>
			<input type="text" placeholder="Last Name*" name="lname">
			<span class="invalidFeedback">
				<?php echo $data['lnameError']; ?>
			</span>
			<input type="text" placeholder="Mobile*" name="mobile">
			<span class="invalidFeedback">
				<?php echo $data['mobileError']; ?>
			</span>
			<input type="email" placeholder="Email *"name="email">
			<span class="invalidFeedback">
				<?php echo $data['emailError']; ?>
			</span>

			<input type="password" placeholder="Password *"name="password">
			<span class="invalidFeedback">
				<?php echo $data['passwordError']; ?>
			</span>

			<input type="password" placeholder="Confirm Password *"name="confirmPassword">
			<span class="invalidFeedback">
				<?php echo $data['confirmPasswordError']; ?>
			</span>

			<button id="submit" type="submit" value="submit">Submit</button>

			<p class="options">Already have an account? <a href="<?php echo URLROOT; ?>/users/login">Log In!</a></p>
		</form>
	</div>
</div>
<br>
</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>