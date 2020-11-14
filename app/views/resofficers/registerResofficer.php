<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
<div class="body-section">
    <div class="content-flexrow">
        <div class="container">
            <div class="text" style="color: #13406d;">Employee Registration <small style="color: black;">Reservation Officer</small></div>
            <form action="<?php echo URLROOT;?>/resofficers/registerResofficer" method="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="officerId">Officer Id</label>
                        <input type="text" name="officerId" id="officerId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['officerIdError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="employeeId">Emloyee-Id</label>
                        <input type="text" name="employeeId" id="employeeId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['employeeIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" required >
                        <span class="invalidFeedback">
                            <?php echo $data['firstNameError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" required >
                        <span class="invalidFeedback">
                            <?php echo $data['lastNameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" required >
                        <span class="invalidFeedback">
                            <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileNo">Mobile-No</label>
                        <input type="text" id="mobileNo" name="mobileNo" placeholder="+94 ** *** *****" required >
                        <span class="invalidFeedback">
                            <?php echo $data['mobileNoError'];?>
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
                    <div class="input-data">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" name="confirmPassword" id="confirmPassword" required>
                        <span class="invalidFeedback">
                            <?php echo $data['confirmPasswordError'];?>
                        </span>
                </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Register">
                    </div>    
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Register & New">
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
    require APPROOT. '/views/includes/footer.php';
?>
