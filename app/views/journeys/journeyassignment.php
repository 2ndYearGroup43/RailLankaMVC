<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/navigationModerator.php';
?>
    <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text">Driver Assignment<small> Journey Management</small></div>
                    <form action="<?php echo URLROOT;?>/journeys/createJourneyAssignment" method="POST">
                        <div class="form-row">
                            <div class="input-data">
                                <label for="trainid">Train Id</label>
                                <input type="text" name="trainid" id="trainid" required >
                                <span class="invalidFeedback">
                                	<?php echo $data['trainIdError'];?>
                            	</span>
                            </div>
                            <div class="input-data">
                                <label for="driverId">Driver Id</label>
                                <input type="text" name="driverid" id="driverid" required >
                                <span class="invalidFeedback">
                                <?php echo $data['driverIdError'];?>
                            </span>
                            </div>
                        </div>
                        <div class="form-row" style="padding-bottom: 30px;">
                            <div class="input-data">
                                <label for="jstatus">New Date</label>
                                <select name="jstatus" id="jstatus">
                                    <option value="Live">Live</option>
                                    <option value="Off-Line">Off-Line</option> 
                                </select>
                            </div>
                            <div class="input-data">
                                <label for="date">Date</label>
                                <input type="date" name="date" id="date" required >
                            </div>
                        </div>
                        <div class="form-row submit-btn">
                            <div class="input-data">
                                <input type="submit" class="blue-btn" value="Add Assignment">
                            </div>    
                            <div class="input-data">
                                <input type="submit" class="blue-btn" style="font-size: 14px;" value="Add & New Assignment">
                            </div>
                            <div class="input-data">
                                <input type="submit" class="red-btn" value="Back">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

<?php
    require APPROOT.'/views/includes/footer.php';
?>
