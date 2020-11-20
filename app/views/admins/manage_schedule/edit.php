<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?> 
<div class="body-section">
        <div class="content-flexrow">
               <div class="container">
                <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Schedule</small></div>
                <form action="<?php echo URLROOT; ?>/Admin_manage_schedules/edit/<?php echo $data['manage_schedule']->routeId?>" method = "POST">
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="routeId">Route Id</label>
                                        <select name="routeId" id="routeId" required>
                                            <option value=""><?php echo $data['manage_schedule']->routeId?></option>
                                            <?php foreach ($data['routes'] as $route ):?>
                                            <option value="<?php echo $route->routeId?>"><?php echo $route->routeId?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="input-data">
                                        <label for="stationID">Station Id</label>
                                        <select name="stationID" id="stationID" required>
                                            <option value=""><?php echo $data['manage_schedule']->stationID?></option>
                                            <?php foreach ($data['stations'] as $station ):?>
                                            <option value="<?php echo $station->stationID?>"><?php echo $station->stationID?> : <?php echo $station->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <span class="invalidFeedback">
                                            <?php echo $data['stationIDError'];?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="stopNo">Stop No</label>
                                        <input type="text" name="stopNo" value="<?php echo $data['manage_schedule']->stopNo?>" id="stopNo" required >
                                        <span class="invalidFeedback">
                                            <?php echo $data['stopNoError'];?>
                                        </span>
                                    </div>
                                    <div class="input-data">
                                        <label for="arrivaltime">Arrival Time</label>
                                        <input type="Time" name="arrivaltime" value="<?php echo $data['manage_schedule']->arrivaltime?>" id="arrivaltime" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="departuretime">Departure Time</label>
                                        <input type="Time" name="departuretime" value="<?php echo $data['manage_schedule']->departuretime?>" id="departuretime" required >
                                    </div>
                                    <div class="input-data">
                                        <label for="date">Date</label>
                                        <input type="Date" name="date" value="<?php echo $data['manage_schedule']->date?>" id="date" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="distance">Distance</label>
                                        <input type="text" name="distance" value="<?php echo $data['manage_schedule']->distance?>" id="distance" required >
                                        <span class="invalidFeedback">
                                            <?php echo $data['distanceError'];?>
                                        </span>
                                    </div>
                                </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="Update Schedule">
                                </div>
                            </div>
                        </form>
                        
                    <button type="button" id="availdays-btn" class="collapsible" onclick="collapseContent()">View Added Schedule <span class="fa fa-caret-down" aria-hidden="true"></span></button>
                    <div class="collapsible-content">
                        <table class="blue" style="margin-top: 0px;">
                            <thead>
                                <tr>
                                    <th>Route Id</th>
                                    <th>Station Id</th>
                                    <th>Stop No</th>
                                    <th>Arrival Time</th>
                                    <th>Departure Time</th>
                                    <th>Date</th>
                                    <th>Distance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['added_data'] as $post):?> 
                                <tr>
                                    <td data-th="Route Id"><?php echo $post->routeId?></td>
                                    <td data-th="Station Id"><?php echo $post->stationID?></td>
                                    <td data-th="Stop No"><?php echo $post->stopNo?></td>
                                    <td data-th="Arrival Time"><?php echo $post->arrivaltime?></td>
                                    <td data-th="Departure Time"><?php echo $post->departuretime?></td>
                                    <td data-th="Date"><?php echo $post->date?></td>
                                    <td data-th="Distance"><?php echo $post->distance?></td>
                                </tr>
                                <?php endforeach; ?>
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