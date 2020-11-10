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
            <div class="text">Update Employee <small>Reservation Officer</small></div>
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
                        <input type="submit" class="blue-btn" value="Register">
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
