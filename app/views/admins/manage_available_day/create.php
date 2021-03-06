<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>    
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add Available Days</small></div>
                        <form action="<?php echo URLROOT; ?>/Admin_manage_available_days/create/<?php echo $data['trainId'];?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <input type="hidden" name="sunday" value="No">
                                    <input type="checkbox" name="sunday" value="Yes">
                                    <label for="sunday">Sunday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="monday" value="No">
                                    <input type="checkbox" name="monday" value="Yes">
                                    <label for="monday">Monday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="tuesday" value="No">
                                    <input type="checkbox" name="tuesday" value="Yes">
                                    <label for="tuesday">Tuesday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="wednesday" value="No">
                                    <input type="checkbox" name="wednesday" value="Yes">
                                    <label for="wednesday">Wednesday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="thursday" value="No">
                                    <input type="checkbox" name="thursday" value="Yes">
                                    <label for="thursday">Thursday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="friday" value="No">
                                    <input type="checkbox" name="friday" value="Yes">
                                    <label for="friday">Friday</label>
                                </div>
                                <div class="input-data">
                                    <input type="hidden" name="saturday" value="No">
                                    <input type="checkbox" name="saturday" value="Yes">
                                    <label for="saturday">Saturday</label>
                                </div>
                                </div>
                                <div class="form-row submit-btn">
                                    <div class="input-data">
                                        <input type="submit" class="blue-btn" name="submit" value="Save">
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