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

<!-- <?php var_dump($_SESSION); ?>  -->
<?php var_dump($data['train']); ?>

<!-- Further Details -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">Train Details</h1>
			<!-- <div class=form-container> -->
				<?php foreach ($data['train'] as $train)?>
				<table class="details-content-table">

					<tbody>	

						<tr>
							<th>Train ID:</th>	
							<td><?php echo $train->trainId; ?></td>
						</tr>
						<tr>
							<th>Name:</th>	
							<td><?php echo $train->name; ?></td>
						</tr>
						<tr>
							<th>Type:</th>	
							<td><?php echo $train->type; ?></td>
						</tr>
						<tr>
							<th>From:</th>	
							<td><?php echo $train->srcName; ?></td>
						</tr>
						<tr>
							<th>To:</th>	
							<td><?php echo $train->destName; ?></td>
						</tr>
						<tr>
							<th>Departure Time:</th>	
							<td><?php echo $train->starttime; ?></td>
						</tr>
						<tr>
							<th>Arrival Time:</th>	
							<td><?php echo $train->endtime; ?></td>
						</tr>
						<tr>
							<th>Distance:</th>	
							<td><?php echo $train->distance; ?> km</td>
						</tr>
						<tr>
							<th>Tickets:</th>	
							<td>
								<ul>
									<?php if($train->fclassbase): ?>
										<li><label class="label1">1st Class</label> - Rs. <?php echo $train->fclassbase; ?></li><br>
									<?php else: ?>
										<li><label class="label1">1st Class</label> - Not Available</li><br>
									<?php endif; ?>

									<?php if($train->sclassbase): ?>
										<li><label class="label2">2nd Class</label> - Rs. <?php echo $train->sclassbase; ?></li><br>
									<?php else: ?>
										<li><label class="label2">2nd Class</label> - Not Available</li><br>
									<?php endif; ?>

									<?php if($train->tclassbase): ?>
										<li><label class="label3">3rd Class</label> - Rs. <?php echo $train->tclassbase; ?></li><br>
									<?php else: ?>
										<li><label class="label3">3rd Class</label> - Not Available</li><br>
									<?php endif; ?>	
								</ul>
							</td>
						</tr>
					</tbody>		
				</table>
				<br>
				<h3>Colombo Fort to Badulla Train Stops</h3>
				<table class="content-table">

					<thead>
						<tr>
							<th>Stop Number</th>
							<th>Station</th>
							<th>Arrival Time</th>
							<th>Departure Time</th>
							<th>First Class Price</th>
							<th>Second Class Price</th>
							<th>Third Class Price</th>
					<tbody>	
						<?php foreach ($data['route'] as $stop):?>
						<tr>	
							<td data-label="Stop No."><?php echo $stop->stopNo; ?></td>
							<td data-label="Station"><?php echo $stop->stationName; ?></td>
							<td data-label="Arrival Time"><?php echo $stop->arrivaltime; ?></td>
							<td data-label="Dept. Time"><?php echo $stop->departuretime; ?></td>
							<td data-label="First Class">-</td>
							<td data-label="Second Class">-</td>
							<td data-label="Third Class">-</td>
						</tr>
						<?php endforeach; ?>
					</tbody>		
				</table>
				<br>
				<h3>Available Days</h3>
				<table class="content-table">

					<thead>
						<tr>
							<th>Monday</th>
							<th>Tuesday</th>
							<th>Wednesday</th>
							<th>Thursday</th>
							<th>Friday</th>
							<th>Saturday</th>
							<th>Sunday</th>
					<tbody>	
						<tr>
							<?php if($train->monday=="Yes"): ?>
								<td data-label="Monday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Monday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->tuesday=="Yes"): ?>
								<td data-label="Tuesday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Tuesday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->wednesday=="Yes"): ?>
								<td data-label="Wednesday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Wednesday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->thursday=="Yes"): ?>
								<td data-label="Thursday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Thursday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->friday=="Yes"): ?>
								<td data-label="Friday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Friday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->saturday=="Yes"): ?>
								<td data-label="Saturday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Saturdayurday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
							<?php if($train->sunday=="Yes"): ?>
								<td data-label="Sunday"><i class="fa fa-check check"></i></td>
							<?php else: ?>
								<td data-label="Sunday"><i class="fa fa-times cross"></i></td>
							<?php endif; ?>
						</tr>
					</tbody>		
				</table>
			<!-- </div> -->
			<button onclick="history.go(-1);" class="btn blue-btn back-btn">Back</button>
		</div>
		<div class="content-row">
			<!-- <button type="submit" class="back-btn"><span>Back</span></button> -->
		</div>
		<div class="content-row">		
		</div>
	</div>
	<!-- end of further details -->

	 <!--  js for toggle menu -->
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