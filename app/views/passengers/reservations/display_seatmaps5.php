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

<?php var_dump($_SESSION); ?> 

	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="map-container">
			<!-- <div class="wrapper"> -->
			  	<div class="seat-map-container">
			  		<h1 class="title">Seat Map</h1>
			  		<div class="compartment-container">
				    	<h2>Select Compartment</h2>
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps'" type="submit" class="compartment" value="wagon 1">
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps2'" type="submit" class="compartment" value="wagon 2">
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps3'" type="submit" class="compartment" value="wagon 3">
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps4'" type="submit" class="compartment" value="wagon 4">
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps5'" type="submit" class="compartment active-comp" value="wagon 5">
				    	<input onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displaySeatMaps6'" type="submit" class="compartment" value="wagon 6">
				    </div>
			    	<div id="seat-map">
			      		<div class="front-indicator">Front</div>
			    	</div>   
				    <!-- <div class="details-container"> -->
					    <div class="booking-details">
					      	<h2>Booking Details</h2>
					      	<h3> Selected Seats (<span id="counter">0</span>):</h3>
					      	<ul id="selected-seats">
					      	</ul>
					      	Total: <b>$<span id="total">0</span></b>
					      	<!-- <button class="checkout-button">Checkout &raquo;</button> -->
					      	<div id="legend"></div>
					    </div>
					<!-- </div> -->
				<!-- </div> -->
			</div>
			<button class="btn checkout-btn">Book now &raquo;</button>
			<p class="options">Back to search results? <a href="<?php echo URLROOT; ?>/passengerReservations/displayTrains">Click here.</a></p>
			<!-- <button onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/displayTrains'" type="submit" class="btn blue-btn back-btn">Back</button> -->
		</div>		
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>	
		<div class="content-row">
		</div>
	</div>

	<!-- <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
	<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script>  -->

 <!--  js for toggle menu -->
	<script>
		var menuItems = document.getElementById("menuItems");
		menuItems.style.maxHeight = "0px"
		function menutoggle(){
			if(menuItems.style.maxHeight == "0px"){
				menuItems.style.maxHeight = "360px";
			}
			else{
				menuItems.style.maxHeight = "0px";
			}
		}
	</script>

	<script>
		var menuItems = document.getElementById("menuItems");
		menuItems.style.maxHeight = "0px"
		function menutoggle(){
			if(menuItems.style.maxHeight == "0px"){
				menuItems.style.maxHeight = "360px";
			}
			else{
				menuItems.style.maxHeight = "0px";
			}
		}
</script>
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

</script>

<?php require APPROOT . '/views/includes/footer.php'; ?>