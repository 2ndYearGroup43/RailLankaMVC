<?php 
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- search results -->
	<div class="body-section">
		<a href="#" id="pop-up" class="btn pop-up-btn">Search <i class="fa fa-search" aria-hidden="true"></i></a>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		
		<div class="table-container">

			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>

			<h1 class="title">Search Results</h1>

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
						<tr class="active-row">
							<td data-label="Train ID"><?php echo $train->trainId; ?></td>
							<td data-label="Train ID"><?php echo $train->name; ?></td>
							<td data-label="From"><?php echo $train->srcName; ?></td>
							<td data-label="To"><?php echo $train->destName; ?></td>
							<td data-label="Departure Time"><?php echo $train->starttime; ?></td>
							<td data-label="Arrival Time"><?php echo $train->endtime; ?></td>
							<td data-label="Type"><?php echo $train->type; ?></td>
							<td>
								<button type="submit" data-target="alert-success-popup" train-id="<?php echo $train->trainId; ?>" class="alert-btn btn"><span>Subscribe</span></button>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<center><button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/search'" class="btn blue-btn back-btn"><i class="fa fa-long-arrow-left"></i > Back</button></center>		
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
	
				<form action="<?php echo URLROOT;?>/passengerAlerts/search?>" method="post">
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

	<!-- alert success pop up -->
	<div class="flash-alert-box" id="alert-success-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-check" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Subscription Successful!</h3>
				<p>You will recieve notifications via email for trainid: <label id="alert-train-id"></label>.
				</p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert success popup -->

	<!-- alert error pop up -->
	<div class="flash-alert-box" id="alert-error-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Error!</h3>
				<p id="alert-error-msg"></p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert error popup -->

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

	<!-- js for flash messages  -->
	<script>
			const alertBtn = document.querySelectorAll(".alert-btn");
			alertBtn.forEach(function(btn){
				btn.addEventListener("click", function(){

					const target = this.getAttribute("data-target");
					const errorAlertBox = document.getElementById("alert-error-popup");
					const alertBox = document.getElementById(target);
					const trainid = this.getAttribute("train-id");

					$.ajax({
						url:"<?php echo URLROOT; ?>/passengerAlerts/subscribe",
						type:"POST",
						data: {'trainid':trainid},
						success: function(returndata){
							if(returndata==1){
								
								$("#alert-train-id").html(trainid);
								alertBox.classList.add("alert-box-show");

								const closeAlert = alertBox.querySelector(".close-alert");
								closeAlert.addEventListener("click",function(){
									alertBox.classList.remove("alert-box-show");
								});

								alertBox.addEventListener("click",function(event){
									if(event.target === this){
										alertBox.classList.remove("alert-box-show");
									}
								});
							} else{

								if(returndata==2){
									$("#alert-error-msg").html("You have already subscribed to recieve alerts from this train");
								}else{
									$("#alert-error-msg").html("Something went wrong, Please try agaian");
								}

								errorAlertBox.classList.add("alert-box-show");

								const closeAlert = errorAlertBox.querySelector(".close-alert");
								closeAlert.addEventListener("click",function(){
									errorAlertBox.classList.remove("alert-box-show");
								});

								errorAlertBox.addEventListener("click",function(event){
									if(event.target === this){
										errorAlertBox.classList.remove("alert-box-show");
									}
								});
							}
						},
						error: function(){
							alert('error');
						}
					})
				});
			});

		</script>
		<!-- end of js for flash messages -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>