<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?> 
 -->
<!-- subscriptions results -->

	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<!-- <div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div> -->
			<h1 class="title">My Subscriptions</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>Subscription No</th>
							<th>Train ID</th>
							<th>Name</th>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($data AS $row): ?>
						<tr>
							<td data-label=">Subscription No"><?php echo $row->subscriptionNo; ?></td>
							<td data-label="Train ID"><?php echo $row->trainId; ?></td>
							<td data-label="Name"><?php echo $row->name; ?></td>
							<td data-label="From"><?php echo $row->srcName; ?></td>
							<td data-label="To"><?php echo $row->destName; ?></td>
							<td data-label="Departure Time"><?php echo $row->starttime; ?></td>
							<td data-label="Arrival Time"><?php echo $row->endtime; ?></td>
							<td>
								<button id="<?php echo $row->subscriptionNo; ?>" type="submit" data-target="alert-warning-popup" class="alert-btn btn"><span>Unsubscribe</span></button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displayAccount'" type="submit" class="btn blue-btn back-btn"><span>Back</span></button>
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of tickets results -->

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>If you unsubscribe you won't receive email notifications in the future.</p>
				<!-- <p><a>Proceed Anyway?</a></p> -->
				<button type="button" class="proceed-alert proceed-btn">Proceed Anyway</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

	<!-- js for flash message -->
	<script>
		const alertBtn = document.querySelectorAll(".alert-btn");
		alertBtn.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const subid = this.getAttribute("id");
				const alertBox = document.getElementById(target)
				alertBox.classList.add("alert-box-show");

				const closeAlert = alertBox.querySelector(".close-alert");
				closeAlert.addEventListener("click",function(){
					alertBox.classList.remove("alert-box-show");
				});

				const proceedAlert = alertBox.querySelector(".proceed-alert");
				proceedAlert.addEventListener("click",function(){
					window.location.href="<?php echo URLROOT; ?>/passengerAccounts/unsubscribe?id="+subid+";?>";
				});


				alertBox.addEventListener("click",function(event){
					if(event.target === this){
						alertBox.classList.remove("alert-box-show");
					}
				});
			});
		});

	</script>
	<!-- end of js for flash message -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>