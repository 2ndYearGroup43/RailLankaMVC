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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Compartment Type</small></h2>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Type No</th>
                                <th>Image Directory</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_compartment_type'] as $post):?>
                        <tr>
                            <td data-th="Type"><?php echo $post->typeNo?></td>
                            <td data-th="Type"><?php echo $post->imageDir?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_compartment_types/delete/" . $post->typeNo?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_compartment_types/views/" . $post->typeNo?>">View</a>
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