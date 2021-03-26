<?php
    require APPROOT . '/views/includes/passenger_head.php';
?>
<header>
	<div class=nav-container>
			<input type="checkbox" name="" id="check">
			<div class="logo-container">	
				<a href="index.html">
				<img src="<?php echo URLROOT ?>/public/img/logo.jpg" alt="logo" height="80px">
				</a>
			</div>	
			<div class="nav-btn">
			    <div class="nav-links">
			   	<ul>
			   		<li class="nav-link" style="--i: .6s">	
			   			<a href="<?php echo URLROOT; ?>/pages/index">Home</a>
			   		</li>	
			   		<li class="nav-link" style="--i: .85s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservations/search">Reservation</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.1s" >	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund<i class="fa fa-caret-down"></i></a>
			   			<div class="nav-dropdown">
			   			    <ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/ResOfficerRefunds/refund">Refund<i class="fa fa-caret-down"></i></a>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>	
			   				<ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/ResOfficerRefundDetails/views">Refund Details</a>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>
			   			</div>
			   		</li>
			   		<li class="nav-link" style="--i: 1.35s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/search">Reservation Details</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.8s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerReservationDetails/searchTicketDetails">Ticket Details</a>
			   		</li>
			   		<li class="nav-link" style="--i: 1.8s">	
			   			<a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/search">Manage Seats<i class="fa fa-caret-down"></i></a>
			   			<div class="nav-dropdown">
			   			    <ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/search">Manage Seats<i class="fa fa-caret-down"></i></a>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>	
			   				<ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/viewDisabledSeats">Seat Details</a>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>
			   			</div>
			   		</li>
			   		<?php if(isset($_SESSION['userid'])) : ?>
			   		<li class="nav-link" style="--i: 2.05s">	
			   			<a href="<?php echo URLROOT; ?>/resofficers/resofficerAccount">Account <i class="fa fa-caret-down"></i></a>
			   			<div class="nav-dropdown">
			   			    <ul>
			   					<li class="nav-dropdown-link">	
			   						<a href="<?php echo URLROOT; ?>/resofficers/resofficerAccount">Account <i class="fa fa-caret-down"></i></a>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>	
			   				<ul>
			   					<li class="nav-dropdown-link">	
			   						<?php if(isset($_SESSION['userid'])) : ?>
									<a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
									<?php else : ?>
									<a href="<?php echo URLROOT; ?>/users/login">Log In</a>	
									<?php endif; ?>
			   					</li>	
			   					<div class="arrow">	</div>
			   				</ul>
			   			</div>
			   		</li>
			   		<?php endif; ?>
			   	</ul>
			    </div>	
			</div>
			<div class="hamburger-menu-container">
				<div class="hamburger-menu">
						<div>	</div>	
				</div>	
			</div>
		</div>
	</header>

	<div class="body-section">
		<div class="content-row">
		</div>
		<!-- <div class="content-row">
		</div> -->
		<div class="map-container2">
			
			<h1 class="title">Seat Map</h1>
			<!-- <div class="tooltip"> -->

			<button onclick="toggleSMPopup()" class="details-tooltip">Journey Details <i class="fa fa-train"></i></button>

				<div class="map-column left-map">
					<div class="tabs__sidebar" id="new_tabs_sidebar">
						<?php foreach ($data['compartments'] as $comp):?>

						<button onclick="location.href='<?php echo URLROOT; ?>/ResOfficerReservations/displaySeatMaps/<?php echo $comp->compartmentNo; ?>/<?php echo $data['resNo']; ?>/<?php echo $data['train']->trainId; ?>/<?php echo $data['uPassenger']->uPassenger_id; ?>'" type="submit" class="tabs__button" ><span class="map-large">Compartment <?php echo $comp->compartmentNo; ?></span><span class="map-small"><?php echo $comp->compartmentNo; ?></span></button> 

						<?php endforeach; ?>
					</div>
				</div>

				<div class="map-column center-map">
						<center><h3 class="comp-name">Compartment <?php echo $data['compartmentNo']; ?> -  <?php echo $data['class']; ?></h3></center>
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
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff',
									'ff__ff'

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
										$('<li>'+this.data().category+" Seat - <div class='selected-btn btn-f'><?php echo $data['compartmentNo']; ?>"+this.settings.label+'</div> : <b>Rs. '+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
											url:"<?php echo URLROOT; ?>/ResOfficerReservations/seatSelected",
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
													//alert(returndata);

                                                    if(sc.find('selected').length+<?php echo $count; ?> == 1){
														const chkbtn = document.getElementById('checkoutBtn');
														chkbtn.disabled=false;
														chkbtn.style.cursor='pointer';
													} 

												}
											},
											error: function(){
												//alert('error');
											},
											beforeSend: function(){
												//alert("Alert showing before AJAX call");
											},
											complete: function(){
												//alert("Alert showing after AJAX call completion");
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
											url:"<?php echo URLROOT; ?>/ResOfficerReservations/seatVacated",
											type:"POST",
											data: {'label':selectlabel, 'compartment':selectcomp, 'trainid':selecttrain, 'date':selectdate, 'resno':selectresno, 'total':selecttotal, 'count':selectcount },
											success: function(returndata){
												//alert(returndata);
													if(sc.find('selected').length+<?php echo $count; ?> == 0){
														const chkbtn = document.getElementById('checkoutBtn');
														chkbtn.disabled=true;
														chkbtn.style.cursor='not-allowed';
													} 
											},
											error: function(){
												//alert('error');
											},
											beforeSend: function(){
												//alert("Alert showing before AJAX call");
											},
											complete: function(){
												//alert("Alert showing after AJAX call completion");
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
									url      : "<?php echo URLROOT; ?>/ResOfficerReservations/findUnavailable",
									data: {'compartment':selectcomp, 'date':selectdate, 'trainid':selecttrain, 'resno':selectresno},
									dataType : 'json',
									success  : function(response) {
										console.log(response);
										console.log(response['unavailable']);
										console.log(response['deselected']);

										
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
										//alert('error');
									}
								});
							}, 20000); //every 10 seconds


							//handle "[cancel]" link clicks
							$('#selected-seats').on('click', '.cancel-cart-item', function () {
								sc.get($(this).parents('li:first').data('seatId')).click();
							});


							//Find seats selected or booked by users from this train, compartment, date
							<?php foreach($data['unavailable'] AS $unavailable): ?>
									sc.get(['<?php echo $unavailable->seatId; ?>']).status('unavailable');
							<?php endforeach; ?>
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
								$('<li>'+this.data().category+" Seat - <div class='selected-btn btn-f'><?php echo $data['compartmentNo']; ?>"+this.settings.label+'</div> : <b>Rs. '+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
											.attr('id', 'cart-item-'+this.settings.id)
											.data('seatId', this.settings.id)
											.appendTo($cart);
								$counter.text(sc.find('selected').length+0);
								$total.text(recalculateTotal(sc)+0);
							}); 

							$counter.text(sc.find('selected').length+<?php echo $count; ?>);
							$total.text(recalculateTotal(sc)+<?php echo $price; ?>);

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
						}
				<br><br><br><br><br>		
				<button onclick="location.href='<?php echo URLROOT; ?>/ResOfficerReservations/createTicket/<?php echo $data['resNo']; ?>//<?php echo $data['uPassenger']->uPassenger_id; ?>'" class="btn checkout-btn" id="checkoutBtn" >BOOK NOW &raquo;</button>
				<p class="options" id="options-once">Back to search results? <a data-target="alert-warning-popup" class="alert-btn" href="#">Click here.</a></p>
			</div>		
			<div class="content-row">
			</div>
			<div class="content-row">
			</div>	
			<div class="content-row">
			</div>
		</div>

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

	<!-- train-details pop-up -->
	<div class="seat-map-popup" id="popup-1">
		<div class="seat-map-popup-overlay"></div>
		<div class="seat-map-popup-content">
			<div class="seat-map-popup-close" onclick="toggleSMPopup()">&times</div>
			<h3>Journey Details</h3>
			<p>Train ID: <?php echo $data['train']->trainId; ?></p>
			<p><?php echo $data['train']->srcName; ?> - <?php echo $data['train']->destName; ?></p>
			<p><?php echo $data['train']->type; ?> Train</p>
			<p><b><?php echo $data['train']->name; ?></b></p>
			<p><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo $data['reservation']->journeyDate; ?></p>
			<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data['train']->starttime; ?> -> <?php echo $data['train']->endtime; ?></p>
			<p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $data['duration']->format('%h hour(s) %i minute(s)'); ?></p>
			<p>Train to <?php echo $data['train']->destName; ?></p>
		</div>
	</div>
	<!-- end of train-details pop up
 -->
	<!-- js for flash message -->
	<script>
		const alertBtn = document.querySelectorAll(".alert-btn");
		alertBtn.forEach(function(btn){
			btn.addEventListener("click", function(){
				// const target = this.getAttribute("data-target");
				const alertBox = document.getElementById("alert-error-popup")
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

	<!-- js for train details popup -->
	<script>
		function toggleSMPopup(){
			document.getElementById("popup-1").classList.toggle("seat-map-popup-active");
		}
	</script>
	<!-- end of js for train details popup -->

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>