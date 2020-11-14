<?php
    require APPROOT.'/views/includes/resofficer_head.php';
?>
<?php
    require APPROOT.'/views/includes/resofficer_navigation.php';
?>
        <div class="body-section">
            <div class="content-row"></div>
            <div class="content-row">
                <div class="container-table">
                    <h2 style="color: #13406d;">Employee Management <small style="color: black;">Manage Reservation Officer</small></h2>
                    <a class= "blue-btn" href="<?php echo URLROOT; ?>/Admin_manage_ros/create">Add New Employee</a>
                    <table class="blue">
                        <thead>
                            <tr>
                                <th>Officer ID</th>
                                <th>Employee ID</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Mobile No</th>
                                <th>Manage</th>    
                            </tr>
                        </thead>
                        <?php foreach($data['manage_ro'] as $post):?>
                        <tr>                            
                            <td data-th="Officer ID"><?php echo $post->officerId?></td>
                            <td data-th="Employee ID"><?php echo $post->employeeId?></td>
                            <td data-th="Email"><?php echo $post->email?></td>
                            <td data-th="First Name"><?php echo $post->firstname?></td>
                            <td data-th="Last Name"><?php echo $post->lastname?></td>
                            <td data-th="Mobile No"><?php echo $post->mobileno?></td>
                            <td data-th="Manage">
                            <form action="<?php echo URLROOT . "/Admin_manage_ros/delete/" . $post->officerId?>" method="POST">    
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_ros/views/" . $post->officerId?>">View</a>
                            <a class= "blue-btn" href="<?php echo URLROOT . "/Admin_manage_ros/edit/" . $post->officerId?>">Edit</a>
                            
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