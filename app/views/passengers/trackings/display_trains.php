<?php 

	//echo out databse info to the screen
	// foreach ($data['users'] as $user) {
	// 	echo "Information: " . $user->user_name . $user->user_email;
	// 	echo "<br>";
	// }
	
	// isPassengerLoggedIn();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<!-- <?php var_dump($_SESSION); ?>  -->

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
			<h1 class="title2">Search Results</h1>
			<!-- <div class=form-container> -->
				<table class="content-table">
					<thead>
						<tr>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Departure Time">7.00 a.m.</td>
							<td data-label="Arrival Time">9.38 a.m.</td>
							<td data-label="Type">A.C.- Intercity</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayLiveTrain'" type="submit" class="btn"><span>Track</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Departure Time">7.05 a.m.</td>
							<td data-label="Arrival Time">9.38 a.m.</td>
							<td data-label="Type">Intercity</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayLiveTrain'" type="submit" class="btn">Track</button>
							</td>
						</tr>
						<tr>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Departure Time">8.30 a.m.</td>
							<td data-label="Arrival Time">11.03 a.m.</td>
							<td data-label="Type">Express - Udarata Menike</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayLiveTrain'" type="submit" class="btn">Track</button>
							</td>
						</tr>
						<tr>
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Departure Time">10.35 a.m.</td>
							<td data-label="Arrival Time">1.55 a.m.</td>
							<td data-label="Type">Colombo Commuter</td>
							<td>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayLiveTrain'" type="submit" class="btn">Track</button>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<div class="pagination">
					<ul>
						<li><a href="#" class="prev">Prev</a></li>
						<li class="pageNumber active"><a href="<?php echo URLROOT; ?>/passengerTrackings/displayTrains">1</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerTrackings/displayTrains">2</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerTrackings/displayTrains">3</a></li>
						<li><a href="<?php echo URLROOT; ?>/passengerTrackings/displayTrains" class="next">Next</a></li>
					</ul>
				</div>
				<br>
			<!-- <button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/search'" type="submit" class="btn blue-btn back-btn">Back</button> -->
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
			<div class="notices-container">
				<div class="mini-schedule">
					<div class="img-container">
						<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
					</div>
					<h2 class="title">Search Train</h2>
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
						<!-- <div class="form-row">
							
						</div> -->
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
					<center><button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayTrains'" class="btn blue-btn">Go <i class="fa fa-long-arrow-right"></i></button></center>
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