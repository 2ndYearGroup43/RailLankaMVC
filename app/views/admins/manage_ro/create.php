<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
    <div class="body-section">
        <div class="content-flexrow">
	       <div class="container">
            <div class="text" style="color: #13406d;">Employee Management <small style="color: black;">Register Reservation Officer</small></div>
            <form action="<?php echo URLROOT; ?>/Admin_manage_ros/create" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="officerid">Officer Id</label>
                        <input type="text" name="officerId" id="officerid" required >
                        <span class="invalidFeedback">
                            <?php echo $data['officerIdError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="employeeId">Emloyee Id</label>
                        <input type="text" name="employeeId" id="employeeId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['employeeIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" required >
                        <span class="invalidFeedback">
                            <?php echo $data['firstnameError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" required >
                        <span class="invalidFeedback">
                            <?php echo $data['lastnameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required >
                        <span class="invalidFeedback">
                            <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileno">Mobile-No</label>
                        <input type="mobile" name="mobileno" id="mobileno" placeholder="+94 ** *** *****" required >
                        <span class="invalidFeedback">
                            <?php echo $data['mobilenoError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                         <label for="password">Password</label>
                         <input type="password" name="password" id="password" required>
                         <span class="invalidFeedback">
                            <?php echo $data['passwordError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" name="submit" value="Register">
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