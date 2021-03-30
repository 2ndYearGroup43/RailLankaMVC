<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
//    var_dump($data);
?>
<script>
    var locations;
    var map;
    var markers={};
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
<script src="<?php echo URLROOT;?>/javascript/liveTrains.js"></script>
<div class="body-section">
        <div class="content-flexrow" >
            <div class="dash-column" style="flex: 1; margin-left: 10px;">
                <div class="container map" style="flex: 1;">
                    <div class="text">Track Trains <small>Control Centre</small></div>
                    <form action="#">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Train Id</label>
                                <input list="liveTrains" name="trainid" id="trainid" required >
                                <datalist id="liveTrains">
                                    <?php foreach ( $data['liveTrains'] as $train ):?>
                                        <option value="<?php echo $train->journeyId;?>"><?php echo $train->trainId.' '.$train->name?></option>
                                    <?php endforeach;?>
                                </datalist>
                            </div>
                        </div>

                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input onclick="zoomTrain(markers, map)" type="button" class="blue-btn" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="reset" class="blue-btn" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="container map livetrains" style="flex: 1; margin-top: 10px">
                    <div class="text">Track Trains <small>Control Centre</small></div>
                    <form action="<?php echo URLROOT;?>/moderatortrackings/viewlivetrains" method="post">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="center">Center Around</label>
                                <select name="centerAround" id="centerAround">
                                    <option value="western">Western</option>
                                    <option value="southern">Southern</option>
                                    <option value="northern">Northern</option>
                                    <option value="central">Central</option>
                                    <option value="eastern">Eastern</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input onclick="zoomAround(map)" type="button" class="blue-btn" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="reset" class="blue-btn" value="Reset">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="container-map" style="flex: 2;">
                <div class="container-row">
                    <img src="<?php echo URLROOT?>/public/img/logoschedule.jpg" alt="schedule-logo">
                </div>
                <h3 class="redNotice" id="redNotice"></h3>
                <div id="map"></div>
                <div id="mapcoords" data-lat></div>
                <form action="#">
                    <div class="formrow submit-btn">
                        <div class="input-data action">
                            <input type="button" class="red-btn" onclick="history.go(-1)" value="Back">
                        </div>
                    </div>
                </form>
            </div>
                <script>
                       function initMap(){
                            // var trains =[['Colombo Fort',6.933924, 79.850026, "abc"],['Kandy',7.289776, 80.632347, "def"],["Dehiwala",6.850880, 79.862132, "ghi"],['Moratuwa',6.774416, 79.882083, "klm"],["Ragama",7.030040, 79.921389,"nop"]];
                           var trains=<?php echo json_encode($data['liveTrains']);?>;
                           var position ={lat: 6.933924,lng: 79.850026};
                            // var kandy = {lat: 7.289776,lng: 80.632347};
                            // 6.933924, 79.850026 Colombo Fort station location
                            // 7.289776, 80.632347 Kandy Station location
                            map = new google.maps.Map(document.getElementById('map'),{
                                zoom: 10,
                                center: position
                            });

                            var marker,i;
                            for(i=0;i<trains.length;i++){
                                marker=new google.maps.Marker({
                                    position: new google.maps.LatLng(trains[i]['latitude'],trains[i]['longtitude']),
                                    map: map,
                                    title: trains[i]['trainId']+" "+trains[i]['name'],
                                    label: trains[i]['trainId']
                                });

                                 markers[trains[i]["journeyId"]] = {
                                     marker: marker,
                                     trainId: trains[i]["trainId"],
                                     name: trains[i]["name"],
                                     status: trains[i]["journey_status"]
                                 };
                                 if(trains[i]['journey_status']=="Live"){
                                     markers[trains[i]["journeyId"]]['marker'].setIcon(icons['live']['iconPath']);
                                 }else if (trains[i]['journey_status']=="Off-Line"){
                                     markers[trains[i]["journeyId"]]['marker'].setIcon(icons['stopped']['iconPath']);
                                 }
                                 console.log(markers);

                            }
                        }
                    </script>
                    <script>
                        setInterval(function(){
                            $.ajax({
                                type: 'get',
                                url: '/raillankamvc/ModeratorTrackings/getLiveLocations',
                                dataType: 'json',
                                success: function (response) {
                                    if(response.length>0){
                                        console.log('new');
                                        for(var i=0;i<response.length;i++){
                                            var loc={
                                                lat: Number(response[i].latitude),
                                                lng: Number(response[i].longtitude)
                                            };
                                            if(markers.hasOwnProperty(response[i].journeyId)){
                                                markers[response[i].journeyId]['marker'].setPosition(loc);
                                                markers[response[i].journeyId]['journey_status']=response[i]['journey_status'];
                                            }else{
                                                var markerNew=new google.maps.Marker({
                                                    position: loc,
                                                    map:map,
                                                    title: response[i].trainId+" "+response[i].name,
                                                    label: response[i].trainId
                                                });
                                                markers[response[i]["journeyId"]] = {
                                                    marker: markerNew,
                                                    trainId: response[i]["trainId"],
                                                    name: response[i]["name"],
                                                    status: response[i]["journey_status"]
                                                };
                                            }
                                           //change marker icon image to indicate if they re stopped or not
                                            if(response[i]['journey_status']=="Live"){
                                                markers[response[i]["journeyId"]]['marker'].setIcon(icons['live']['iconPath']);
                                            }else if (response[i]['journey_status']=="Off-Line"){
                                                console.log("kaka");
                                                markers[response[i]["journeyId"]]['marker'].setIcon(icons['stopped']['iconPath']);
                                            }
                                        }
                                    }else{
                                        var notice=document.getElementById('redNotice');
                                        notice.innerHTML="There seems to be no trains live right now!";
                                    }
                                }
                            })
                        }, 10000);

                    </script>
                    <script>
                        <?php $now=new DateTime();?>
                        //implementing the ended journey thing
                        setInterval(function () {
                           $.ajax({
                               type: 'GET',
                               url: '/raillankamvc/ModeratorTrackings/getEndedJourneys',
                               data: {loadedDate :"<?php echo $now->format("Y-m-d");?>", loadedTime:"<?php echo $now->format("H:i:s");?>" },
                               dataType: 'json',
                               success: function (response){
                                    if(response.length>0){
                                        for(var i=0;i<response.length;i++){
                                            if(markers.hasOwnProperty(response[i].journeyId)){
                                                markers[response[i]["journeyId"]]['marker'].setIcon(icons['ended']['iconPath']);
                                            }
                                        }
                                    }
                               }
                           })
                        }, 10000)
                    </script>
                     <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                     type="text/javascript"></script>
        </div>
</div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>

