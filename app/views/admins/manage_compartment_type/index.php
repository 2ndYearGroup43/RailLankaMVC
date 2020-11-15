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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Compartment Type</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_compartment_types/create">Add New Compartment Type</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Type No</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_compartment_type'] as $post):?>
                        <tr>
                            <td data-th="Type"><?php echo $post->typeNo?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_compartment_types/delete/" . $post->typeNo?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartment_types/views/" . $post->typeNo?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartment_types/edit/" . $post->typeNo?>">Edit</a>
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