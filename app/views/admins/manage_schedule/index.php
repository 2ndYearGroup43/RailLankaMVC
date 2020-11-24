<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/admin_navigation.php';
?>  
	<div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Schedule</small></h2>
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
                            <form action="<?php echo URLROOT . "/Admin_manage_schedules/delete/" . $post->routeId?>" method="POST"> <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_schedules/views/" . $post->routeId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_schedules/edit/" . $post->routeId?>">Edit</a>
                            <input type="submit" name="delete" value="Remove" class="red-btn">
                            </form></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>                    
                </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>