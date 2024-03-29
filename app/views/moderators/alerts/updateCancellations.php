<?php
    require APPROOT.'/views/includes/moderator_head.php';
?>
<?php
    require APPROOT.'/views/includes/moderator_navigation.php';
//    var_dump($data);
?>

<script src="<?php echo URLROOT;?>/javascript/alertValidations/cancelValidation.js"></script>
<div class="marquee-area info-tag">
	<marquee>
		<i class="fa fa-exclamation-triangle" aria-hidden="true" size="3x"></i> Coronavirus(COVID-19) - For the latest updates and travel information, please visit our Coronavirus Information Center
	</marquee>
</div>
    <div class="body-section">
        <div class="content-flexrow">
            <div class="container">
                <div class="text">Update Alerts <small>Cancellations</small></div>
                <form action="<?php echo URLROOT;?>/moderatoralerts/updateCancellations/<?php echo $data['alert']->alertId;?>" method="POST"> 
                    <div class="form-row">
                        <div class="input-data">
                            <label for="trainid">Train Id</label>
                            <input list="trains" value="<?php echo $data['alert']->trainId; ?>" name="trainid" id="trainid" required >
                            <datalist id="trains">
                                <?php foreach ($data['trains'] as $train ):?> 
                                    <option value="<?php echo $train->trainId;?>"><?php echo $train->trainId.' '.$train->name?></option>
                                <?php endforeach;?>
                            </datalist>
                            <span class="invalidFeedback">
                                <?php echo $data['trainIdError'];?>
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="input-data">
                            <label for="cancelDate">Cancellation Date</label>
                            <input type="date" name="cancelDate" id="cancelDate" value="<?php echo $data['alert']->cancellation_date;?>" required>
                            <span class="invalidFeedback"><?php echo $data['cancelDateError'];?></span>
                        </div>
                        <div class="input-data">
                            <label for="issueType">Train Id</label>
                            <select name="issueType" id="issueType">
                                <option value="<?php echo $data['alert']->issuetype;?>"><?php echo $data['alert']->issuetype;?></option>
                                <option value="Unspecified">Unspecified</option>
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
                        <div class="input-data textarea">
                            <label for="cancelcause">Cancellation-Cause</label>
                            <textarea name="cancelcause" id="cancelcause" cols="30" rows="10" required><?php echo $data['alert']->cancellation_cause; ?></textarea>
                            <span class="invalidFeedback">
                                <?php echo $data['cancelCauseError'];?>
                            </span>    
                        </div>
                    </div>
                    <div class="form-row submit-btn">
                        <div class="input-data">
                            <input type="submit" class="blue-btn" value="Update Alert">
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