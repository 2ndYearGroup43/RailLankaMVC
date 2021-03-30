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
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">Search Results: <label style="font-size: 18px"><?php echo $data['dateFull']; ?></label></h1>

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
				<center><button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/search'" class="btn blue-btn back-btn"><i class="fa fa-long-arrow-left"></i > Back</button></center>		
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
						   	<input type="date" name="date" min="<?php echo date("Y-m-d"); ?>" max="<?php echo date("Y-m-d", strtotime("+2 months")); ?>" class="acc-input">
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

	<!-- alert error pop up -->
	<div class="flash-alert-box" id="alert-error-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Sorry!</h3>
				<p>Reservation are allowed only up to 1 hour before the journey</p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

	<!-- js for flash message -->
	<script>
		const alertBtn2 = document.querySelectorAll(".alert-btn2");
		alertBtn2.forEach(function(btn){
			btn.addEventListener("click", function(){
				const jdate = "<?php echo $data['dateFull'];?>";
				const trainid = this.getAttribute("id");
				const target = this.getAttribute("data-target");
				const alertBox = document.getElementById(target);
				const errorAlertBox = document.getElementById("alert-error-popup");

				$.ajax({
					url:"<?php echo URLROOT; ?>/passengerReservations/checkDeptTime",
					type:"POST",
					data: {'trainid':trainid, 'jdate':jdate},
					success: function(returndata){
						if(returndata == 1){
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

						}else{

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


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>