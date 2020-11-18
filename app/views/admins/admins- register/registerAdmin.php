<?php 
    require APPROOT .'/views/includes/head.php';
?>
<?php 
    require APPROOT.'/views/includes/navigationadmin.php';
?>

<div class="body-section">
    <div class="content-flexrow">
        <div class="container">
            <div class="text">Admin Registration <small>Admin</small></div>
            <form action="<?php echo URLROOT;?>/admins/registerAdmin" method="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="adminId">Admin Id</label>
                        <input type="text" name="adminId" id="adminId" required >
                        <span class="invalidFeedback">
                            <?php echo $data['adminIdError'];?>
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
                        <input type="text" id="email" name="email" required >
                        <span class="invalidFeedback">
                            <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileno">Mobile-No</label>
                        <input type="text" id="mobileno" name="mobileno" placeholder="+94 ** *** *****" required >
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