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
		<p>Look like you ran out of time :/</p>
		<p>Reservation Number: <?php echo $data['resNo']; ?></p>
		<p><?php echo $data['resTime']; ?></p>
		<p>Rservation Completion Time: <?php echo $data['endTime']; ?></p>
		<p>Reservation Time: <?php echo floor($data['timeDiff']/60); ?> minutes</p>
		<br>
		<br>
		<br>
	</div>
</div>
</div>

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>