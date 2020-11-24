<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php echo URLROOT;?>/javascript/trainScheduleAdd.js"></script>
        
	    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add Schedule</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_schedules/addschedule/<?php echo $data['trainId'];?>" id="scheduleForm" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <!-- <label for="routeId">Route Id</label>
                        <select name="routeId" id="routeId" required>
                                <option value="">Select</option>
                                    <?php foreach ($data['routes'] as $route ):?>
                                    <option value="<?php echo $route->routeId?>"><?php echo $route->routeId?></option>
                                <?php endforeach;?>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['routeIdError'];?>
                        </span> -->
                        <label for="stationID">Station Id</label>
                        <select name="stationID" id="stationID" >
                            <option value="">Select</option>
                                <?php foreach ($data['stations'] as $station ):?>
                                <option value="<?php echo $station->stationID?>"><?php echo $station->stationID?> : <?php echo $station->name?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="invalidFeedback" id="stationIDError">
                            <!-- <?php echo $data['stationIDError'];?> -->
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="stopNo">Stop No</label>
                        <input type="text" name="stopNo" id="stopNo">
                        <span class="invalidFeedback" id="stopNoError">
                            <!-- <?php echo $data['stopNoError'];?> -->
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="arrivaltime">Arrival Time</label>
                        <input type="Time" name="arrivaltime" id="arrivaltime">
                        <span class="invalidFeedback" id="arrivalTimeError">
                            <!-- <?php echo $data['arrivalTimeError'];?> -->
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="departuretime">Departure Time</label>
                        <input type="Time" name="departuretime" id="departuretime">
                        <span class="invalidFeedback" id="departureTimeError">
                            <!-- <?php echo $data['departureTimeError'];?> -->
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="date">Date</label>
                        <select name="date" id="date" required >
                            <option value="Same Day" selected>Same Day</option>
                            <option value="Next Day">Next Day</option>
                        </select>
                        <span class="invalidFeedback" id="dateError">
                            <!-- <?php echo $data['scheduleError'];?> -->
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" id="distance">
                        <span class="invalidFeedback" id="distanceError">
                            <!-- <?php echo $data['scheduleError'];?> -->
                        </span>
                    </div>
                </div>
                
                    <div class="input-data">
                        <span class="invalidFeedback">
                            <?php echo $data['scheduleError'];?>
                        </span>
                    </div>
                
                <input type="hidden" id="scheduleField" name="scheduleField">
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="button" class="blue-btn" id="addrow" name="addrow" value="Add Schedule" onclick="Javascript:addScheduleRow()">
                    </div>
                    <div class="input-data">
                       <input type="submit" class="blue-btn" id="post" name="post" value="Next">
                    </div>
                </div>
            </form>
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Schedule <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" id="scheduleTable" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>StationID</th>
                                    <th>Stop No</th>
                                    <th>Arrival Time</th>
                                    <th>Departure Time</th>
                                    <th>Date</th>
                                    <th>Distance</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody id="scheduleBody">
                    
                            </tbody>
                        </table>
                    </div>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>


                    <script>
                        function collapseContent(){
                            var coll= document.getElementById("availdays-btn");
                            var content=coll.nextElementSibling;
                            if(content.style.display==="none"){
                                content.style.display="block";
                                coll.style.backgroundColor="#0c2752";
                            }else if(content.style.display="block"){
                                content.style.display="none";
                                coll.style.backgroundColor="#13406d";
                            }
                        }
                    </script>

                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>