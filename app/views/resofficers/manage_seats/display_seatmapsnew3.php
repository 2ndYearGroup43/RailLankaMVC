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
			   			<a href="<?php echo URLROOT; ?>/ResOfficerManageSeats/search">Manage Seats</a>
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

				<div class="map-column left-map">
					<div class="tabs__sidebar" id="new_tabs_sidebar">
						<?php foreach ($data['compartments'] as $comp):?>

						<button onclick="location.href='<?php echo URLROOT; ?>/ResOfficerManageSeats/displaySeatMaps/<?php echo $comp->compartmentNo; ?>/<?php echo $data['resNo']; ?>/<?php echo $comp->trainId; ?>'" type="submit" class="tabs__button" ><span class="map-large">Compartment <?php echo $comp->compartmentNo; ?></span><span class="map-small"><?php echo $comp->compartmentNo; ?></span></button>
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
							<ul id="selected-seats">			
							</ul>
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
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt',
									'ttt_tt'
								],
								seats: {
										f: {
											price   : 2000,
											classes : 'first-class', 
											category: 'First Class'
										},
										s: {
											price   : 1000,
											classes : 'second-class', 
											category: 'Second Class'
										},
										t: {
											price   : 700,
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

								click: function () {

									// checkSeat(sc);

									if (this.status() == 'available') {
										
										var selectid = this.settings.id;
										var selectlabel = this.settings.label;
										var selectcomp = "<?php echo $data['compartmentNo']; ?>";
										var selecttrain = "<?php echo $data['trainId']; ?>";
										var selectclass = "<?php echo $data['class']; ?>";
										var selectresno = "<?php echo $data['resNo']; ?>";
								
										var selectprice = this.data().price;

										var selectcount = sc.find('selected').length+1+<?php echo $count; ?>;
										var selecttotal = recalculateTotal(sc)+this.data().price+<?php echo $price; ?>;
										$counter.text(selectcount);
										$total.text(selecttotal);

										$.ajax({
											url:"<?php echo URLROOT; ?>/ResOfficerManageSeats/seatSelected",
											type:"POST",
											data: {'id':selectid, 'label':selectlabel, 'compartment':selectcomp, 'trainId':selecttrain, 'class':selectclass, 'resno':selectresno, 'price':selectprice, 'total':selecttotal, 'count':selectcount},
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
										
									} 
								}
							});

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
				<button onclick="location.href='<?php echo URLROOT; ?>/ResOfficers'" class="btn checkout-btn">Save &raquo;</button>
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

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>



