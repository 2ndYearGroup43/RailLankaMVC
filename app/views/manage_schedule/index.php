<!DOCTYPE html>
<html>
<head>
	<title>Manage Schedule</title>
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
    require APPROOT.'/views/includes/manage_schedule_navigation.php';
?>
	<div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2>Manage Schedule</h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_schedule/create">Add New Stop</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Route ID</th>
                                <th>Station ID</th>
                                <th>Stop No</th>
                                <th>Arrival Time</th>
                                <th>Departure Time</th>
                                <th>Date</th>
                                <th>Distance</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_schedule'] as $post):?>
                        <tr>
                            <td data-th="Route ID"><?php echo $post->routeId?></td>
                            <td data-th="Station ID"><?php echo $post->stationId?></td>
                            <td data-th="Stop No"><?php echo $post->stopNo?></td>
                            <td data-th="Arrival Time"><?php echo $post->arrivaltime?></td>
                            <td data-th="Departure Time"><?php echo $post->departuretime?></td>
                            <td data-th="Date"><?php echo $post->date?></td>
                            <td data-th="Distance"><?php echo $post->distance?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_schedule/views/" . $post->routeId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_schedule/edit/" . $post->routeId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_schedule/delete/" . $post->routeId?>" method="POST">
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