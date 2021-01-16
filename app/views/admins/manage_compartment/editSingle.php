<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
 
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Compartments</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_compartments/editSingle/<?php echo $data['trainId'];?>/<?php echo $data['compartment']->compartmentNo;?>" method = "POST">
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="compartmentNo">Compartment No</label>
                                    <input type="text" name="compartmentNo"  id="compartmentNo" value="<?php echo $data['compartmentNo'];?>" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['compartmentNoError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="class">Class</label>
                                    <select name="class" id="class" required>
                                        <option value="<?php echo $data['class'];?>" selected><?php echo $data['class'];?></option>
                                        <option >First</option>
                                        <option >Second</option>
                                        <option >Third</option>
                                    </select>
                                    <span class="invalidFeedback">
                                        <?php echo $data['classError'];?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" required>
                                        <option  value="<?php echo $data['type'];?>" > <?php echo $data['type'];?> </option>
                                        <?php foreach ($data['types'] as $Type ):?>
                                            <option value="<?php echo $Type->typeNo?>"><?php echo $Type->typeNo?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <span class="invalidFeedback">
                                        <?php echo $data['typeError'];?>
                                    </span>
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