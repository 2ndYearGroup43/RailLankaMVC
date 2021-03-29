<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
//    var_dump($data);

?>
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


<div class="body-section">
            <div class="content-row">
                <div class="container-map" style="padding-bottom: 60px">
                    <div class="container-row">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="logo-track">
                    </div>
                    <h2 style="color: #13406d; text-align: center;">Live Location Details </h2>
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
                    <table class="blue">
                        <thead>
                            <tr>
                                <th >Train ID</th>
                                <th>From</th>
                                <th>Start Time</th>
                                <th>To</th>
                                <th>End Time</th>  
                            </tr>
                        </thead>
                        <tr>
                            <td data-th="Train-ID"> <?php echo $data['train']->trainId;?></td>
                            <td data-th="From"><?php echo $data['train']->src_name;?></td>
                            <td data-th="Start Time"><?php echo $data['train']->starttime;?></td>
                            <td data-th="To"><?php echo $data['train']->dest_name;?></td>
                            <td data-th="End Time"><?php echo $data['train']->endtime;?></td>
                        </tr>
                    </table>
                    <div id="map">
                        
                    </div>
                    <form action="#">
                        <div class="formrow submit-btn">
                            <div class="input-data action">
                                <input type="button" class="red-btn" onclick="history.go(-1)" value="Back">
                            </div>
                        </div>
                    </form>
                    
                </div>
                <script>
                    //setup global variables
                    var marker;
                    var map;
                    function initMap(){
                        var colombo = {lat: 6.933924,lng: 79.850026};
                        var kandy = {lat: 7.289776,lng: 80.632347};
                        var journey=<?php echo  json_encode($data['journey']);?>;

                        map = new google.maps.Map(document.getElementById('map'),{ //define the div #id
                            zoom: 15,
                            center: colombo
                        });

                        marker = new google.maps.Marker({
                            map: map,
                            position: new google.maps.LatLng(Number(journey.latitude), Number(journey.longitude)),
                            title: "<?php echo $data['train']->trainId.' '.$data['train']->name;?>",
                            label: journey.trainId
                        });
                        var jstatus="<?php echo $data['journey']->journey_status;?>";
                        if(jstatus=="Live"){
                            marker.setIcon(icons['live']['iconPath']);
                        }else if(jstatus=="Off-Line"){
                            marker.setIcon(icons['stopped']['iconPath']);
                        }

                    }
                </script>
                    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                    type="text/javascript"></script>

                <script>
                    //get ajax json from gettrainlocation/journeyID
                    setInterval(function(){
                        $.ajax({
                            type: 'get',
                            url: '/raillankamvc/ModeratorTrackings/getTrainLocation/<?php echo $data['journey']->journeyId;?>',
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

                                   //update date in the date div
                                   var d= new Date();
                                   var dateDisplay=document.getElementById("date-time");
                                   dateDisplay.innerHTML=d;

                                    //change status according to location status of the response
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
                                   //if response is none meaning n response array
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
            </div>
        </div>


<?php
    require APPROOT.'/views/includes/footer.php';
?>