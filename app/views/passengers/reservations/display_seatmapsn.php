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
		<div class="map-container2">
			
			<h1 class="title">Seat Map</h1>

			<div class="tabs">
				<div class="tabs__sidebar">
					<button class="tabs__button" data-for-tab="1">Wagon 1</button>
					<button class="tabs__button" data-for-tab="2">Wagon 2</button>
					<button class="tabs__button" data-for-tab="3">Wagon 3</button>
					<button class="tabs__button" data-for-tab="4">Wagon 4</button>
					<button class="tabs__button" data-for-tab="5">Wagon 5</button>
					<button class="tabs__button" data-for-tab="6">Wagon 6</button>
				</div>
				<div class="tabs__content" data-tab="1">
					<div id="seat-map">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
				<div class="tabs__content" data-tab="2">
					<div id="seat-map2">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
				<div class="tabs__content" data-tab="3">
					<div id="seat-map3">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
				<div class="tabs__content" data-tab="4">
					<div id="seat-map4">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
				<div class="tabs__content" data-tab="5">
					<div id="seat-map5">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
				<div class="tabs__content" data-tab="6">
					<div id="seat-map6">
			      		<div class="front-indicator">Front</div>
			    	</div>
				</div>
			</div>

			<div class="booking-detailsn">
				<h2>Booking Details</h2>
				<h3> Selected Seats (<span id="counter">0</span>):</h3>
				<ul id="selected-seats">
				</ul>
				Total: <b>Rs.<span id="total">0</span></b>
				<!-- <button class="checkout-button">Checkout &raquo;</button> -->
				<div id="legend"></div>
			</div>

		</div>		
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>	
		<div class="content-row">
		</div>
	</div>

	<!-- js for tabs  -->
	<script>
		function setupTabs() {
			document.querySelectorAll(".tabs__button").forEach(button => {
				button.addEventListener("click", () => {
					const sideBar = button.parentElement;
					const tabsContainer = sideBar.parentElement;
					const tabNumber = button.dataset.forTab;
					const tabToActivate = tabsContainer.querySelector(`.tabs__content[data-tab="${tabNumber}"]`);

					// console.log(sideBar);
					// console.log(tabsContainer);
					// console.log(tabNumber);
					// console.log(tabToActivate);

					sideBar.querySelectorAll(".tabs__button").forEach(button => {
						button.classList.remove("tabs__button--active");
					});

					tabsContainer.querySelectorAll(".tabs__content").forEach(button => {
						button.classList.remove("tabs__content--active");
					});

					button.classList.add("tabs__button--active");
					tabToActivate.classList.add("tabs__content--active");
				});
			});
		}

		document.addEventListener("DOMContentLoaded", () => {
			setupTabs();

			document.querySelectorAll(".tabs").forEach(tabsContainer => {tabsContainer.querySelector(".tabs__sidebar .tabs__button").click();
			});
		});

	</script>
	<!-- end of js for tabs -->

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
					],
					seats: {
						f: {
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
							[ 'u', 'unavailable', 'Already Booked']
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


				sc2 = $('#seat-map2').seatCharts({
					map: [
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
					],
					seats: {
						f: {
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
					// legend : {
					// 	node : $('#legend'),
					//     items : [
					// 		[ 'f', 'available',   'First Class' ],
					// 		[ 's', 'available',   'Second Class'],
					// 		[ 't', 'available',   'Third Class'],
					// 		[ 'u', 'unavailable', 'Already Booked']
					//     ]					
					// },
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

				sc3 = $('#seat-map3').seatCharts({
					map: [
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
						'ss__ss',
					],
					seats: {
						f: {
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
					// legend : {
					// 	node : $('#legend'),
					//     items : [
					// 		[ 'f', 'available',   'First Class' ],
					// 		[ 's', 'available',   'Second Class'],
					// 		[ 't', 'available',   'Third Class'],
					// 		[ 'u', 'unavailable', 'Already Booked']
					//     ]					
					// },
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

				sc4 = $('#seat-map4').seatCharts({
					map: [
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
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
					// legend : {
					// 	node : $('#legend'),
					//     items : [
					// 		[ 'f', 'available',   'First Class' ],
					// 		[ 's', 'available',   'Second Class'],
					// 		[ 't', 'available',   'Third Class'],
					// 		[ 'u', 'unavailable', 'Already Booked']
					//     ]					
					// },
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

				sc5 = $('#seat-map5').seatCharts({
					map: [
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
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
					// legend : {
					// 	node : $('#legend'),
					//     items : [
					// 		[ 'f', 'available',   'First Class' ],
					// 		[ 's', 'available',   'Second Class'],
					// 		[ 't', 'available',   'Third Class'],
					// 		[ 'u', 'unavailable', 'Already Booked']
					//     ]					
					// },
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

				sc6 = $('#seat-map6').seatCharts({
					map: [
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
							price   : 1000,
							classes : 'first-class', //your custom CSS class
							category: 'First Class'
						},
						s: {
							price   : 250,
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
					// legend : {
					// 	node : $('#legend'),
					//     items : [
					// 		[ 'f', 'available',   'First Class' ],
					// 		[ 's', 'available',   'Second Class'],
					// 		[ 't', 'available',   'Third Class'],
					// 		[ 'u', 'unavailable', 'Already Booked']
					//     ]					
					// },
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
					sc2.get($(this).parents('li:first').data('seatId')).click();
					sc3.get($(this).parents('li:first').data('seatId')).click();
					sc4.get($(this).parents('li:first').data('seatId')).click();
					sc5.get($(this).parents('li:first').data('seatId')).click();
					sc6.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				sc.get(['1_2', '7_1', '7_2']).status('unavailable');
				sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
				sc3.get(['3_2']).status('unavailable');
				sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
				sc5.get(['5_1', '5_3']).status('unavailable');
				sc6.get(['2_5']).status('unavailable');
		
			});

			function recalculateTotal(sc) {
				var total = 0;
			
				//basically find every selected seat and sum its price
				sc.find('selected').each(function () {
					total += this.data().price;
				});

				sc2.find('selected').each(function () {
					total += this.data().price;
				});

				sc3.find('selected').each(function () {
					total += this.data().price;
				});

				sc4.find('selected').each(function () {
					total += this.data().price;
				});

				sc5.find('selected').each(function () {
					total += this.data().price;
				});

				sc6.find('selected').each(function () {
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
	<!-- end of js for seat maps -->


<?php require APPROOT . '/views/includes/footer.php'; ?>