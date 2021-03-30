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
	<script>
        const markerIconBase='http://maps.google.com/mapfiles/kml/paddle/';
        const icons={
            live: {
                iconPath: markerIconBase+'grn-blank.png'
            },
            stopped: {
                iconPath: markerIconBase+'orange-blank.png'
            },
            ended: {
                iconPath: markerIconBase+'pink-blank.png'
            }
        }
    </script>

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
			<h1 class="LocStatus" id="LocStatus"></h1>
            <h3 class="redNotice" id="redNotice">
                <?php if( !$data['journey']){
                    echo "Train seemed to have reached it's destination.";
                }
                else if($data['journey']->journey_status=='Ended'){
                    echo "Train seemed to have reached it's destination.";
                }?>
            </h3>
            <div class="date-time" id="date-time">
                <h4 style="float: right; color: #13406d" >Date: <span id="curr-date">  </span> Time: <span id="curr-time"></span></h4>
            </div>
            <script>
                var dt = new Date();
                document.getElementById("curr-time").innerHTML = dt.toLocaleTimeString();
                document.getElementById("curr-date").innerHTML = dt.toLocaleDateString();
            </script>
			<table class="content-table">
					<thead>
						<tr>
							<th>Train ID</th>
							<th>From</th>
							<th>Start Time</th>
							<th>To</th>
							<th>End Time</th>
						</tr>
					</thead>
					<tbody>
						<tr class="active-row">
							<td data-label="Train ID"> <?php echo $data['train']->trainId;?>t</td>
							<td data-label="From"><?php echo $data['train']->src_name;?></td>
							<td data-label="Start Time"><?php echo $data['train']->starttime;?></td>
							<td data-label="To"><?php echo $data['train']->dest_name;?></td>
							<td data-label="End Time"><?php echo $data['train']->endtime;?></td>
						</tr>
					</tbody>
				</table>
				<div id="map"></div>
			<!-- </div> -->
					<form action="#">
                        <div class="formrow submit-btn">
                            <div class="input-data action">
                                <input type="button" class="red-btn" onclick="history.go(-1)" value="Back">
                            </div>
                        </div>
                    </form>
		</div>
		     <script>
		     		var marker;
                    var map;
                    function initMap(){
                        // var cities =[['Colombo Fort',6.933924, 79.850026, 1],['Kandy',7.289776, 80.632347, 2]];
                        var colombo = {lat: 6.933924,lng: 79.850026}; 
                        var kandy = {lat: 7.289776,lng: 80.632347}; 
                        // 6.933924, 79.850026 Colombo Fort station location
                        // 7.289776, 80.632347 Kandy Station location
                        map = new google.maps.Map(document.getElementById('map'),{
                            zoom: 15,
                            center: colombo
                        });
                        marker = new google.maps.Marker({
                            map: map,
                            title: "Colombo-fort"
                        });

                        var jstatus="<?php echo $data['journey']->journey_status;?>";

                        if(jstatus=="Live"){
                            marker.setIcon(icons['live']['iconPath']);
                        }else if(jstatus=="Off-Line"){
                            marker.setIcon(icons['stopped']['iconPath']);
                        }
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

             <!-- </script>
                    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                    type="text/javascript"></script> -->

                <script>
                    setInterval(function(){
                        $.ajax({
                            type: 'get',
                            url: '/mvcframework/PassengerTrackings/getTrainLocation/<?php echo $data['journey']->journeyId;?>',
                            dataType: 'json',
                            success: function (response){
                               if(response.length>0) {
                                  var location = {
                                       lat: Number(response[0].latitude),
                                       lng: Number(response[0].longtitude)
                                   };
                                   map.panTo(location);
                                   map.zoom=18;
                                   marker.setPosition(location);
                                   marker.title=response[0].trainId+" "+response[0].name;

                                   var d= new Date();
                                   var dateDisplay=document.getElementById("date-time");
                                   dateDisplay.innerHTML=d;


                                   var status=document.getElementById("LocStatus");
                                   status.innerHTML="";
                                   console.log(marker);
                                   if(response[0].location_status=='Stopped'){
                                       status.innerHTML="Stopped";
                                       status.style.color="#ee8705";
                                       marker.setIcon(icons['stopped']['iconPath']);
                                   }else{
                                       status.innerHTML="Live";
                                       status.style.color="#279427";
                                       marker.setIcon(icons['live']['iconPath']);
                                   }
                               }else{
                                    var status=document.getElementById("LocStatus");
                                    status.innerText="Journey Ended";
                                    status.style.color="#850423";
                                    marker.setIcon(icons['ended']['iconPath']);
                                    var notice=document.getElementById("redNotice");
                                    notice.innerHTML="Train seemed to have reached it's destination.";
                               }

                            }
                        });
                    }, 10000);
                </script>

                
       	<div class="content-row">
       		<!--  <button type="submit" class="back-btn">Back</button> -->
		</div>
		<div class="content-row">
		</div>
	</div>
	<!-- end of live train -->
	

<?php require APPROOT . '/views/includes/passenger_footer.php'; ?>