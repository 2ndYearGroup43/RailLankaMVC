<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/train_management_navigation.php';
?>   
        <div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2 style="color: #13406d;">Train Management <small style="color: black;">Manage Trains</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_trains/create">Add New Train</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Train ID</th>
                                <th>Name</th>
                                <th>Reservable Status</th>
                                <th>Type</th>
                                <th>Source</th>
                                <th>Start Time</th>
                                <th>Destination</th>
                                <th>End Time</th>
                                <th>Rate ID</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_train'] as $post):?>
                        <tr>
                            <td data-th="Train ID"><?php echo $post->trainId?></td>
                            <td data-th="Name"><?php echo $post->name?></td>
                            <td data-th="Reservable Status"><?php echo $post->reservable_status?></td>
                            <td data-th="Type"><?php echo $post->type?></td>
                            <td data-th="Source"><?php echo $post->src_station?></td>
                            <td data-th="Start Time"><?php echo $post->starttime?></td>
                            <td data-th="Destination"><?php echo $post->dest_station?></td>
                            <td data-th="End Time"><?php echo $post->endtime?></td>
                            <td data-th="Rate ID"><?php echo $post->rateId?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_trains/delete/" . $post->trainId?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_trains/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_trains/edit/" . $post->trainId?>">Edit</a>
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