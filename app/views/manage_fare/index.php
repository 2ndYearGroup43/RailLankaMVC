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
                    <h2 style="color: #13406d;">Manage Trains <small style="color: black;">Manage Fare</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/manage_fare/create">Add New Rate</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Rate ID</th>
                                <th>First Class Base</th>
                                <th>Second Class Base</th>
                                <th>Third Class Base</th>
                                <th>Distance</th>
                                <th>Rate</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_fare'] as $post):?>
                        <tr>
                            <td data-th="Rate ID"><?php echo $post->rateID?></td>
                            <td data-th="First Class Base"><?php echo $post->fclassbase?></td>
                            <td data-th="Second Class Bases"><?php echo $post->sclassbase?></td>
                            <td data-th="Third Class Base"><?php echo $post->tclassbase?></td>
                            <td data-th="Distance"><?php echo $post->distance?></td>
                            <td data-th="Rate"><?php echo $post->rate?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/manage_fare/delete/" . $post->rateID?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_fare/views/" . $post->rateID?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/manage_fare/edit/" . $post->rateID?>">Edit</a>
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