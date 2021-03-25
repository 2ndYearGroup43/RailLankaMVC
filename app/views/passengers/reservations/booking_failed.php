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
		<h2>Timeout!</h2>
		<br>
		<p>Sorry, Looks like you ran out of time. </p>
		<p>Please make a new reservation</p>
		<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" id="submit" >New Reservation &raquo;</button>
		<br>
	</div>
</div>
</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>