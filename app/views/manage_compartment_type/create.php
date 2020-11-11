<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?>    
        <div class="body-section">
            <div class="content-flexrow">
                <div class="container">
                    <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Add Compartment Type</small></div>
                        <form action="<?php echo URLROOT; ?>/manage_compartment_type/create" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="typeNo">Type No</label>
                                    <input type="text" name="typeNo" id="typeNo" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['typeNoError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <input type="submit" class="blue-btn" name="submit" value="ADD Type">
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