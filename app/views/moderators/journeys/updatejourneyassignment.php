<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
    // var_dump($data['trains']);
    // var_dump($data['drivers']);
    
?>
    <script src="<?php echo URLROOT;?>/javascript/journeyAssValidation.js"></script>
    <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Update Driver Assignment<small></small></div>
                    <form action="<?php echo URLROOT;?>/ModeratorJourneys/updateJourney/<?php echo $data['journeyId'];?>/<?php echo $data['driver'];?>" method="POST">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Train Id</label>
                                <input list="trains" value="<?php echo $data['journey']->trainId; ?>" name="trainid" id="trainid" required >
                                <datalist id="trains">
                                        <option value="<?php $data['journey']->trainId;?>"><?php echo $data['journey']->trainId;?></option>
                                    <?php foreach ($data['trains'] as $train ):?> 
                                        <option value="<?php echo $train->trainId1;?>"><?php echo $train->trainId1.' '.$train->name?></option>
                                    <?php endforeach;?>
                                </datalist>
                                <span class="invalidFeedback">
                                	<?php echo $data['trainIdError'];?>
                            	</span>
                            </div>
                            <div class="input-data">
                                <label for="driverid">Driver Id</label>
                                    <input list="drivers" value="<?php echo $data['journey']->driverId; ?>" name="driverid" id="driverid" required >
                                    <datalist id="drivers">
                                        <option value="<?php $data['journey']->driverId;?>"><?php echo $data['journey']->driverId;?></option>
                                        <?php foreach ($data['drivers'] as $driver ):?> 
                                            <option value="<?php echo $driver->driverId;?>"><?php echo $driver->driverId;?></option>
                                        <?php endforeach;?>
                                    </datalist>
                                <span class="invalidFeedback">
                                <?php echo $data['driverIdError'];?>
                            </span>
                            </div>
                        </div>
                        <div class="form-row" style="padding-bottom: 30px;">
                            <div class="input-data">
                                <label for="jstatus">Joruney Status</label>
                                <select name="jstatus" id="jstatus">
                                    <option value="<?php echo $data['journey']->journey_status;?>"><?php echo $data['journey']->journey_status;?></option>    
                                    <option value="Ended">Ended</option>
                                    <option value="Live">Live</option>
                                    <option value="Off-Line">Off-Line</option> 
                                </select>
                            </div>
                            <div class="input-data">
                                <label for="date">Date</label>
                                <input type="date" value="<?php echo $data['journey']->date;?>"  name="date" id="date" required >
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Update Assignment">
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