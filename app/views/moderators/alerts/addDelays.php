<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>  

                            
    <div class="body-section">
        <div class="content-flexrow">
            <div class="container">
                <div class="text">Add Alerts <small>Delays</small></div>
                <form action="<?php echo URLROOT;?>/moderatoralerts/createDelayAlerts" method="POST">
                    <div class="form-row">
                        <div class="input-data">
                            <label for="trainid">Train Id</label>
                            <input type="text" name="trainid" id="trainid" required >
                            <span class="invalidFeedback">
                                    <?php echo $data['trainIdError'];?>
                            </span> 
                        </div>
                        <div class="input-data">
                            <label for="delaytime">Estimated Delay Time</label>
                            <input type="time" name="delaytime" id="delaytime" required >
                            <span class="invalidFeedback">
                                    <?php echo $data['delayTimeError'];?>
                            </span> 
                        </div>
                    </div>
                    <!-- <div class="form-row">
                        <div class="input-data">
                            <label for="delaytime">New Date & Time</label>
                            <input type="time" id="delaytime" required >
                        </div>
                    </div> -->
                    <div class="form-row">
                        <div class="input-data textarea">
                                <label for="delaycause">Delay-Cause</label>
                                <textarea name="delaycause" id="delaycause" cols="30" rows="10" required></textarea>
                                <span class="invalidFeedback">
                                    <?php echo $data['delayCauseError'];?>
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