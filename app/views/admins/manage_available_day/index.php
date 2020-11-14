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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Available Days</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_available_days/create">Add New Days</a>
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
                            <form action="<?php echo URLROOT . "/Admin_manage_available_days/delete/" . $post->trainId?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_available_days/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_available_days/edit/" . $post->trainId?>">Edit</a>
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