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
			<!-- <center><p>	Train ID : 1001</p></center>
			<center><p>	Colombo - Badulla </p></center> -->

			<div class="tabs">
				<div class="tabs__sidebar">
					<button class="tabs__button" data-for-tab="1"><span class="map-large">Compartment A</span><span class="map-small">A</span></button>
					<button class="tabs__button" data-for-tab="2"><span class="map-large">Compartment B</span><span class="map-small">B</span></button>
					<button class="tabs__button" data-for-tab="3"><span class="map-large">Compartment C</span><span class="map-small">C</span></button>
					<button class="tabs__button" data-for-tab="4"><span class="map-large">Compartment D</span><span class="map-small">D</span></button>
					<button class="tabs__button" data-for-tab="5"><span class="map-large">Compartment E</span><span class="map-small">E</span></button>
					<button class="tabs__button" data-for-tab="6"><span class="map-large">Compartment F</span><span class="map-small">F</span></button>
					<button class="tabs__button" data-for-tab="7"><span class="map-large">Compartment G</span><span class="map-small">G</span></button>
					<button class="tabs__button" data-for-tab="8"><span class="map-large">Compartment H</span><span class="map-small">H</span></button>
				</div>
				<div class="tabs__content" data-tab="1">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment A - First Class</h3></center>
						<div id="seat-map">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter">0</span>):</h4>
							<ul id="selected-seats">
							</ul>
							Total: <b>Rs.<span id="total">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
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
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								if (this.status() == 'available') {
									//let's create a new <li> which we'll add to the cart items
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>A"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						sc.get(['1_2', '7_1', '7_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>

				<div class="tabs__content" data-tab="2">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment B - First Class</h3></center>
						<div id="seat-map2">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter2">0</span>):</h4>
							<ul id="selected-seats2">
							</ul>
							Total: <b>Rs.<span id="total2">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend2"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats2'),
									$counter = $('#counter2'),
									$total = $('#total2'),
									sc = $('#seat-map2').seatCharts({
									map: [
										'f[12_1,1]f[12_2,2]__f[12_5,3]f[12_6,4]',
										'f[13_1,5]f[13_2,6]__f[13_5,7]f[13_6,8]',
										'f[14_1,9]f[14_2,10]__f[14_5,11]f[14_6,12]',
										'f[15_1,13]f[15_2,14]__f[15_5,15]f[15_6,16]',
										'f[16_1,17]f[16_2,18]__f[16_5,19]f[16_6,20]',
										'f[17_1,21]f[17_2,22]__f[17_5,23]f[17_6,24]',
										'f[18_1,25]f[18_2,26]__f[18_5,27]f[18_6,28]',
										'f[19_1,29]f[19_2,30]__f[19_5,31]f[19_6,32]',
										'f[20_1,33]f[20_2,34]__f[20_5,35]f[20_6,36]',
										'f[21_1,37]f[21_2,38]__f[21_5,39]f[21_6,40]',
										'f[22_1,41]f[22_2,42]__f[22_5,43]f[22_6,44]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend2'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>B"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats2').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						// sc.get(['1_2', '7_1', '7_2']).status('unavailable');
						sc.get(['12_1', '12_2', '18_5', '19_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
				<div class="tabs__content" data-tab="3">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment C - Second Class</h3></center>
						<div id="seat-map3">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter3">0</span>):</h4>
							<ul id="selected-seats3">
							</ul>
							Total: <b>Rs.<span id="total3">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend3"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats3'),
									$counter = $('#counter3'),
									$total = $('#total3'),
									sc = $('#seat-map3').seatCharts({
									map: [
										's[23_1,1]s[23_2,2]__s[23_5,3]s[23_6,4]',
										's[24_1,5]s[24_2,6]__s[24_5,7]s[24_6,8]',
										's[25_1,9]s[25_2,10]__s[25_5,11]s[25_6,12]',
										's[26_1,13]s[26_2,14]__s[26_5,15]s[26_6,16]',
										's[27_1,17]s[27_2,18]__s[27_5,19]s[27_6,20]',
										's[28_1,21]s[28_2,22]__s[28_5,23]s[28_6,24]',
										's[29_1,25]s[29_2,26]__s[29_5,27]s[29_6,28]',
										's[30_1,29]s[30_2,30]__s[30_5,31]s[30_6,32]',
										's[31_1,33]s[31_2,34]__s[31_5,35]s[31_6,36]',
										's[32_1,37]s[32_2,38]__s[32_5,39]s[32_6,40]',
										's[33_1,41]s[33_2,42]__s[33_5,43]s[33_6,44]',
										's[34_1,45]s[34_2,46]__s[34_5,47]s[34_6,48]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
												category: 'Third Class'
											}
										},
							naming : {
								top : false,
								left : false,
								getLabel : function (character, row, column) {
									return firstSeatLabel++;
								},
							},
							legend : {
								node : $('#legend3'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>C"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats3').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						// sc.get(['1_2', '7_1', '7_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						sc.get(['33_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
				<div class="tabs__content" data-tab="4">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment D - Second Class</h3></center>
						<div id="seat-map4">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter4">0</span>):</h4>
							<ul id="selected-seats4">
							</ul>
							Total: <b>Rs.<span id="total4">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend4"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats4'),
									$counter = $('#counter4'),
									$total = $('#total4'),
									sc = $('#seat-map4').seatCharts({
									map: [
										's[35_1,1]s[35_2,2]__s[35_5,3]s[35_6,4]',
										's[36_1,5]s[36_2,6]__s[36_5,7]s[36_6,8]',
										's[37_1,9]s[37_2,10]__s[37_5,11]s[37_6,12]',
										's[38_1,13]s[38_2,14]__s[38_5,15]s[38_6,16]',
										's[39_1,17]s[39_2,18]__s[39_5,19]s[39_6,20]',
										's[40_1,21]s[40_2,22]__s[40_5,23]s[40_6,24]',
										's[41_1,25]s[41_2,26]__s[41_5,27]s[41_6,28]',
										's[42_1,29]s[42_2,30]__s[42_5,31]s[42_6,32]',
										's[43_1,33]s[43_2,34]__s[43_5,35]s[43_6,36]',
										's[44_1,37]s[44_2,38]__s[44_5,39]s[44_6,40]',
										's[45_1,41]s[45_2,42]__s[45_5,43]s[45_6,44]',
										's[46_1,45]s[46_2,46]__s[46_5,47]s[46_6,48]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend4'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>D"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats4').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						// sc.get(['1_2', '7_1', '7_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						sc.get(['36_1', '36_2', '40_5', '41_6']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
				<div class="tabs__content" data-tab="5">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment E - Second Class</h3></center>
						<div id="seat-map5">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter5">0</span>):</h4>
							<ul id="selected-seats5">
							</ul>
							Total: <b>Rs.<span id="total5">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend5"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel =1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats5'),
									$counter = $('#counter5'),
									$total = $('#total5'),
									sc = $('#seat-map5').seatCharts({
									map: [
										's[47_1,1]s[47_2,2]__s[47_5,3]s[47_6,4]',
										's[48_1,5]s[48_2,6]__s[48_5,7]s[48_6,8]',
										's[49_1,9]s[49_2,10]__s[49_5,11]s[49_6,12]',
										's[50_1,13]s[50_2,14]__s[50_5,15]s[50_6,16]',
										's[51_1,17]s[51_2,18]__s[51_5,19]s[51_6,20]',
										's[52_1,21]s[52_2,22]__s[52_5,23]s[52_6,24]',
										's[53_1,25]s[53_2,26]__s[53_5,27]s[53_6,28]',
										's[54_1,29]s[54_2,30]__s[54_5,31]s[54_6,32]',
										's[55_1,33]s[55_2,34]__s[55_5,35]s[55_6,36]',
										's[56_1,37]s[56_2,38]__s[56_5,39]s[56_6,40]',
										's[57_1,41]s[57_2,42]__s[57_5,43]s[57_6,44]',
										's[58_1,45]s[58_2,46]__s[58_5,47]s[58_6,48]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend5'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>E"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats5').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						// sc.get(['1_2', '7_1', '7_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						sc.get(['49_1', '49_5']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
				<div class="tabs__content" data-tab="6">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment F - Second Class</h3></center>
						<div id="seat-map6">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter6">0</span>):</h4>
							<ul id="selected-seats6">
							</ul>
							Total: <b>Rs.<span id="total6">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend6"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats6'),
									$counter = $('#counter6'),
									$total = $('#total6'),
									sc = $('#seat-map6').seatCharts({
									map: [
										's[59_1,1]s[59_2,2]__s[59_5,3]s[59_6,4]',
										's[60_1,5]s[60_2,6]__s[60_5,7]s[60_6,8]',
										's[61_1,9]s[61_2,10]__s[61_5,11]s[61_6,12]',
										's[62_1,13]s[62_2,14]__s[62_5,15]s[62_6,16]',
										's[63_1,17]s[63_2,18]__s[63_5,19]s[63_6,20]',
										's[64_1,21]s[64_2,22]__s[64_5,23]s[64_6,24]',
										's[65_1,25]s[65_2,26]__s[65_5,27]s[65_6,28]',
										's[66_1,29]s[66_2,30]__s[66_5,31]s[66_6,32]',
										's[67_1,33]s[67_2,34]__s[67_5,35]s[67_6,36]',
										's[68_1,37]s[68_2,38]__s[68_5,39]s[68_6,40]',
										's[69_1,41]s[69_2,42]__s[69_5,43]s[69_6,44]',
										's[70_1,45]s[70_2,46]__s[70_5,47]s[70_6,48]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend6'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>F"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats6').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						sc.get(['59_2', '68_1', '68_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>

				<div class="tabs__content" data-tab="7">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment G - Third Class</h3></center>
						<div id="seat-map7">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter7">0</span>):</h4>
							<ul id="selected-seats7">
							</ul>
							Total: <b>Rs.<span id="total7">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend7"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats7'),
									$counter = $('#counter7'),
									$total = $('#total7'),
									sc = $('#seat-map7').seatCharts({
									map: [
										't[71_1,1]t[71_2,2]t[71_3,3]_t[71_5,4]t[71_6,5]',
										't[72_1,6]t[72_2,7]t[72_3,8]_t[72_5,9]t[72_6,10]',
										't[73_1,11]t[73_2,12]t[73_3,13]_t[73_5,14]t[73_6,15]',
										't[74_1,16]t[74_2,17]t[74_3,18]_t[74_5,19]t[74_6,20]',
										't[75_1,21]t[75_2,22]t[75_3,23]_t[75_5,24]t[75_6,25]',
										't[76_1,26]t[76_2,27]t[76_3,28]_t[76_5,29]t[76_6,30]',
										't[77_1,31]t[77_2,32]t[77_3,33]_t[77_5,34]t[77_6,35]',
										't[78_1,36]t[78_2,37]t[78_3,38]_t[78_5,39]t[78_6,40]',
										't[79_1,41]t[79_2,42]t[79_3,43]_t[79_5,44]t[79_6,45]',
										't[80_1,46]t[80_2,47]t[80_3,48]_t[80_5,49]t[80_6,50]',
										't[81_1,51]t[81_2,52]t[81_3,53]_t[81_5,54]t[81_6,55]',
										't[82_1,56]t[82_2,57]t[82_3,58]_t[82_5,59]t[82_6,60]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend7'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>G"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats7').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						sc.get(['71_2', '78_1', '78_2']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
				<div class="tabs__content" data-tab="8">
					<div class="left-map">
						<center><h3 class="comp-name">Compartment H - Third Class</h3></center>
						<div id="seat-map8">
				      		<div class="front-indicator">Front</div>
				    	</div>
					</div>
			    	<div class="right-map">
						<div class="booking-detailsn">
							<h2>Booking Details</h2>
							<h4> Selected Seats (<span id="counter8">0</span>):</h4>
							<ul id="selected-seats8">
							</ul>
							Total: <b>Rs.<span id="total8">0</span></b>	
						</div>
							<!-- <button class="checkout-button">Checkout &raquo;</button> -->
						<div id="legend8"></div>

			    	</div>

			    	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
					<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

					<!-- js for seat map -->

					<script>		
							var firstSeatLabel = 1;
				
							$(document).ready(function() {
								var $cart = $('#selected-seats8'),
									$counter = $('#counter8'),
									$total = $('#total8'),
									sc = $('#seat-map8').seatCharts({
									map: [
										't[83_1,1]t[83_2,2]t[83_3,3]_t[83_5,4]t[83_6,5]',
										't[84_1,6]t[84_2,7]t[84_3,8]_t[84_5,9]t[84_6,10]',
										't[85_1,11]t[85_2,12]t[85_3,13]_t[85_5,14]t[85_6,15]',
										't[86_1,16]t[86_2,17]t[86_3,18]_t[86_5,19]t[86_6,20]',
										't[87_1,21]t[87_2,22]t[87_3,23]_t[87_5,24]t[87_6,25]',
										't[88_1,26]t[88_2,27]t[88_3,28]_t[88_5,29]t[88_6,30]',
										't[89_1,31]t[89_2,32]t[89_3,33]_t[89_5,34]t[89_6,35]',
										't[90_1,36]t[90_2,37]t[90_3,38]_t[90_5,39]t[90_6,40]',
										't[91_1,41]t[91_2,42]t[91_3,43]_t[91_5,44]t[91_6,45]',
										't[92_1,46]t[92_2,47]t[92_3,48]_t[92_5,49]t[92_6,50]',
										't[93_1,51]t[93_2,52]t[93_3,53]_t[93_5,54]t[93_6,55]',
										't[94_1,56]t[94_2,57]t[94_3,58]_t[94_5,59]t[94_6,60]'
									],
									seats: {
											f: {
												price   : 1700,
												classes : 'first-class', //your custom CSS class
												category: 'First Class'
											},
											s: {
												price   : 1000,
												classes : 'second-class', //your custom CSS class
												category: 'Second Class'
											},
											t: {
												price   : 700,
												classes : 'third-class', //your custom CSS class
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
								node : $('#legend8'),
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
									$('<li>'+this.data().category+" Seat - <div class='selected-btn'>H"+this.settings.label+'</div> : <b>$'+this.data().price+'</b> <a href="#" class="cancel-cart-item"><i class="fa fa-times"></i></a></li>')
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
						$('#selected-seats8').on('click', '.cancel-cart-item', function () {
							//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
							sc.get($(this).parents('li:first').data('seatId')).click();
						});

						//let's pretend some seats have already been booked
						sc.get(['83_2', '83_1', '84_5']).status('unavailable');
						// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
						// sc3.get(['3_2']).status('unavailable');
						// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
						// sc5.get(['5_1', '5_3']).status('unavailable');
						// sc6.get(['2_5']).status('unavailable');
				
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
			<!-- end of js for seat maps -->
				</div>
			</div>

			<br><br><br><br><br>		
			<button id="options-once" onclick="location.href='<?php echo URLROOT; ?>/passengerReservations/bookingReview'" class="btn checkout-btn">BOOK NOW &raquo;</button>
			<p class="options" id="options-once">Back to search results? <a href="<?php echo URLROOT; ?>/passengerReservations/displayTrains">Click here.</a></p>
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
<!-- 
	<script src="http://code.jquery.com/jquery-1.12.4.min.js"></script> 
	<script src="<?php echo URLROOT ?>/public/javascript/jquery.seat-charts.js"></script> 

	 js for seat map -->

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


				//this will handle "[cancel]" link clicks
				$('#selected-seats').on('click', '.cancel-cart-item', function () {
					//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
					sc.get($(this).parents('li:first').data('seatId')).click();
				});

				//let's pretend some seats have already been booked
				sc.get(['1_2', '7_1', '7_2']).status('unavailable');
				// sc2.get(['2_1', '2_2', '4_5', '4_6']).status('unavailable');
				// sc3.get(['3_2']).status('unavailable');
				// sc4.get(['2_1', '2_2', '2_3', '5_5']).status('unavailable');
				// sc5.get(['5_1', '5_3']).status('unavailable');
				// sc6.get(['2_5']).status('unavailable');
		
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
	<!-- end of js for seat maps -->


<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>