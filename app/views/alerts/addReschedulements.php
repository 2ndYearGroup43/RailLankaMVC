<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/navigationModerator.php';
?>
    <div class="body-section">
        <div class="content-flexrow">
            <div class="container">
                <div class="text">Add Alerts <small>Reschedulements</small></div>
                <form action="<?php echo URLROOT;?>/alerts/createRescheduledAlerts" method="POST">
                    <div class="form-row">
                        <div class="input-data">
                            <label for="trainid">Train Id</label>
                            <input type="text" name="trainid" id="trainid" required >
                            <span class="invalidFeedback">
                                <?php echo $data['trainIdError']?>
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data">
                            <label for="newdate">New Date</label>
                            <input type="date" name="newdate" id="newdate" required >
                            <span class="invalidFeedback">
                                <?php echo $data['newDateError']?>
                            </span>
                        </div>
                        <div class="input-data">
                            <label for="newtime">New Time</label>
                            <input type="time" name="newtime" id="newtime" required >
                            <span class="invalidFeedback">
                                <?php echo $data['newTimeError']?>
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data textarea">
                                <label for="reschedulementcause">Reschedulement-Cause</label>
                                <textarea name="reschedulementcause" id="reschedulementcause" cols="30" rows="10" required></textarea>
                                <span class="invalidFeedback">
                                <?php echo $data['reschedulementCauseError']?>
                                </span>
                        </div>
                    </div>
                    <div class="form-row submit-btn">
                        <div class="input-data">
                            <input type="submit" class="blue-btn" value="Add Alert">
                        </div>    
                        <div class="input-data">
                            <input type="submit" class="blue-btn" value="Add & New Alert">
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