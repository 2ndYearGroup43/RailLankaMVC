<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>

<div class="body-section">
    <div class="content-flexrow">
        <div class="container">
            <div class="text" style="color: #13406d;">Update Employee <small style="color: black;">Reservation Officer</small></div>
            <form action="<?php echo URLROOT;?>/resofficers/updateResofficer/<?php echo $data['userId']?>" method="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="employeeId">Emloyee-Id</label>
                        <input type="text" name="employeeId" id="employeeId" value="<?php echo $data['resofficer']->employeeId;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['employeeIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" value="<?php echo $data['resofficer']->firstname;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['firstNameError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" value="<?php echo $data['resofficer']->lastname;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['lastNameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $data['resofficer']->email;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileNo">Mobile-No</label>
                        <input type="text" id="mobileNo" name="mobileNo" placeholder="+94 ** *** *****" value="<?php echo $data['resofficer']->mobileno;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['mobileNoError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <a href="#">Update Password</a>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Update">
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
