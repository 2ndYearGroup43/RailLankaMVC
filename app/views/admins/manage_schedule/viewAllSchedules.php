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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Schedules</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_schedules/addNewStops/<?php echo $data['trainId'];?>/<?php echo $data['routeId'];?>">Add New Schedule</a>
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
                        <?php foreach($data['routes'] as $route):?>
                        <tr>
                            <td data-th="Route ID"><?php echo $route->routeId?></td>
                            <td data-th="Station ID"><?php echo $route->stationID?></td>
                            <td data-th="Stop No"><?php echo $route->stopNo?></td>
                            <td data-th="Arrival Time"><?php echo $route->arrivaltime?></td>
                            <td data-th="Departure Time"><?php echo $route->departuretime?></td>
                            <td data-th="Date"><?php echo $route->date?></td>
                            <td data-th="Distance"><?php echo $route->distance?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_schedules/delete/" . $route->stationID?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_schedules/views/" . $route->routeId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_schedules/edit/" . $route->trainId?>">Edit</a>
                            <input type="submit" name="delete" value="Remove" class="red-btn">
                            </form></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <button type="button" onclick="history.go(-1);" class="back-btn" value="Back">Back</button>             </div>
            </div>
        </div>
<?php
    require APPROOT.'/views/includes/footer.php';
?>