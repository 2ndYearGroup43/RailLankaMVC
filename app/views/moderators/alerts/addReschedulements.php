<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
?>

    <script src="<?php echo URLROOT;?>/javascript/alertValidations/reschedulementValidation.js"></script>
<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>

    <div class="body-section">
        <div class="content-flexrow">
            <div class="container">
                <div class="text">Add Alerts <small>Reschedulements</small></div>
                <form action="<?php echo URLROOT;?>/moderatoralerts/createRescheduledAlerts" method="POST">
                    <div class="form-row">
                        <div class="input-data">
                            <label for="trainid">Train Id</label>
                            <input list="trains" name="trainid" id="trainid" required >
                            <datalist id="trains">
                                <?php foreach ($data['trains'] as $train ):?> 
                                    <option value="<?php echo $train->trainId;?>"><?php echo $train->trainId.' '.$train->name?></option>
                                <?php endforeach;?>
                            </datalist>
                            <span class="invalidFeedback">
                                <?php echo $data['trainIdError']?>
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data">
                            <label for="olddate">Old Date</label>
                            <input type="date" name="olddate" id="olddate" required >
                            <span class="invalidFeedback">
                                <?php echo $data['oldDateError']?>
                            </span>
                        </div>
                        <div class="input-data">
                            <label for="issueType">Issue Type</label>
                            <select name="issueType" id="issueType">
                                <option value="Unspecified" selected>Unspecified</option>
                                <option value="Environmental" >Environmental</option>
                                <option value="Technical" >Technical</option>
                                <option value="Rail Road" >Rail Road</option>
                                <option value="Other" >Other</option>
                            </select>
                            <span class="invalidFeedback">
                                <?php echo $data['issueTypeError'];?>
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