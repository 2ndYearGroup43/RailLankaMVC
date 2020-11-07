<!DOCTYPE html>
<html>
<head>
	<title>Manage Employees</title>
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
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2>Employee Management <small>Reservation Officer</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_ro/create">Add New Employee</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Officer ID</th>
                                <th>Employee ID</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile No</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_ro'] as $post):?>
                        <tr>                            
                            <td data-th="Officer ID"><?php echo $post->officerId?></td>
                            <td data-th="Employee ID"><?php echo $post->employeeId?></td>
                            <td data-th="Email"><?php echo $post->email?></td>
                            <td data-th="First Name"><?php echo $post->firstname?></td>
                            <td data-th="Last Name"><?php echo $post->lastname?></td>
                            <td data-th="Mobile No"><?php echo $post->mobileno?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_ro/views/" . $post->officerId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_ro/edit/" . $post->officerId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_ro/delete/" . $post->officerId?>" method="POST">
                            <input type="submit" name="delete" value="Remove" class="red-btn-r">
                            </form></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>