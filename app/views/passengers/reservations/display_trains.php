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
<br>
<?php var_dump($data['trains']); ?> -->
<?php var_dump($data['unavailable']); ?>
<!-- search results -->
	<div class="body-section">
		<a href="#" id="pop-up" class="btn pop-up-btn">Search <i class="fa fa-search" aria-hidden="true"></i></a>
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
			<h1 class="title2">Search Results: <label style="font-size: 18px"><?php echo $data['dateFull']; ?></label></h1>
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
								<button id="<?php echo $train->trainId;?>" data-target="alert-info-popup" type="button" class="btn alert-btn2"><span>Reserve</span></button>
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
					    <form action="<?php echo URLROOT;?>/passengerReservations/search?>" method="post">
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
						       	
						    	<div class="acc-inputfield">
						        	<input type="submit" name="search" class="acc-btn">
						      	</div>
						    </div>
						</form>
					</div>
		</div>
			<!-- <div class="notices-container">
				<div class="mini-schedule">
					<div class="img-container">
						<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
					</div>
					<br>
					<form action="#">
						<div class="form-row">
							<div class="mini-input-data">
								<label for="src">From</label>
                                <select name="src" id="src">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
							</div>
							<div class="mini-input-data">
								<label for="src">To</label>
                                <select name="src" id="src">
                                   	<option value="Fort">Fort</option>
                                   	<option value="Kandy">Kandy</option>
                                   	<option value="Galle">Galle</option>
                                   	<option value="Baadulla">Baadulla</option>
                                </select>
                            </div>	
						</div>
						<div class="form-row">
							<div class="mini-input-data">
								<label for="date">Date</label>
                            	<input type="date" id="date" >
                            </div>
						</div>
						<div class="form-row">
							<div class="mini-input-data">
								<label for="time">Time</label>
                            	<input type="time" id="time" >
                            </div>
						</div>
					</form>
					<center><button onclick="location.href='<?php echo URLROOT; ?>/passengerSchedules/displayTrains'" class="btn blue-btn">Go <i class="fa fa-long-arrow-right"></i></button></center>
				</div>
			</div> -->
		</div>
	</div>
	<!-- end of pop up -->

	<!-- alert info pop up -->
	<div class="flash-alert-box" id="alert-info-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-info" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Reserve Now?</h3>
				<p>You have 30 minutes to complete your reservation.</p>
				<button type="button" class="proceed-alert proceed-btn">Proceed</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert info popup -->

	<!-- js for flash message -->
	<script>
		const alertBtn2 = document.querySelectorAll(".alert-btn2");
		alertBtn2.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const trainid = this.getAttribute("id");
				const alertBox = document.getElementById(target)
				alertBox.classList.add("alert-box-show");

				const closeAlert = alertBox.querySelector(".close-alert");
				closeAlert.addEventListener("click",function(){
					alertBox.classList.remove("alert-box-show");
				});

				const proceedAlert = alertBox.querySelector(".proceed-alert");
				proceedAlert.addEventListener("click",function(){
					window.location.href="<?php echo URLROOT; ?>/passengerReservations/createReservation?id="+trainid+"&date=<?php echo $data['dateFull'];?>";
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