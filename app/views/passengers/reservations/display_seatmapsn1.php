<?php 

		
	isPassengerLoggedIn();
	require APPROOT . '/views/includes/passenger_head.php';
	require APPROOT . '/views/includes/passenger_navigation.php';
?>

<?php var_dump($_SESSION); ?> 

	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="map-container">
			<h1 class="title">SEAT MAP</h1>
			
			<div class="row">

				<div class="compartment-container">
				   	<h3>Select Compartment</h3>
				   	<div class='compartment-area'>
				   		<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="compartment active-comp" value="Wagon 1">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps2'" type="submit" class="compartment" value="Wagon 2">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps3'" type="submit" class="compartment" value="Wagon 3">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps4'" type="submit" class="compartment" value="Wagon 4">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps5'" type="submit" class="compartment" value="Wagon 5">
					   	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps6'" type="submit" class="compartment" value="Wagon 6">
				   	</div>
				   	<div class="seat-map-legend">
						<ul class="seat-map-legendList">
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat f-c"></div>
								<span class="seat-map-legendDescription">First Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat s-c"></div>
								<span class="seat-map-legendDescription">Second Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat t-c"></div>
								<span class="seat-map-legendDescription">Third Class</span>
							</li>
							<li class="seat-map-legendItem">
								<div class="seat-map-cell seat-map-seat unavailable"></div>
								<span class="seat-map-legendDescription">Unavailable</span>
							</li>
						</ul>
					</div>
			    </div>

			    <div class="seat-map-container">
					<h3>Wagon 1 - First Class</h3>
					<div class=front>
						Front
					</div>
					<div class="seat-map-compartment">
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">A</div>
							<div class="seat-map-cell seat-map-seat f-c">1</div>
							<div class="seat-map-cell seat-map-seat f-c">2</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">3</div>
							<div class="seat-map-cell seat-map-seat f-c">4</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">B</div>
							<div class="seat-map-cell seat-map-seat f-c">5</div>
							<div class="seat-map-cell seat-map-seat f-c">6</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">7</div>
							<div class="seat-map-cell seat-map-seat f-c">8</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">C</div>
							<div class="seat-map-cell seat-map-seat f-c">9</div>
							<div class="seat-map-cell seat-map-seat f-c">10</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">11</div>
							<div class="seat-map-cell seat-map-seat f-c">12</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">D</div>
							<div class="seat-map-cell seat-map-seat f-c">13</div>
							<div class="seat-map-cell seat-map-seat f-c">14</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">15</div>
							<div class="seat-map-cell seat-map-seat f-c">16</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">E</div>
							<div class="seat-map-cell seat-map-seat f-c">17</div>
							<div class="seat-map-cell seat-map-seat f-c">18</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">19</div>
							<div class="seat-map-cell seat-map-seat f-c">20</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">F</div>
							<div class="seat-map-cell seat-map-seat f-c unavailable">21</div>
							<div class="seat-map-cell seat-map-seat f-c">22</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">23</div>
							<div class="seat-map-cell seat-map-seat f-c">24</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">G</div>
							<div class="seat-map-cell seat-map-seat f-c">25</div>
							<div class="seat-map-cell seat-map-seat f-c">26</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">27</div>
							<div class="seat-map-cell seat-map-seat f-c">28</div>
						</div>
						<div class="seat-map-row">
							<div class="seat-map-cell seat-map-space">H</div>
							<div class="seat-map-cell seat-map-seat f-c">29</div>
							<div class="seat-map-cell seat-map-seat f-c">30</div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-space"></div>
							<div class="seat-map-cell seat-map-seat f-c">31</div>
							<div class="seat-map-cell seat-map-seat f-c">32</div>
						</div>
					</div>
				</div>
			</div>

			<div class="booking-details">
				<h3>Booking Details</h3>

				<div class="summary">
					<table class="content-table">
						<thead>
							<tr>
								<td>Type</td>
								<td>Seat Number</td>
								<td>Price</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td data-label="Type">First Class Seat</td>
								<td data-label="Seat No.">#21</td>
								<td data-label="Price">Rs. 1500.00</td>
								<td class="cancel-seat">Cancel</td>
							</tr>
							<tr>
								<td data-label="Type">First Class Seat</td>
								<td data-label="Seat No.">#21</td>
								<td data-label="Price">Rs. 1500.00</td>
								<td class="cancel-seat">Cancel</td>
							</tr>
							<tr>
								<td data-label="Type">First Class Seat</td>
								<td data-label="Seat No.">#21</td>
								<td data-label="Price">Rs. 1500.00</td>
								<td class="cancel-seat">Cancel</td>
							</tr>
							<tr class="highlight">
								<td>Selected Seats</td>
								<td></td>
								<td></td>
								<td>3</td>
							</tr>
							<tr class="highlight">
								<td>Total</td>
								<td></td>
								<td></td>
								<td>Rs. 4500.00</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/bookingReview'" class="btn checkout-btn">Book now &raquo;</button>
				<p class="options">Back to search results? <a class="alert-btn" data-target="alert-warning-popup">Click here.</a></p>
			<!-- <button type="submit" class="btn blue-btn checkout-btn">Back</button> -->
		</div>		
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>	
		<div class="content-row">
		</div>
		
	</div>

	<!-- alert warning pop up -->
	<div class="flash-alert-box" id="alert-warning-popup">
		<div class="alert-box-content">
			<div class="alert-icon">
				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			</div>
			<div class="alert-body">
				<h3>Are you sure?</h3>
				<p>You will lose your current progress</p>
				<!-- <p><a>Proceed Anyway?</a></p> -->
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displayTrains'" class="proceed-btn">Proceed Anyway</button>
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

	<!-- <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
	<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script>  -->

	
<!-- <script>
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
					],
					seats: {
						f: {
							price   : 400,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 230,
							classes : 'second-class', //your custom CSS class
							category: 'Second Class'
						},
						t: {
							price   : 125,
							classes : 'third-class', //your custom CSS class
							category: 'Third Class'
						}					
					
					},
					naming : {
						top : false,
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
							[ 'f', 'unavailable', 'Already Booked']
					    ]					
					},
					click: function () {
						if (this.status() == 'available') {
							//let's create a new <li> which we'll add to the cart items
							$('<li>'+this.data().category+' Seat # '+this.settings.label+': <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
								.attr('id', 'cart-item-'+this.settings.id)
								.data('seatId', this.settings.id)
								.appendTo($cart);
							
							/*
							 * Lets update the counter and total
							 *
							 * .find function will not find the current seat, because it will change its stauts only after return
							 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
							 */
							$counter.text(sc.find('selected').length+1);
							$total.text(recalculateTotal(sc)+this.data().price);
							
							return 'selected';
						} else if (this.status() == 'selected') {
							//update the counter
							$counter.text(sc.find('selected').length-1);
							//and total
							$total.text(recalculateTotal(sc)-this.data().price);
						
							//remove the item from our cart
							$('#cart-item-'+this.settings.id).remove();
						
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

				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				sc.get(['1_2', '4_1', '7_1', '7_2']).status('unavailable');
		
		});

		function recalculateTotal(sc) {
			var total = 0;
		
			//basically find every selected seat and sum its price
			sc.find('selected').each(function () {
				total += this.data().price;
			});
			
			return total;
		}
		
		</script><script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script> --> 

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>