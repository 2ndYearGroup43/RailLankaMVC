<?php 

	// isPassenger();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- search results -->
	<div class="body-section">
		<a href="#" id="pop-up" class="btn blue-btn pop-up-btn">Search <i class="fa fa-search" aria-hidden="true"></i></a>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title2">Search Results</h1>
			<!-- <a href="#" id="pop-up" class="btn blue-btn pop-up-btn">Search <i class="fa fa-search" aria-hidden="true"></i></a> -->
			<!-- <div class=form-container> -->
				<table class="content-table">
					<thead>
						<tr>
							<th>Train ID</th>
							<th>Name</th>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($data['trains'] AS $train):?>
						<tr>
							<td data-label="Train ID"><?php echo $train->trainId; ?></td>
							<td data-label="Train ID"><?php echo $train->name; ?></td>
							<td data-label="From"><?php echo $train->srcName; ?></td>
							<td data-label="To"><?php echo $train->destName; ?></td>
							<td data-label="Departure Time"><?php echo $train->starttime; ?></td>
							<td data-label="Arrival Time"><?php echo $train->endtime; ?></td>
							<td data-label="Type"><?php echo $train->type; ?></td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/displayTrainDetails/<?php echo $train->trainId;?>'" type="submit" class="btn"><span>Details</span></button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<br>
				<div class="pagination">
					<ul>
						<li><a href="#" class="prev">Prev</a></li>
						<li class="pageNumber active"><a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains">1</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains">2</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains">3</a></li>
						<li><a href="<?php echo URLROOT; ?>/passengerSchedules/displayTrains" class="next">Next</a></li>
					</ul>
				</div>
				<br>		
				<!-- <button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/search'" type="submit" class="btn blue-btn back-btn">Back</button> -->
		</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of search results -->

	<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="acc-wrapper">
				<div class="img-container">
					<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
				</div>  
				<!-- <h1 class="title" id="title4">Search Trains</h1> -->
					    <form action="<?php echo URLROOT;?>/passengerSchedules/search?>" method="post">
						    <div class="acc-form">

						    	<label>Source Station</label>
						    	<div class="acc-inputfield">
						          	<input type="text" name="source" list="stationList" class="acc-input">
									<datalist id="stationList">
										<?php foreach ($data['stations'] as $station):?>
											<option value="<?php echo $station->stationName; ?>">
										<?php endforeach ?>
									</datalist>
						          	<span class="invalidFeedback">
			                            <?php echo $data['srcError'];?>
			                        </span>
						       	</div> 

						       	<label>Destination Station</label>
						       	<div class="acc-inputfield">
						          	<input type="text" name="destination" list="stationList" class="acc-input">
									<datalist id="stationList">
										<?php foreach ($data['stations'] as $station):?>
											<option value="<?php echo $station->stationName; ?>">
										<?php endforeach ?>
									</datalist>
						          	<span class="invalidFeedback">
			                            <?php echo $data['destError'];?>
			                        </span>
						       	</div>   

						       	<label>Departure Date</label>
						       	<div class="acc-inputfield">
						          	<input type="date" name="date" class="acc-input">
						          	<span class="invalidFeedback">
			                            <?php echo $data['dateError'];?>
			                        </span>
						       	</div>  

						      	<label>Departure Time</label>
						      	<div class="acc-inputfield">
						          	<input type="time" name="time" class="acc-input">
						          	<span class="invalidFeedback">
			                            <?php echo $data['timeError'];?>
			                        </span>
						       	</div> 
						       	
						    	<div class="acc-inputfield-flex">
						        	<input type="submit" name="search" class="acc-btn">
						      	</div>
						    </div>
						</form>
					</div>
			</div>
		</div>
	</div>
	<!-- end of pop up -->


	<!-- js for pop up -->
	<script>

		document.getElementById('pop-up').addEventListener('click', function() {
				document.querySelector('.bg-modal').style.display = 'flex';
		});

		document.querySelector('.close').addEventListener('click', function(){
			document.querySelector('.bg-modal').style.display = 'none';
		});

	</script>
	<!-- end of js for pop up -->

	<!-- js for pagination --> 
	<script>
		$(document).ready(function(){
			$('.next').click(function(){
				$('.pagination').find('.pageNumber.active').next().addClass('active');
				$('.pagination').find('.pageNumber.active').prev().removeClass('active');
			});
			$('.prev').click(function(){
				$('.pagination').find('.pageNumber.active').prev().addClass('active');
				$('.pagination').find('.pageNumber.active').next().removeClass('active');
			});
		});
	</script>
	<!-- end of js for pagination -->


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>