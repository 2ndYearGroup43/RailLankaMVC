<?php 

	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

	<div class="body-section">
		<div class="content-row">
		</div>
		
		<div class="map-container2">
			
			<h1 class="title">Seat Map</h1>
			
			<div class="timer">
				<div class="time_text">Time Ends:</div>
				<div class="timer_sec"><?php echo  date('H:i:s', strtotime($data['endTime'])); ?></div>			
			</div>
			<button class="pop-up details-tooltip">Journey Details <i class="fa fa-train"></i></button>
			
				<div class="map-column left-map">
					<div class="tabs__sidebar" id="new_tabs_sidebar">
						<?php foreach ($data['compartments'] as $comp):?>
							
							<?php if($comp == $data['currComp']): ?>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps?compNo=<?php echo $comp->compartmentNo; ?>&resNo=<?php echo $data['resNo']; ?>'" type="submit" class="tabs__button tabs__button--active" ><span class="map-large">Compartment <?php echo $comp->compartmentNo; ?></span><span class="map-small"><?php echo $comp->compartmentNo; ?></span></button> 
							<?php else: ?>
								<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps?compNo=<?php echo $comp->compartmentNo; ?>&resNo=<?php echo $data['resNo']; ?>'" type="submit" class="tabs__button" ><span class="map-large">Compartment <?php echo $comp->compartmentNo; ?></span><span class="map-small"><?php echo $comp->compartmentNo; ?></span></button> 
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="map-column center-map">
						<center><h3 class="comp-name">Compartment <?php echo $data['compartmentNo']; ?> -  <?php echo $data['class']; ?> (Rs. <?php echo $data['compPrice']; ?>)</h3></center>
						<div id="seat-map">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
					<?php $count=0; ?>
					<?php $price=0; ?>
			    	<div class="map-column right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter">0</span>):</h4>
							<ul id="selected-seats">
								<?php foreach($data['selected'] AS $selected): ?>
								<?php if($selected->compartmentNo != $data['compartmentNo']):?>
									<?php $count ++; ?>
									<?php $price += (int)$selected->price; ?>
									<?php if($selected->classtype == "First Class"): ?>
									<li>
										<span>First Class Seat - </span>
										<div class="selected-btn btn-f"><?php echo $selected->compartmentNo; ?><?php echo $selected->seatNo; ?></div> :
										<b>Rs. <?php echo (int)$selected->price; ?></b>
									</li>
									<?php elseif($selected->classtype == "Second Class"): ?>
									<li>
										Second Class Seat - 
										<div class="selected-btn btn-s"><?php echo $selected->compartmentNo; ?><?php echo $selected->seatNo; ?></div> :
										<b>Rs. <?php echo (int)$selected->price; ?></b>
									</li>
									<?php else: ?>
									<li>
										Third Class Seat - 
										<div class="selected-btn btn-t"><?php echo $selected->compartmentNo; ?><?php echo $selected->seatNo; ?></div> :
										<b>Rs. <?php echo (int)$selected->price; ?></b>
									</li>	
									<?php endif; ?>
								<?php endif; ?>
								<?php endforeach; ?>
							</ul>
							Total: <b>Rs.<span id="total">0</span></b>	
						</div>
						<div id="legend"></div>
			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->
					<script>		
						var firstSeatLabel = 1;
				
						$(document).ready(function() {
							var $cart = $('#selected-seats'),
								$counter = $('#counter'),
								$total = $('#total'),
								sc = $('#seat-map').seatCharts({
								map: [
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss',
									'ss__ss'

								],
								seats: {
										f: {
											price   : <?php echo $data['train']->fclassbase; ?>,
											classes : 'first-class', 
											category: 'First Class'
										},
										s: {
											price   : <?php echo $data['train']->sclassbase; ?>,
											classes : 'second-class', 
											category: 'Second Class'
										},
										t: {
											price   : <?php echo $data['train']->tclassbase; ?>,
											classes : 'third-class', 
											category: 'Third Class'
										}
								},
								naming : {
									top : false,
									left: false,
									getLabel : function (character, row, column) {
										return firstSeatLabel++;
									},
								},
								legend : {
									node : $('#legend'),
								    items : [
										[ 'f', 'available',   'First Class' ],
										[ 's', 'available',   'Second Class'],
										[ 't', 'available',   'Third Class'],
										[ 'u', 'unavailable', 'Already Booked']
								    ]					
								},
								click: function () {

									// checkSeat(sc);

									if (this.status() == 'available') {
										//add to the cart
										$('<li>'+this.data().category+" Seat - <div class='selected-btn btn-s'><?php echo $data['compartmentNo']; ?>"+this.settings.label+'</div> : <b>Rs. '+this.data().price+'</b></li>')
											.attr('id', 'cart-item-'+this.settings.id)
											.data('seatId', this.settings.id)
											.appendTo($cart);

										
										var selectid = this.settings.id;
										var selectlabel = this.settings.label;
										var selectcomp = "<?php echo $data['compartmentNo']; ?>";
										var selectdate = "<?php echo $data['date']; ?>";
										var selecttrain = "<?php echo $data['trainId']; ?>";
										var selectclass = "<?php echo $data['class']; ?>";
										var selectresno = "<?php echo $data['resNo']; ?>";
								
										var selectprice = this.data().price;
										var selectcount = sc.find('selected').length+1+<?php echo $count; ?>;
										var selecttotal = recalculateTotal(sc)+this.data().price+<?php echo $price; ?>;
										$counter.text(selectcount);
										$total.text(selecttotal);

										$.ajax({
											url:"<?php echo URLROOT; ?>/passengerReservations/seatSelected",
											type:"POST",
											data: {'id':selectid, 'label':selectlabel, 'compartment':selectcomp, 'trainid':selecttrain, 'class':selectclass, 'resno':selectresno, 'date':selectdate, 'price':selectprice, 'total':selecttotal, 'count':selectcount},
											success: function(returndata){
												if(returndata==0){
													document.querySelector(".alert-btn").click();
													//update the status to unavailable 
													sc.get([selectid]).status('unavailable');
													//remove the item from our cart
													$('#cart-item-'+selectid).remove();
													//update the counter
													$counter.text(sc.find('selected').length);
													//and total
													$total.text(recalculateTotal(sc));
												}else{
													//Seat selected
													if(sc.find('selected').length+<?php echo $count; ?> == 1){
														const chkbtn = document.getElementById('checkoutBtn');
														chkbtn.disabled=false;
														chkbtn.style.cursor='pointer';
													}
												}
											},
											error: function(){
												alert('error');
											}
										});
										
									
										return 'selected';
										
									} else if (this.status() == 'selected') {

										var selectcount = sc.find('selected').length-1+<?php echo $count; ?>;
										var selecttotal = recalculateTotal(sc)-this.data().price+<?php echo $price; ?>;
										//update the counter
										$counter.text(selectcount);
										//and total
										$total.text(selecttotal);
										
										//remove the item from our cart
										$('#cart-item-'+this.settings.id).remove();

										var selectlabel = this.settings.label;
										var selectcomp = "<?php echo $data['compartmentNo']; ?>";
										var selecttrain = "<?php echo $data['trainId']; ?>";
										var selectdate = "<?php echo $data['date']; ?>";
										var selectresno = "<?php echo $data['resNo']; ?>";

										$.ajax({
											url:"<?php echo URLROOT; ?>/passengerReservations/seatVacated",
											type:"POST",
											data: {'label':selectlabel, 'compartment':selectcomp, 'trainid':selecttrain, 'date':selectdate, 'resno':selectresno, 'total':selecttotal, 'count':selectcount },
											success: function(returndata){
	
												if(sc.find('selected').length+<?php echo $count; ?> == 0){
														const chkbtn = document.getElementById('checkoutBtn');
														chkbtn.disabled=true;
														chkbtn.style.cursor='not-allowed';
												}
											},
											error: function(){
												alert('error');
											}
										});
									
										//seat has been vacated
										return 'available';
									} else if (this.status() == 'unavailable') {
										//seat has been already booked
										return 'unavailable';
									} else {
										return this.style();
									}
								}
								});					
							

							setInterval(function() {

								var selectcomp = "<?php echo $data['compartmentNo']; ?>";
								var selectdate = "<?php echo $data['date']; ?>";
								var selecttrain = "<?php echo $data['trainId']; ?>";
								var selectresno = "<?php echo $data['resNo']; ?>";


								$.ajax({
									type     : 'POST',
									url      : "<?php echo URLROOT; ?>/passengerReservations/findUnavailable",
									data: {'compartment':selectcomp, 'date':selectdate, 'trainid':selecttrain, 'resno':selectresno},
									dataType : 'json',
									success  : function(response) {
										
										//iterate through all bookings for our event 
										$.each(response['unavailable'], function(index, data) {
											//find seat by id and set its status to unavailable
											sc.status(data.seatId, 'unavailable');
											console.log(data.seatId);
										});

										$.each(response['deselected'], function(index, data) {
											//find seat by id and set its status to unavailable
											sc.status(data.seatId, 'available');
											console.log(data.seatId);
										});
									},
									error: function(){
										alert('error');
									}
								});
							}, 20000); //every 10 seconds


							//Find seats selected or booked by users from this train, compartment, date
							<?php foreach($data['unavailable'] AS $unavailable): ?>
									sc.get(['<?php echo $unavailable->seatId; ?>']).status('unavailable');
							<?php endforeach; ?>


							//Disable seats in this train, compartment
							<?php foreach($data['disabled'] AS $disabled): ?>
									sc.get(['<?php echo $disabled->seatId; ?>']).status('unavailable');
							<?php endforeach; ?>


							//Find seats previously selected from the same compartment by the same user and mark as selected 
							<?php foreach($data['selected'] AS $selected): ?>
								<?php if($selected->compartmentNo==$data['compartmentNo']): ?>
									sc.get(['<?php echo $selected->seatId; ?>']).status('selected');
								<?php else:  ?>
								
								<?php endif; ?>
							<?php endforeach; ?>

							//Add the previously selected seats(in the same compartment) to the cart and update the total
							sc.find('selected').each(function(seatId) {
								$('<li>'+this.data().category+" Seat - <div class='selected-btn btn-s'><?php echo $data['compartmentNo']; ?>"+this.settings.label+'</div> : <b>Rs. '+this.data().price+'</b> </li>')
											.attr('id', 'cart-item-'+this.settings.id)
											.data('seatId', this.settings.id)
											.appendTo($cart);
								$counter.text(sc.find('selected').length+0);
								$total.text(recalculateTotal(sc)+0);
							}); 

							$counter.text(sc.find('selected').length+<?php echo $count; ?>);
							$total.text(recalculateTotal(sc)+<?php echo $price; ?>);

							//To disable the proceed button if the customer has not selected seats
							if(sc.find('selected').length+<?php echo $count; ?> == 0){
								const chkbtn = document.getElementById('checkoutBtn');
								chkbtn.disabled=true;
								chkbtn.style.cursor='not-allowed';
							}

						});

						function recalculateTotal(sc) {
							var total = 0;
								
							//find every selected seat and sum its price
							sc.find('selected').each(function () {
								total += this.data().price;
							});
									
							return total;
						}
						
					</script>
					<!-- end of js for seat maps -->
						
				<br><br><br><br><br>		
				<button data-target="alert-info-popup" class="btn checkout-btn alert-btn2" type="button" href="#" id="checkoutBtn">BOOK NOW &raquo;</button>
				<p class="options" id="options-once">Cancel Reservations? <a data-target="alert-enquire-popup" class="alert-btn2" href="#">Click here.</a></p>
			</div>		
			<div class="content-row">
			</div>
			<div class="content-row">
			</div>	
			<div class="content-row">
			</div>
		</div>

		<button data-target="alert-warning-popup" class="alert-btn2 hidden-btn" type="button" id="time-alert-btn"></button>
		<button data-target="alert-error-popup" class="alert-btn2 hidden-btn" type="button" id="seat-error-btn"></button>

