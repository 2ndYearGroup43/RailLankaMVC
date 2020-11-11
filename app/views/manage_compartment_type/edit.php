<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?> 
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Compartment Type</small></div>
            <form action="<?php echo URLROOT; ?>/manage_compartment_type/edit/<?php echo $data['manage_compartment_type']->typeNo?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="typeNo">Type</label>
                                    <input type="text" name="typeNo" value="<?php echo $data['manage_compartment_type']->typeNo?>" id="typeNo" required >
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="Update">
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