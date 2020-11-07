<!DOCTYPE html>
<html>
<head>
	<title>Manage Compartment</title>
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
    require APPROOT.'/views/includes/manage_compartment_navigation.php';
?> 
	<div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2>Manage Compartment</h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_compartment/create">Add New Compartment</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Train ID</th>
                                <th>Compartment No</th>
                                <th>Class</th>
                                <th>No of Seats</th>
                                <th>Type</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_compartment'] as $post):?>
                        <tr>
                            <td data-th="Train ID"><?php echo $post->trainId?></td>
                            <td data-th="Compartment No"><?php echo $post->compartmentNo?></td>
                            <td data-th="Class"><?php echo $post->class?></td>
                            <td data-th="No of Seats"><?php echo $post->noofseats?></td>
                            <td data-th="Type"><?php echo $post->type?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_compartment/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_compartment/edit/" . $post->trainId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_compartment/delete/" . $post->trainId?>" method="POST">
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