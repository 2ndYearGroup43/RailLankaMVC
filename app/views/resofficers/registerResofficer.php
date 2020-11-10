<!DOCTYPE html>
<html>
<head>
    <title>Add New Employees</title>
    <meta name="viewport" content="width-device-width, intial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/ddd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script  src="http://code.jquery.com/jquery-3.5.1.js"></script>
        <script>
            $(document).ready(function(){
                $('#icon').click(function(){
                    $('ul').toggleClass('show');
                })
            })
        </script>
</head>
<body>
<?php
    require APPROOT.'/views/includes/manage_ro_navigation.php';
?>
<div class="body-section">
    <div class="content-flexrow">
        <div class="container">
            <div class="text">Employee Registration <small>Reservation Officer</small></div>
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
