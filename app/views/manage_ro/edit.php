<!DOCTYPE html>
<html>
<head>
	<title>Update Employee Details</title>
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
            <div class="text">Update Employee<small> Reservation Officer</small></div>
            <form action="<?php echo URLROOT; ?>/manage_ro/edit/<?php echo $data['manage_ro']->officerId?>" method = "POST">
                <div class="form-row">
                    <div class="input-data">
                        <label for="officerId">Officer Id</label>
                        <input type="text" name="officerId" value="<?php echo $data['manage_ro']->officerId?>" id="officerId" required >
                    </div>
                    <div class="input-data">
                        <label for="employeeId">Emloyee Id</label>
                        <input type="text" name="employeeId" value="<?php echo $data['manage_ro']->employeeId?>" id="employeeId" required >
                        <span class="invalidFeedback">
                        <?php echo $data['employeeIdError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" value="<?php echo $data['manage_ro']->firstname?>" id="firstname" required >
                        <span class="invalidFeedback">
                            <?php echo $data['firstnameError'];?>
                        </span>
                    </div>
                    <div class="input-data">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" value="<?php echo $data['manage_ro']->lastname?>" id="lastname" required >
                        <span class="invalidFeedback">
                            <?php echo $data['lastnameError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="<?php echo $data['manage_ro']->email?>" id="email" required >
                        <span class="invalidFeedback">
                        <?php echo $data['emailError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                        <label for="mobileno">Mobile-No</label>
                        <input type="mobile" name="mobileno" value="<?php echo $data['manage_ro']->mobileno?>" id="mobileno" placeholder="+94 ** *** *****" required >
                        <span class="invalidFeedback">
                            <?php echo $data['mobilenoError'];?>
                        </span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-data">
                         <label for="password">Password</label>
                         <input type="password" name="password" value="<?php echo $data['manage_ro']->password?>" id="password" required>
                         <span class="invalidFeedback">
                            <?php echo $data['passwordError'];?>
                        </span>
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
    require APPROOT.'/views/includes/footer.php';
?>