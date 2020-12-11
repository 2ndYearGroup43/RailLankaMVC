<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Schedule</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_schedules/editSingle/<?php echo $data['routeId'];?>/<?php echo $data['schedule']->stationID;?>/<?php echo $data['trainId'];?>" method = "POST">
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="stopNo">Stop No</label>
                                        <input type="text" name="stopNo" value="<?php echo $data['stopNo'];?>" id="stopNo" required >
                                        <span class="invalidFeedback">
                                            <?php echo $data['stopNoError'];?>
                                        </span>
                                    </div>
                                    <div class="input-data">
                                        <label for="arrivaltime">Arrival Time</label>
                                        <input type="Time" name="arrivaltime" value="<?php echo $data['arrivaltime'];?>" id="arrivaltime" required >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="departuretime">Departure Time</label>
                                        <input type="Time" name="departuretime" value="<?php echo $data['departuretime'];?>" id="departuretime" required >
                                    </div>
                                    <div class="input-data">
                                        <label for="date">Date</label>
                                        <select name="date" id="date" required >
                                            <option value=""><?php echo $data['date'];?></option>
                                            <option value="Same Day" selected>Same Day</option>
                                            <option value="Next Day">Next Day</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="input-data">
                                        <label for="distance">Distance</label>
                                        <input type="text" name="distance" value="<?php echo $data['distance'];?>" id="distance" required >
                                        <span class="invalidFeedback">
                                            <?php echo $data['distanceError'];?>
                                        </span>
                                    </div>
                                </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="Update Schedule">
                                </div>
                                <div class="input-data">
                                    <input type="button" onclick="history.go(-1);" class="red-btn" value="Back">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>