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

<!--live train -->
	<div class="body-section">
		<div class="content-row">
		</div>
		<div class="content-row">
		</div>
		<div class="table-container">
			<div class="img-container">
				<img src="<?php echo URLROOT ?>/public/img/logoc.jpg">
			</div>
			<h1 class="title">Live Train Location</h1>
				<table class="content-table">
					<thead>
						<tr>
							<th>From</th>
							<th>To</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Type</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="From">Colombo Fort</td>
							<td data-label="To">Kandy</td>
							<td data-label="Dept. Time">7.00 a.m.</td>
							<td data-label="Arrival Time">9.38 a.m.</td>
							<td data-label="Type">A.C.- Intercity</td>
						</tr>
					</tbody>
				</table>
				<div id="map"></div>
			<!-- </div> -->
				<button onclick="location.href='<?php echo URLROOT; ?>/passengerTrackings/displayTrains'" type="submit" class="btn blue-btn back-btn">Back</button>
		</div>
		     <script>
                    function initMap(){
                        // var cities =[['Colombo Fort',6.933924, 79.850026, 1],['Kandy',7.289776, 80.632347, 2]];
                        var colombo = {lat: 6.933924,lng: 79.850026}; 
                        var kandy = {lat: 7.289776,lng: 80.632347}; 
                        // 6.933924, 79.850026 Colombo Fort station location
                        // 7.289776, 80.632347 Kandy Station location
                        var map = new google.maps.Map(document.getElementById('map'),{
                            zoom: 15,
                            center: colombo
                        });
                        var marker1 = new google.maps.Marker({
                            position: colombo,
                            map: map,
                            title: "Colombo-fort"
                        });
                        // var marker2 = new google.maps.Marker({
                        //     position: kandy,
                        //     map: map,
                        //     title: "kandy"
                        // });
                    }
                </script>
                    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                    type="text/javascript"></script>
             <!-- <button type="submit" class="btn red-btn back-btn">Back</button> -->
       	<div class="content-row">
       		<!--  <button type="submit" class="back-btn">Back</button> -->
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of live train -->
	
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

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>