<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Train Details</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_trains/edit/<?php echo $data['manage_train']->trainId?>" method ="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="trainId">Train Id</label>
                        <input type="text" name="trainId" value="<?php echo $data['manage_train']->trainId?>" id="trainId"  >
                    </div>
                    <div class="input-data">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $data['manage_train']->name?>" id="name" >
                        <span class="invalidFeedback">
                            <?php echo $data['nameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="reservable_status">Reservable Status</label>
                        <select name="reservable_status" id="reservable_status" >
                                <option value=""><?php echo $data['manage_train']->reservable_status?></option>
                                <option >Yes</option>
                                <option >No</option>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['reservable_statusError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="type">Type</label>
                        <select name="type" id="type" >
                                <option value=""><?php echo $data['manage_train']->type?></option>
                                <option >Express</option>
                                <option >IntercityExpress</option>
                                <option >HolidaySpecial</option>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['typeError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="src_station">Source Station</label>
                        <select name="src_station" id="src_station" >
                                <option value=""><?php echo $data['manage_train']->src_station?></option>
                                <?php foreach ($data['stationids'] as $stationid ):?>
                                <option value="<?php echo $stationid->stationID?>"><?php echo $stationid->stationID?> : <?php echo $stationid->name?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['src_stationError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="starttime">Start Time</label>
                        <input type="time" name="starttime" value="<?php echo $data['manage_train']->starttime?>" id="starttime" >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="dest_station">Destination</label>
                        <select name="dest_station" id="dest_station">
                                <option value=""><?php echo $data['manage_train']->dest_station?></option>
                                <?php foreach ($data['stationids'] as $stationid ):?>
                                <option value="<?php echo $stationid->stationID?>"><?php echo $stationid->stationID?> : <?php echo $stationid->name?></option>
                            <?php endforeach;?>
                        </select>
                        <span class="invalidFeedback">
                            <?php echo $data['dest_stationError'];?>
                        </span>                       
                    </div>
                    <div class="input-data">
                        <label for="endtime">End Time</label>
                        <input type="time" name="endtime" value="<?php echo $data['manage_train']->endtime?>" id="endtime"  >
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="rateId">Rate ID</label>
                        <select name="rateId" id="rateId" >
                                <option value=""><?php echo $data['manage_train']->rateId?></option>
                                <?php foreach ($data['rates'] as $rate ):?>
                                <option value="<?php echo $rate->rateId?>"><?php echo $rate->rateId?></option>
                            <?php endforeach;?>
                        </select>                       
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Update Train">
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