<!-- alert error pop up -->
	<div class="flash-alert-box" id="alert-error-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Seat Unavailable!</h3>
				<p>Sorry, this seat is not available</p>
				<p>Please select another seat</p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-enquire-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-question" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>You will lose progress if you continue</p>
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/removeReservation?resNo=<?php echo $data['resNo']; ?>'" class="proceed-btn">Proceed Anyway</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning popup -->

		<!-- alert info pop up -->
	<div class="flash-alert-box" id="alert-info-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-info" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure you want to proceed?</h3>
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/bookingReview?resNo=<?php echo $data['resNo']; ?>'" class="proceed-btn">Proceed</button>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert info popup -->

	<!-- alert warning2 pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Timeout Warning!</h3>
				<p>Your reservation will get cancelled in less than one minute!</p>
			</div>
			<button type="button" class="close-alert">&times;</button>
		</div>
	</div>
	<!-- end of alert warning2 popup -->

	<!-- train-details pop-up -->
	<div class="seat-map-popup" id="popup-1">
		<div class="seat-map-popup-overlay"></div>
		<div class="seat-map-popup-content">
			<div class="seat-map-popup-close" onclick="toggleSMPopup()">&times</div>
			<h3>Journey Details</h3>
			<p>Train ID: 1001</p>
			<p>Colombo - Badulla</p>
			<p>Intercity Express Train</p>
			<p><b>Denuwara Menike</b></p>
			<p><i class="fa fa-calendar-o" aria-hidden="true"></i> 20th June 2020</p>
			<p><i class="fa fa-clock-o" aria-hidden="true"></i> 6.30 AM -> 15.01 AM</p>
			<p><i class="fa fa-clock-o" aria-hidden="true"></i> 8 hrs 43 mins</p>
			<p>Train to Badulla</p>
		</div>
	</div>
	<!-- end of train-details pop up
 -->
	<!-- pop up -->
	<div class="bg-modal ">
		<div class="modal-content">
			<div class="close">+</div>
			<div class="notices-container">
			<div class="img-container">
					<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>  
			<h2 class="title">Journey Details</h2>
				<table class="content-table" id="details">
					<tbody>
						<tr>
							<td>
								<p>Train ID: <?php echo $data['train']->trainId; ?></p>
							</td>
						</tr>
						<tr>
							<td>
								<p><?php echo $data['train']->srcName; ?> - <?php echo $data['train']->destName; ?></p>
							</td>
						</tr>
						<tr>
							<td>
								<p><b><?php echo $data['train']->name; ?></b></p>
							</td>
						</tr>
						<tr>
							<td>
								<p><?php echo $data['train']->type; ?> Train</p>
							</td>
						</tr>
						<tr>
							<td>
								<p><i class="fa fa-calendar-o" aria-hidden="true"></i><?php echo $data['date']; ?></p>
							</td>
						</tr>
						<tr>
							<td>
								<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data['train']->starttime; ?> -> <?php echo $data['train']->endtime; ?></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end of pop up -->

	<!-- js for flash message -->
	<script>
		const alertBtn2 = document.querySelectorAll(".alert-btn2");
		alertBtn2.forEach(function(btn){
			btn.addEventListener("click", function(){
				const target = this.getAttribute("data-target");
				const alertBox = document.getElementById(target)
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
			});
		});

	</script>
	<!-- end of js for flash message -->

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

	<script>
		function refreshAt(hours, minutes, seconds) {
		    var now = new Date();
		    var then = new Date();

		    if(now.getHours() > hours ||
		       (now.getHours() == hours && now.getMinutes() > minutes) ||
		        now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() > seconds) {
		    	then.setDate(now.getDate() + 1);

		        //window.location.href='<?php echo URLROOT; ?>/passengerReservations/timeout?resNo=<?php echo $data['resNo']; ?>';
		    }
		    then.setHours(hours);
		    then.setMinutes(minutes);
		    then.setSeconds(seconds);

		    var timeout = (then.getTime() - now.getTime());

		    setTimeout(function() { 
		    	document.getElementById('time-alert-btn').click();
		    	const tm = document.getElementById('countdown');
		    	tm.style.backgroundColor = '#F39E82';
		    	tm.style.borderColor = '#F39E82';
		    }, timeout-60000);

		    setTimeout(function() { 
		    	window.location.href='<?php echo URLROOT; ?>/passengerReservations/timeout?resNo=<?php echo $data['resNo']; ?>';
		    }, timeout);
		}

		$(document).ready(function() { 
		   refreshAt(<?php echo date('H', strtotime($data['endTime'])); ?>,<?php echo date('i', strtotime($data['endTime'])); ?>,<?php echo date('s', strtotime($data['endTime'])); ?>);  
		});
	</script>


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>


