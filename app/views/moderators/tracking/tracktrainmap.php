<?php isModeratorLoggedIn(); ?>
<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>


<div class="body-section">
            <div class="content-row">
                <button type="submit" class="submit-btn search" onclick="openForm()">Search</button>    
            </div>
                <div class="content-row">
                <div class="container-searchbox-popup" id="popupsearch">
                    <form action="#">
                        <div class="form-row logoimg">    
                            <div class="searchlogo">
                                <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="raillankatracktrains">
                            </div>
                        </div>   
                        <div class="form-row">
                            <div class="input-data">
                                <label for="src">Source Station</label>
                                <select name="src" id="src">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="dest">Destination Station</label>
                                <select name="dest" id="dest">
                                    <option value="Fort">Fort</option>
                                    <option value="Kandy">Kandy</option>
                                    <option value="Galle">Galle</option>
                                    <option value="Baadulla">Baadulla</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="date">Date</label>
                                <input type="date" id="date" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-data">
                                <label for="time">Time</label>
                                <input type="time" id="time" >
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data" >
                                <input type="button" onclick="location.href='<?php echo URLROOT;?>/moderatorTrackings/displayTrackList'" class="blue-btn" style="font-size: 15px;" value="Search">
                            </div>    
                            <div class="input-data">
                                <input type="reset" class="blue-btn" value="Reset" style="font-size: 15px;" onclick="closeForm()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                function openForm() {
                    document.getElementById("popupsearch").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("popupsearch").style.display = "none";
                }
            </script>
        
            <script>
                $('.icon').click(function(){
                    $('span').toggleClass("cancel");
                });
            </script>
            <div class="content-row">
                <div class="container-map" style="padding-bottom: 60px">
                    <div class="container-row">
                        <img src="<?php echo URLROOT;?>/public/img/logotrack.jpg" alt="logo-track">
                    </div>
                    <h2 style="color: #13406d; text-align: center;">Live Location Details </h2>
                    <div class="date-time">
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
                            <td data-th="Train-ID"> 101COLKAN0530</td>
                            <td data-th="From">Colombo Fort</td>
                            <td data-th="Start Time">05:30</td>
                            <td data-th="To">Kandy</td>
                            <td data-th="End Time">14:15</td>
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
            </div>
        </div>


<?php
    require APPROOT.'/views/includes/footer.php';
?>