<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>   
    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add Fare</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_fares/create" method = "POST">
                <div class="form-row">
                    <div class="text"><small>Reservation Rates</small></div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="fclassbase">First Class Base</label>
                        <input type="text" name="fclassbase" id="fclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['fclassbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="sclassbase">Second Class Base</label>
                        <input type="text" name="sclassbase" id="sclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['sclassbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="tclassbase">Third Class Base</label>
                        <input type="text" name="tclassbase" id="tclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['tclassbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="text"><small>Normal Rates</small></div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="fclassnormalbase">First Class Base</label>
                        <input type="text" name="fclassnormalbase" id="fclassnormalbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['fclassnormalbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="sclassnormalbase">Second Class Base</label>
                        <input type="text" name="sclassnormalbase" id="sclassnormalbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['sclassnormalbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="tclassnormalbase">Third Class Base</label>
                        <input type="text" name="tclassnormalbase" id="tclassnormalbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['tclassnormalbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" id="distance" required >
                        <span class="invalidFeedback">
                            <?php echo $data['distanceError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="rate">Rate</label>
                        <input type="text" name="rate" id="rate" required >
                        <span class="invalidFeedback">
                            <?php echo $data['rateError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Add Fare">
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