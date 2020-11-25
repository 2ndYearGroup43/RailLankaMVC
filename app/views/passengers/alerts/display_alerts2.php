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

<?php var_dump($_SESSION); ?> 


<!-- display all alerts -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>

		<div class="table-container">
			<h1 class="title">Alerts</h1>

				<div class="row alerts-row">

					<div class="col">
						<div class="alerts-wrapper">
						    <div class="alerts-search-box">
						        <div class="alerts-dropdown">
						            <div class="default_option">Train ID
						            </div>  
							        <ul>
							           	<li>Train ID</li>
							           	<li>Alert ID</li>
							           	<li>Date</li>
							        </ul>
						        </div>
						      	<div class="search-field">
						        	<input type="text" class="alerts-input" placeholder="Search">
						        	<i class="fa fa-search"></i>
						      	</div>
						  	</div>
						</div>
					</div>
					<?php if(isset($_SESSION['userid'])) : ?>
                    <div class="btn-group col-4" id="cng">
					  <button onclick="location.href='<?php echo URLROOT; ?>/passengerAccounts/displaySubscriptions'" class="blue-btn">My Alerts</button>
					  <button onclick="location.href='<?php echo URLROOT; ?>/passengerAlerts/search'" class="blue-btn">Subscribe</button>
					</div>
					<?php endif; ?>
				</div>

				<table class="content-table">
					<thead>
						<tr>
							<th>AlertID</th>
							<th>TrainID</th>
							<th>Type</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="AlertID">007</td>
							<td data-label="TrainID">0019</td>
							<td data-label="Type">Delay</td>
							<td data-label="Date">29/10/2020</td>
							<td>
								<button type="submit" class="btn pop-up"><span>View Details</span></button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">008</td>
							<td data-label="TrainID">0013</td>
							<td data-label="Type">Rescheduled</td>
							<td data-label="Date">27/10/2020</td>
							<td>
								<button type="submit" class="btn pop-up">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">009</td>
							<td data-label="TrainID">0081</td>
							<td data-label="Type">Cancelled</td>
							<td data-label="Date">25/10/2020</td>
							<td>
								<button type="submit" class="btn pop-up">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">010</td>
							<td data-label="TrainID">0071</td>
							<td data-label="Type">Cancelled</td>
							<td data-label="Date">22/10/2020</td>
							<td>
								<button type="submit" class="btn pop-up">View Details</button>
							</td>
						</tr>
						<tr>
							<td data-label="AlertID">011</td>
							<td data-label="TrainID">0019</td>
							<td data-label="Type">Delay</td>
							<td data-label="Date">16/10/2020</td>
							<td>
								<button type="submit" class="btn pop-up">View Details</button>
							</td>
						</tr>
					</tbody>
				</table>
				<br>
				<div class="pagination">
					<ul>
						<li><a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts" class="prev">Prev</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts">1</a></li>
						<li class="pageNumber active"><a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts2">2</a></li>
						<li class="pageNumber"><a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts3">3</a></li>
						<li><a href="<?php echo URLROOT; ?>/passengerAlerts/displayAlerts3" class="next">Next</a></li>
					</ul>
				</div>
				<br>			
			</div>
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of display all alerts -->

	<!-- pop up -->
	<div class="bg-modal">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<h2 class="title">Train Details</h2>
				<table class="content-table" id="details">

					<tbody>	
						<tr>
							<th>AlertID:</th>	
							<td>001</td>
						</tr>
						<tr>
							<th>TrainID:</th>	
							<td>0019</td>
						</tr>
						<tr>
							<th>Type:</th>	
							<td>Cancelled</td>
						</tr>
						<tr>
							<th>New Time:</th>	
							<td>7.00 a.m.</td>
						</tr>
						<tr>
							<th>New Date:</th>	
							<td>9.38 p.m.</td>
						</tr>
						<tr>
							<th>Cause:</th>	
							<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</td>
						</tr>
					</tbody>		
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

	<!-- js for pop up -->
	<script>

		$('.pop-up').bind('click', function() {
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

	<!-- js for dropdown -->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".default_option").click(function(){
				$(".alerts-dropdown ul").toggleClass("active");
			});
			$(".alerts-dropdown ul li").click(function(){
				var text = $(this).text();
				$(".default_option").text(text);
				$(".alerts-dropdown ul").removeClass("active");
			});
		});
	</script>

	<!-- end of js for drop down -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>