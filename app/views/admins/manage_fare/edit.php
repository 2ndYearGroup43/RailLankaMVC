<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>
    <div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains<small style="color: black;">Update Fare Details</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_fares/edit/<?php echo $data['manage_fare']->rateID?>" method ="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="rateID">Rate ID</label>
                        <input type="text" name="rateID" value="<?php echo $data['manage_fare']->rateID?>" id="rateID" required >
                        <span class="invalidFeedback">
                            <?php echo $data['rateIDError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="fclassbase">First Class Base</label>
                        <input type="text" name="fclassbase" value="<?php echo $data['manage_fare']->fclassbase?>" id="fclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['fclassbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="sclassbase">Second Class Base</label>
                        <input type="text" name="sclassbase" value="<?php echo $data['manage_fare']->sclassbase?>" id="sclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['sclassbaseError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="tclassbase">Third Class Base</label>
                        <input type="text" name="tclassbase" value="<?php echo $data['manage_fare']->tclassbase?>" id="tclassbase" required >
                        <span class="invalidFeedback">
                            <?php echo $data['tclassbaseError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="distance">Distance</label>
                        <input type="text" name="distance" value="<?php echo $data['manage_fare']->distance?>" id="distance" required >
                        <span class="invalidFeedback">
                            <?php echo $data['distanceError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="rate">Rate</label>
                        <input type="text" name="rate" value="<?php echo $data['manage_fare']->rate?>" id="rate" required >
                        <span class="invalidFeedback">
                            <?php echo $data['rateError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Update">
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