<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
    var_dump($data['reservable_status']);
?>  
    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add Train Details</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_trains/create" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="trainId">Train Id</label>
                        <input type="text" name="trainId" id="trainId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['trainIdError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required >
                        <span class="invalidFeedback">
                            <?php echo $data['nameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="reservable_status">Reservable Status</label>
                        <select name="reservable_status" id="reservable_status" required>
<!--                                <option value="">Select</option>-->
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['reservable_statusError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="type">Type</label>
                        <select name="type" id="type" required>
                                <option value="">Select</option>
                                <option value="Express">Express</option>
                                <option value="Intercity Express">Intercity Express</option>
                                <option value="Holiday Special">Holiday Special</option>
                                <option value="Night">Night</option>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['typeError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="src_station">Source Station</label>
                        <input list="srcstations" name="src_station" id="src_station" required >
                        <datalist id="srcstations">
                            <?php foreach ($data['stationids'] as $stationid ):?>
                                <option value="<?php echo $stationid->stationID?>"><?php echo $stationid->stationID?> : <?php echo $stationid->name?></option>
                            <?php endforeach;?>
                        </datalist>
<!--                        <select name="src_station" id="src_station" required>-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php //foreach ($data['stationids'] as $stationid ):?>
<!--                               -->
<!--                            --><?php //endforeach;?>
<!--                        </select>-->
                        <span class="invalidFeedback">
                            <?php echo $data['src_stationError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="starttime">Start Time</label>
                        <input type="time" name="starttime" id="starttime" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="dest_station">Destination</label>
                        <input list="deststations" name="dest_station" id="dest_station" required >
                        <datalist id="deststations">
                            <?php foreach ($data['stationids'] as $stationid ):?>
                                <option value="<?php echo $stationid->stationID?>"><?php echo $stationid->stationID?> : <?php echo $stationid->name?></option>
                            <?php endforeach;?>
                        </datalist>
<!--                        <select name="dest_station" id="dest_station" required>-->
<!--                                <option value="">Select</option>-->
<!--                                --><?php //foreach ($data['stationids'] as $stationid ):?>
<!--                                <option value="--><?php //echo $stationid->stationID?><!--">--><?php //echo $stationid->stationID?><!-- : --><?php //echo $stationid->name?><!--</option>-->
<!--                            --><?php //endforeach;?>
<!--                        </select>-->
                        <span class="invalidFeedback">
                            <?php echo $data['dest_stationError'];?>
                        </span>                      
                    </div>
                    <div class="input-data">
                        <label for="endtime">End Time</label>
                        <input type="time" name="endtime" id="endtime" required >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="rateId">Rate ID</label>
                        <select name="rateId" id="rateId" required>
                                <option value="">Select</option>
                                <?php foreach ($data['rates'] as $rate ):?>
                                <option value="<?php echo $rate->rateId?>"><?php echo $rate->rateId?></option>
                            <?php endforeach;?>
                        </select>                      
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Next">
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