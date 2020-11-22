<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>
 
<div class="body-section">
        <div class="content-flexrow">
           <div class="container">
            <div class="text" style="color: #13406d;">Manage Trains <small style="color: black;">Update Compartments</small></div>
            <form action="#" method = "POST">
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
                                        <option value="<?php echo $data['compartmentNo'];?>" selected><?php echo $data['class'];?></option>
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
                                    <label for="noofseats">No of Seats</label>
                                    <input type="text" name="noofseats"  value="<?php echo $data['noofseats'];?>"  id="noofseats" required >
                                    <span class="invalidFeedback">
                                        <?php echo $data['noofseatsError'];?>
                                    </span>
                                </div>
                                <div class="input-data">
                                    <label for="type">Type</label>
                                    <select name="type" id="type" required>
                                        <option  value="<?php echo $data['type'];?>" > <?php echo $data['compartmentNo'];?> </option>
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
                                    <input type="submit" class="blue-btn" name="submit" value="Update Compartment">
                                </div>
                            </div>
                        </form>
                        
               

                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>