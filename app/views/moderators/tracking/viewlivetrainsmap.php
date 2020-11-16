<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

<div class="body-section">
            <div class="content-row">
                    <div class="container-map">
                        <div class="container map">
                        <div class="text">Track Trains <small>Control Centre</small></div>
                            <form action="#">
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="trainid">Train Id</label>
                                        <input type="text" name="trainid" id="trainid" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="center">Center Around</label>
                                        <select name="center" id="center">
                                            <option value="western">Western</option>
                                            <option value="southern">Southern</option>
                                            <option value="northern">Northern</option>
                                            <option value="central">Central</option>
                                        </select>
                                    </div>
                                    <div class="input-data">
                                        <label for="filter">Filter View</label>
                                       <select name="filter" id="filter">
                                           <option value="all">All trains</option>
                                           <option value="all">Entered Train</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="form-row submit-btn">
                                    <div class="input-data">
                                        <input onclick="location.href='<?php echo URLROOT;?>/moderatorTrackings/viewlivetrains'" type="submit" class="blue-btn" value="Search">
                                    </div>    
                                    <div class="input-data">
                                        <input type="reset" class="blue-btn" value="Reset">
                                    </div>
                                    <div class="input-data">
                                        <input onclick="history.go(-1)" type="button" class="red-btn" value="Back">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div id="map"></div>
                </div>
                <script>
                        function initMap(){
                            var trains =[['Colombo Fort',6.933924, 79.850026, "abc"],['Kandy',7.289776, 80.632347, "def"],["Dehiwala",6.850880, 79.862132, "ghi"],['Moratuwa',6.774416, 79.882083, "klm"],["Ragama",7.030040, 79.921389,"nop"]];
                             var colombo = {lat: 6.933924,lng: 79.850026}; 
                            // var kandy = {lat: 7.289776,lng: 80.632347}; 
                            // 6.933924, 79.850026 Colombo Fort station location
                            // 7.289776, 80.632347 Kandy Station location
                            var map = new google.maps.Map(document.getElementById('map'),{
                                zoom: 8,
                                center: colombo
                            });

                            var marker,i;
                            for(i=0;i<trains.length;i++){
                                marker=new google.maps.Marker({
                                    position: new google.maps.LatLng(trains[i][1],trains[i][2]),
                                    map: map,
                                    title: trains[i][0],
                                    label: trains[i][3]
                                });
                            }
                            // var marker1 = new google.maps.Marker({
                            //     position: colombo,
                            //     map: map,
                            //     title: "Colombo-fort"
                            // });
                            // var marker2 = new google.maps.Marker({
                            //     position: kandy,
                            //     map: map,
                            //     title: "kandy"
                            // });
                        }
                    </script>
                     <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                     type="text/javascript"></script>
            </div>
        </div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>