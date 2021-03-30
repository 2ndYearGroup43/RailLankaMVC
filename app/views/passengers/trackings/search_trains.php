<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>


<!-- form -->
	<div class="body-section">

		<div class="content-row">
		</div>
		<div class="content-row">
		</div>

		<div class="form-container">

			<div class="acc-wrapper">

				<div class="img-container">
					<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
				</div>  

				<h1 class="title" id="title4">Search Trains</h1>
			
					    <form action="<?php echo URLROOT;?>/passengerTrackings/search?>" method="post">
						   
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

		<div class="content-row">
		</div>
		<div class="content-row">

		</div>

	</div>
	<!-- end of search form -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>

