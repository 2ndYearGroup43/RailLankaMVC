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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Compartments</small></h2>
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
                            <form action="<?php echo URLROOT . "/Admin_manage_compartments/delete/" . $post->trainId?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartments/views/" . $post->trainId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartments/edit/" . $post->trainId?>">Edit</a>
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