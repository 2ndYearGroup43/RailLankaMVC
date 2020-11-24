<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

<div class="body-section">
        <div class="content-flexrow" >
            <div class="dash-column" style="flex: 1; margin-left: 10px;">
                <div class="container map" style="flex: 1;">
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
                                <input onclick="location.href='<?php echo URLROOT;?>/moderatorTrackings/viewlivetrains'" type="submit" class="blue-btn" value="Search">
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
                            var trains =[['Colombo Fort',6.933924, 79.850026, "abc"],['Kandy',7.289776, 80.632347, "def"],["Dehiwala",6.850880, 79.862132, "ghi"],['Moratuwa',6.774416, 79.882083, "klm"],["Ragama",7.030040, 79.921389,"nop"]];
                             var position = <?php echo  $data['pos'];?>;
                            // var kandy = {lat: 7.289776,lng: 80.632347}; 
                            // 6.933924, 79.850026 Colombo Fort station location
                            // 7.289776, 80.632347 Kandy Station location
                            var map = new google.maps.Map(document.getElementById('map'),{
                                zoom: 10,
                                center: position
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
                        }
                    </script>
                     <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpvvsHk0hFouQ96SvUrCbPrq6GDXLDuy8&callback=initMap"
                     type="text/javascript"></script>
        </div>
</div>

<?php
    require APPROOT.'/views/includes/footer.php';
?>

