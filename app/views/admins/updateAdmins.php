<?php 
    require APPROOT .'/views/includes/admin_head.php';
?>
<?php 
    require APPROOT.'/views/includes/admin_navigation.php';
    //var_dump($data)
?>

<div class="body-section">
    <div class="content-flexrow">
        <div class="container">
            <div class="text">Update Employee <small>Admin</small></div>
            <form action="<?php echo URLROOT;?>/superadmins/updateAdmin/<?php echo $data['userid']?>" method="POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="employeeId">Emloyee-Id</label>
                        <input type="text" name="employeeId" id="employeeId" value="<?php echo $data['admin']->employeeId;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['employeeIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $data['admin']->firstname;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['firstnameError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $data['admin']->lastname;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['lastnameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $data['admin']->email;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileno">Mobile-No</label>
                        <input type="text" id="mobileno" name="mobileno" placeholder="+94 ** *** *****" value="<?php echo $data['admin']->mobileno;?>" required >
                        <span class="invalidFeedback">
                            <?php echo $data['mobilenoError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="button" class="blue-btn" value="Reset Password" onclick="location.href='<?php echo URLROOT;?>/employees/resetEmployeePassword/<?php echo $data['userId'];?>'">
                    </div>
                </div>
                <div class="form-row submit-btn">
                    <div class="input-data">
                        <input type="submit" class="blue-btn" value="Save">
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