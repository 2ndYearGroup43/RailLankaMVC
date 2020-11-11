<?php
    require APPROOT.'/views/includes/head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management.php';
?> 
	<div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Schedule</small></h2>
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
                            <td data-th="Station ID"><?php echo $post->stationID?></td>
                            <td data-th="Stop No"><?php echo $post->stopNo?></td>
                            <td data-th="Arrival Time"><?php echo $post->arrivaltime?></td>
                            <td data-th="Departure Time"><?php echo $post->departuretime?></td>
                            <td data-th="Date"><?php echo $post->date?></td>
                            <td data-th="Distance"><?php echo $post->distance?></td>
                            <td data-th="Manage">
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_schedule/views/" . $post->routeId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_schedule/edit/" . $post->routeId?>">Edit</a>
                            <form action="<?php echo URLROOT . "/manage_schedule/delete/" . $post->routeId?>" method="POST">
                            <input type="submit" name="delete" value="Remove" class="red-btn">
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