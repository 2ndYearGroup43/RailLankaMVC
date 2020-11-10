<!DOCTYPE html>
<html>
<head>
	<title>Manage Available Days</title>
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
                    <h2>Manage Available Days</h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_available_day/create">Add New Days</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Train ID</th>
                                <th>Sunday</th>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                                <th>Saturday</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_available_day'] as $post):?>
                        <tr>
                            <td data-th="Train ID"><?php echo $post->trainId?></td>
                            <td data-th="Sunday"><?php echo $post->sunday?></td>
                            <td data-th="Monday"><?php echo $post->monday?></td>
                            <td data-th="Tuesday"><?php echo $post->tuesday?></td>
                            <td data-th="Wednesday"><?php echo $post->wednesday?></td>
                            <td data-th="Thursday"><?php echo $post->thursday?></td>
                            <td data-th="Friday"><?php echo $post->friday?></td>
                            <td data-th="Saturday"><?php echo $post->saturday?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_available_day/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_available_day/edit/" . $post->trainId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_available_day/delete/" . $post->trainId?>" method="POST">
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